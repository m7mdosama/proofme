<?php

namespace App\Http\Controllers;

use App\Item;
use App\ItemProofer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditorController extends Controller
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
    public function index(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $itemProofers = $item->proofers;

        $users = User::where('role_id', 2)->get();
        return view('editor.index', compact(['item', 'itemProofers', 'users']));
    }

    public function accept(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->status = 1;
        $item->save();

        return '1';
    }

    public function addProofer(Request $request)
    {
        $item = Item::findOrFail($request->item_id);
        ItemProofer::where('item_id', $request->item_id)->delete();
        foreach ($request->proofers as $prooferId) {
            ItemProofer::create(['item_id' => $request->item_id, 'user_id' => $prooferId]);
        }


        return '1';
    }


}
