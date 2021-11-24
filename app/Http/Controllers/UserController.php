<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Item;

class UserController extends Controller
{
    /**
     * dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $items = Item::latest()
            ->MyItem()
            ->paginate(10);
        $categories = Category::all();

        return view('dashboard', compact('items', 'categories'));
    }
}
