<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use App\Http\Controllers\Controller;


class MasterCommentsController extends Controller
{
    //

    public function store_comment(Request $request)
    {

        $request->validate([
            'content' => 'required|string|max:1000',
            'commentable_type' => 'required|string|max:100',
            'commentable_id' => 'required|integer',
            'parent_id' => 'nullable|integer'
        ]);



        $commentableModel = $request->commentable_type;
        $commentable = $commentableModel::findOrFail($request->commentable_id);

        
        $comment = new Comments();
        $comment->content = $request->content;
        $comment->user_id_fk = Controller::getUserId();
        $comment->commentable_id = $commentable->id;
        $comment->commentable_type = $commentableModel;
        $comment->parent_id = $request->parent_id;
        $comment->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'comment' => [
                    'content' => $comment->content,
                    'user_name' => $comment->user->name,
                ]
            ]);
        }

        return back()->with('message', 'Comment posted successfully.');
    }


}
