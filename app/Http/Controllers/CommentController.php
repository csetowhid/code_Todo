<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment_store(Request $request, $todos_id)
    {
        if(Comment::create([
            'comment' => $request->get('comment'),
            'todos_id' => $todos_id,
            'auth_id' => Auth::id(),
        ])){
            return redirect()
            ->back()
            ->with('SUCCESS', __('Successfully Commented'));
        }
        return redirect()->back()->withInput()
        ->with('ERROR', __('Failed To Comment Category'));

    }
}
