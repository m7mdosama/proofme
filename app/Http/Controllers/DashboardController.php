<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::get();

        return view('dashboard.index', compact('items'));
    }

    public function uploadDesign(Request $request) {
        //echo ($request->method());
        //echo ('<br>');
        //var_dump($request);
        //echo ($request->design_image->getClientOriginalName());
        //dd ($request->design_image);

        $fileName = $request->design_image->store('files');
        $item  = new Item();
        $item->user_id = \Auth::user()->id;
        $item->file_path = $fileName;
        $item->item_name = $request->design_image->getClientOriginalName();
        $item->status = 0;
        $item->save();

        $items = Item::get();
        return view('dashboard.parts.items_list', compact('items'));
    }

}
