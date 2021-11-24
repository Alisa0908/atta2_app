<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Item::class, 'item');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = $request->category;
        $lost_desc = $request->lost_desc;
        $feature = $request->feature;

        $params = $request->query();
        $items = Item::search($params)
            ->with(['user', 'category'])->paginate(10);
        $items->appends(compact('feature', 'lost_desc', 'category'));

        $categories = Category::all();

        return view('items.index', compact('items', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Item  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $item = new Item($request->all());
        $item->user_id = $request->user()->id;
        $file = $request->file;


        DB::beginTransaction();

        try {
            // 登録
            $item->save();
            $path = Storage::putFile('items', $file);

            // Attachmentモデルの情報を用意
            $attachment = new Attachment([
                'item_id' => $item->id,
                'org_name' => $file->getClientOriginalName(),
                'name' => basename($path)
            ]);
            // Attachment保存
            $attachment->save();
            DB::commit();
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors('保存に失敗しました');
            DB::rollback();
        }

        return redirect()
            ->route('items.show', $item)
            ->with('notice', '情報を登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Item  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, Item $item)
    {
        $item->fill($request->all());


        try {
            // 登録
            $item->save();
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors('登録処理でエラーが発生しました');
        }

        return redirect()->route('items.show', $item)
        ->with('notice', '登録しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        // if (Auth::guard(PlaceConst::GUARD)->user()->cannot('delete', $item)) {
        //     return redirect()->route('items.index', $item)
        //     ->withErrors('自分の投稿した情報以外は削除できません');
        // }
        try {
            $item->delete();
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors('削除処理でエラーが発生しました');
        }

        return redirect()->route('items.index')
        ->with('notice', '落とし物情報を削除しました');
    }
}
