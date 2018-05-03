<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Item;
use App\ItemProofer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;

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
        $item = Item::where('id', $id)->first();

        $proffer = true;
        if(($userId = \Auth::user()->role_id) != 1 && $item) {
            if($item->user_id != $userId) {
                $proffer = $item->proofers->where('user_id', $userId)->first();
            }
        }

        if( ! $item || ! $proffer) {
           return abort(404);
        }

        $itemProofers = $item->proofers;

        $users = User::where('role_id', 2)->get();              //all proofer user
        $comments = Comment::where('item_id', $item->id)->orderBy('created_at', 'desc')->get(); //all comments to this item
        return view('editor.index', compact(['item', 'itemProofers', 'users','comments']));
    }

    public function accept(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->status = 1;
        $item->proofer_id=\Auth::user()->id;
        $item->save();
        return redirect()->route('dashboard');
    }

    public function addProofer(Request $request)
    {
        $item = Item::where('id', $request->item_id)->first();

        $proffer = true;
        if(($userId = \Auth::user()->role_id) != 1 && $item) {
            if($item->user_id != $userId) {
                $proffer = false;
            }
        }

        if( ! $item || ! $proffer) {
            return abort(404);
        }

        ItemProofer::where('item_id', $request->item_id)->delete();
        if($request->proofers)
            foreach ($request->proofers as $prooferId) {
                ItemProofer::create(['item_id' => $request->item_id, 'user_id' => $prooferId]);
            }
        return back();
    }

    public function addComment(Request $request)
    {
        $filename = 'files/comment_' . $request->item_id . '_' . time() . '.jpg';
        Storage::disk('local')->put($filename, file_get_contents($request->image));

        $comment = new Comment();
        $comment->item_id = $request->item_id;
        $comment->user_id = \Auth::user()->id;
        $comment->comment_txt = $request->comment;
        $comment->comment_path = $filename;
        $comment->status = 0;
        $comment->save();

        $comments = Comment::where('item_id', $request->item_id)->orderBy('created_at', 'desc')->get();
        return view('editor.parts.comments', compact(['comments']));
    }

}
