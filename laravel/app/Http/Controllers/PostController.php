<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => ['required', 'min:3', 'max:100'],
            'body' => ['required', 'min:3']
        ]);

        $request->user()->posts()->create($incomingFields);

        return redirect('/home');
    }

    public function deletePost(Request $request, Post $post)
    {
        $request->user()->posts()->findOrFail($post->id)->delete();

        return redirect('/home');
    }

    public function editPost(Request $request, Post $post)
    {
        $incomingFields = $request->validate([
            'title' => ['required', 'min:3', 'max:100'],
            'body' => ['required', 'min:3']
        ]);

        $ownedPost = $request->user()->posts()->findOrFail($post->id);
        $ownedPost->update($incomingFields);

        return redirect('/home');
    }
}
