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
        return view('dashboard');
    }

    public function uploadDesign(Request $request) {
        $fileName = $request->design_image->store('files');
        $item  = new Item();
        $item->user_id = \Auth::user()->id;
        $item->file_path = $fileName;
        $item->item_name = $request->design_image->getClientOriginalName();
        $item->status = 0;
        $item->save();
    }

}
