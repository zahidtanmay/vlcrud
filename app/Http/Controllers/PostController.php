<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PostController extends Controller
{
    public function index()
    {
        return Post::orderBy('id','DESC')->get();
    }

    public function store(Request $request)
    {


        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $create = Post::create($request->all());

        return response()->json(['status'=>'success','msg'=>'Post created successfully']);

    }

    public function show($id)
    {
        //
        return Post::find($id);
    }

    public function edit($id)
    {
        //
        return Post::find($id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $post = Post::find($id);
        if($post->count()){
            $post->update($request->all());
            return response()->json(['status'=>'success','msg'=>'Post updated successfully.']);
        }else{
            return response()->json(['status'=>'error','msg'=>'Error in updating Post']);
        }

    }

    public function destroy($id)
    {
        $post= Post::find($id);
        if($post->count()){
            $post->delete();
            return response()->json(['status'=>'success','msg'=>'Post deleted successfully']);
        }else{
            return response()->json(['status'=>'error','msg'=>'Error in deleting Post']);
        }
    }
}
