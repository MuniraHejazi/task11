<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', post::class);
        $posts = post::all();
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', post::class);
        return view('posts.creat');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
        'description'=>'required',
        'image'=>'image|mimes:jpeg,png,jpg,gif|max:2048',]);
        $post = new post();
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        if ($request->hasFile('image')) {
           $image = $request->file('image');
           $imageName = time().'.'.$image->getClientOriginalExtension();
           $image->move(public_path('image'),$imageName);
           $post->image=$imageName;
        }
        $post->save();
        return redirect()->route('posts.index')->with('success','post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        $this->authorize('update', post::class);
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        $request->validate([
            'title'=>'required',
        'description'=>'required',
        'image'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
          $data =$request-> only([ 'title','description']);
       // $post->title = $request->input('title');
       // $post->description = $request->input('description');
        if ($request->hasFile('image')) {
           $image = $request->file('image');
           $imageName = time().'.'.$image->getClientOriginalExtension();
           $image->move(public_path('image'),$imageName);
           $data['image'] = $imageName;
        }
        $posts = new Post();
       $posts->user_id = auth()->id($data);
        return redirect()->route('posts.index')->with('success','post created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        $this->authorize('delete', post::class);
        $post->delete();
        return redirect()->route('posts.index')->with('success','Company has been deleted successfully');
    }
}
