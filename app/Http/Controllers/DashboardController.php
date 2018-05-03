<?php

namespace App\Http\Controllers;

use App\Item;
use App\ItemProofer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        switch (Auth::user()->role_id){
            case 1:
                $items = Item::orderBy('created_at', 'desc')->get();
                break;
            case 2:
                $items_id = ItemProofer::where('user_id',Auth::user()->id)->get()->pluck('item_id')->all();
                $items = Item::orderBy('created_at', 'desc')->find($items_id);
                break;
            case 3:
                $items = Item::where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->get();
                break;
            case 4:
                $items = Item::orderBy('created_at', 'desc')->get();
                break;
            default:
                break;
        }

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

        $items = Item::orderBy('created_at', 'desc')->get();
        return view('dashboard.parts.items_list', compact('items'));
    }

}
