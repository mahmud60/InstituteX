<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Carbon\Carbon;
use Auth;

class ClassPostsController extends Controller
{
    public function createPost()
    {
        $userid = Auth::user()->id;
        $courseid = request('course-id');

        /*request()->validate([
            'file' => 'required|mimes:pdf,xlx,csv|max:2048',
        ]);*/

        $post = new Post;
        
        if(request('file')) {
            $fileName = time().'_'.request('file')->getClientOriginalName();
            $filePath = request('file')->storeAs('uploads', $fileName, 'public');
            $post->file_name = $fileName;
            $post->attachment = '/storage/' . $filePath;
        }

        $post->user_id = $userid ;
        $post->course_id = $courseid;
        $post->body = request('post-body');
        $post->created_at = now();
        $post->save();
        return back();
    }

    public function deletePost()
    {
        $postid = request('post-id');
        $post = Post::find($postid);
        $post->delete();
        return back();
    }

    public function addComment()
    {
        $userid = Auth::user()->id;
        
        $comment = new Comment;
        $comment->user_id = $userid;
        $comment->post_id = request('post-id');
        $comment->comment = request('comment');
        $comment->created_at = now();
        $comment->save();

        return back();
    }

    public function deleteComment()
    {
        $commentid = request('comment-id');
        $comment = Comment::find($commentid);
        $comment->delete();
        return back();
    }
}
