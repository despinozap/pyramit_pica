<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{
    public function index()
    {
    	$comments = Comment::orderBy('id', 'DESC')->where('approved', false)->paginate(5);
    	$comments->each(function($comment)
        {
            $comment->article;
        });

    	return view('admin.comments.index')->with('comments', $comments);
    }

    public function show($id)
    {
    	$comment = Comment::find($id);

        if($comment->approved != 0)
        {
            $comment = null;
        }

    	return view('admin.comments.view')->with('comment', $comment);
    }

    public function check(Request $request)
    {
        $responseCode = 0;

        if($request->id)
        {
            $comment = Comment::find($request->id);

            if($request->approved == 1)
        	{
        		$comment->approved = true;
        		if($comment->save())
                {
                    $responseCode = 1;
                }
        	}
        	else
        	{
                if($comment->delete())
                {
                    $responseCode = 2;
                }
        	}
        }
        else
        {
            $responseCode = -1;
        }

        return $responseCode;
    }
}
