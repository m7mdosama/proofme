<?php

namespace App\Http\Controllers;

use App\Item;
use App\ItemProofer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Imagick;

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

    public function index()
    {
        $items = $this->GetItems();
        return view('dashboard.index', compact('items'));
    }

    public function uploadDesign(Request $request)
    {
        $fileName = $request->design_image->store('files');
        if ($request->design_image->getClientOriginalExtension() == 'pdf') {
            $imagick = new Imagick(realpath('uploads/' . $fileName) . '[0]');
            $fileName = 'files/item_' . time() . '.jpg';
            Storage::disk('local')->put($fileName, '');
            $imagick->setResolution(500, 700);
            $imagick->writeImage(realpath('uploads/' . $fileName));
            $imagick->clear();
            $imagick->destroy();
        }
        $item = new Item();
        $item->user_id = \Auth::user()->id;
        $item->file_path = $fileName;
        $item->item_name = $request->design_image->getClientOriginalName();
        $item->status = 0;
        $item->save();

        $items = $this->GetItems();
        return view('dashboard.parts.items_list', compact('items'));
    }

    private function GetItems()
    {
        //Get Items based on signed in role
        switch (Auth::user()->role_id) {
            case 1:
                return Item::orderBy('created_at', 'desc')->get();
                break;
            case 2:
                $items_id = ItemProofer::where('user_id', Auth::user()->id)->get()->pluck('item_id')->all();
                return Item::orderBy('created_at', 'desc')->find($items_id);
                break;
            case 3:
                return Item::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
                break;
            case 4:
                return Item::orderBy('created_at', 'desc')->get();
                break;
            default:
                break;
        }
    }
}
