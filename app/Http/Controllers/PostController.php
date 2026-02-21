<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'احراز هویت نشدید '], 401);
        }

        $post = Post::all();
        if ($post->isEmpty()) {
            return response()->json([
                'message' =>  " مقداری وجود ندارد"
            ], 404);
        }

        return response()->json([
            'data' =>  $post
        ], 200);
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'احراز هویت نشدید '], 401);
        }

        if (!Gate::allows('create', Post::class)) {
            return response()->json([
                'error' => 'شما دسترسی ندارید'
            ], 403);
        }

        $request->validate([
            'title' => 'required|string|min:5',
            'body' => 'required|between:5,300'
        ]);
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        if (!$post) {
            return response()->json([
                'message' =>  "پست اضافه نشد"
            ], 400);
        }

        return response()->json([
            'message' =>  "پست با موفقیت ساخته شد"
        ], 201);
    }

    public function update(Request $request, $id)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'احراز هویت نشدید '], 401);
        }

        $post = Post::where('id', $id)->first();

        if (!$post) {
            return response()->json([
                'message' =>  "پست پیدا نشد"
            ], 400);
        }

        if (!Gate::allows('update', $post)) {
            return response()->json([
                'error' => 'شما دسترسی ندارید'
            ], 403);
        }

        $request->validate([
            'title' => 'required|string|min:5',
            'body' => 'required|between:5,300'
        ]);


        $post->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        if (!$post) {
            return response()->json([
                'message' =>  "پست بروزرسانی نشد"
            ], 400);
        }

        return response()->json([
            'message' =>  "پست با موفقیت بروزرسانی شد"
        ], 201);
    }

    public function delete(Request $request, $id)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'احراز هویت نشدید '], 401);
        }

        $post = Post::where('id', $id)->first();

        if (!$post) {
            return response()->json([
                'message' =>  "پست پیدا نشد"
            ], 400);
        }

        if (!Gate::allows('delete', $post)) {
            return response()->json([
                'error' => 'شما دسترسی ندارید'
            ], 403);
        }


        $post->delete();

        if (!$post) {
            return response()->json([
                'message' =>  "پست حذف نشد"
            ], 400);
        }

        return response()->json([
            'message' =>  "پست با موفقیت حذف شد"
        ], 201);
    }
}

