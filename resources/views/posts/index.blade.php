@extends('layouts.app')
@section('title', 'Home Page')
@section('content')

<div class="container">
    @forelse ($posts as $post)
    <div class="card" style="margin: 100px;">
        @if ($post->image)
        <img src="{{asset('image/'.$post->image)}}" alt="post image"> 
        @endif
        <div class="card-body">
            <h5 class="card-title">{{$post->title}}</h5>
            <p class="card-text">{{$post->description }}</p> 
            <div class="mb-3">
                    <a href="{{route('posts.show',$post->id)}}" class="btn btn-primary btn-lg " >view</a>
                    @if(auth()->check() && auth()->user()->can('Update',$post)) 
                    <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary btn-lg " >edit</a>
            
              @endif
                </div>
                @if(auth()->check() && auth()->user()->can('dalete',$post)) 
             <form action="{{route('posts.destroy',$post->id)}}" method="POST">
                @csrf
                @method('delete')
               
                <button type="submit" class="btn btn-primary" onclick="return confirm('are you sure want to delete posts ')">Delete</button>
              </form>
              @endif
              @empty
              <h2 class="card-title">no post</h2>
            @endforelse
         </div>
        </div>
      </div>
  @endsection