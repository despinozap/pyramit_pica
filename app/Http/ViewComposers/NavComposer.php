<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Comment;

class NavComposer
{
	
	public function compose(View $view)
	{
        $comments_count = Comment::orderBy('id', 'ASC')->where('approved', false)->get()->count();

		$view->with('comments_count', $comments_count);		
	}

}