<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\User;
use Illuminate\Http\Request;

class UserCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(User $user, StoreComment $request)
    {
        $user->commentsOn()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id,
        ]);

        // $request->session()->flash('status', 'Comment successfully created');
        return redirect()->back()->withStatus('Comment successfully created');
    }
}
