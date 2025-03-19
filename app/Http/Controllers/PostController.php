<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posts = Post::all();
        return view('post.create',compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        $data = $request->validate([
            'title' => 'required|max:300|string',
            'image' => 'required|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'required|string|max:2000',
        ]);

        // dd($data);

        if($request->has('image')){
            
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/'),$imageName);
            $data['image'] = $imageName;
        }

        Post::create($data);
        return back()->with('success','Post created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|max:300|string',
            'image' => 'sometimes|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'required|string|max:2000',
        ]);
        if($request->has('image')){
            // checking the image exists in the folder
            if(File::exists(public_path('uploads/' . $post->image))){
               File::delete(public_path('uploads/' . $post->image));
            }
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/'),$imageName);
            $data['image'] = $imageName;
        }

        $post->update($data);
        return redirect()->route('post.create')->with('success','Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // dd($post);
        if(File::exists(public_path('uploads/'.$post->image))){
            File::delete(public_path('uploads/'.$post->image));
        }
        $post->delete();
        return back()->with('success','Post deleted successfully!');
    }
}
