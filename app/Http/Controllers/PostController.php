<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $post = Post::all();

        return response()->json([
            'message' => 'Todo los post',
            'data' => $post
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'description' => 'required'
        ]);

        $post = Post::create($request->all());
        $post->save();

        return response()->json([
            'message' => 'Post creado',
            'data' => $post,
        ]);
    }

    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'message' => 'no se encontro el post'
            ]);
        }

        return response()->json([
            'message' => 'Un post',
            'data' => $post
        ]);
    }


    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'message' => 'no se encontro el post'
            ]);
        }

        $post->fill($request->all());
        $post->save();

        return response()->json([
            'message' => 'Un post actulizado',
            'data' => $post
        ]);
    }


    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'message' => 'no se encontro el post'
            ]);
        }

        $post->delete();
        return response()->json([
            'message' => 'Eliminado'
        ]);
    }
}
