<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ItemRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Attachment;

class ItemController extends Controller
{
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

        $data = [$items, $categories];

        return $data;
    }

    public function show(Item $item)
    {
        return $item;
    }

    public function store(ItemRequest $request)
    {
        $item = new Item($request->all());
        $item->user_id = $request->user()->id;
        $file = $request->file;

        DB::beginTransaction();

        try {
            $item->save();
            $path = Storage::putFile('items', $file);

            $attachment = new Attachment([
                'item_id' => $item->id,
                'org_name' => $file->getClientOriginalName(),
                'name' => basename($path)
            ]);
            $attachment->save();
            DB::commit();
        } catch (\Exception $e) {
            // return $e->getMessage();
            return back()->withInput()
                ->withErrors('保存に失敗しました');
            DB::rollback();
        }

        return $item;

    }

    public function destroy(Item $item)
    {
        try {
            $item->delete();
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors('削除処理でエラーが発生しました');
        }
    }
}
