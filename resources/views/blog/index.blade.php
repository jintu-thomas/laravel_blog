@extends('layouts.app')
@section('content')

<div class="w-4/5 m-auto text-center">
    <div class="py-15 border-b border-gray-200">
        <h1 class ="text-6xl">
            Blog Posts
        </h1>
    </div>
</div> 

@if(session()->has('message'))
    <div class="w-4/5  m-auto mt-10 pl-2">
        <p class="w-1/6 mb-4 text-gray-50  rounded-2xl py-4">
            {{session()->get('message') }}
        </p>

    </div>
@endif

    
@if (Auth::check())
    <div class="w3-btn w3-grey w3-round">
        <a
            href="/blog/create"
            class="bg-gray-500 uppercase bg-transparanet text-gray-100 text-xs font-extrabold ppx-5 py-3 sqare-3xl"> Create Post
        </a>
    </div>
@endif

<!-- //check if condiotion for visisblity of blog -->

    @foreach ( $posts as $post )

        @if(isset(Auth::user()->id) && Auth::User()->id==$post->user_id)


            <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
                <div>
                    <img src="{{asset('images/' . $post->image_path)}}" alt="">
                </div>

                <div>
                    <h2 class="text-gray-700 font-bold text-5xl pb-4">
                    {{$post->title}}
                    </h2>

                    <span class="text-gray-500">
                        By<span class="font-bold italic text-1xl text-gray-800">
                        {{$post->user->first_name}}
                        </span><br>
                        Owner_id<span class="font-bold text-1xl italic text-gray-800">
                        {{$post->user->id}}</span><br>
                        Created on {{date('jS M Y', strtotime($post->updated_at))}}
                    </span>

                        <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
                        {{$post->description}}
                    </P>

                    <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
                        {{$post->content}}
                    </P>
                    <a href="/blog/{{$post->slug}}" class="uppercase bg-gray-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">keep reading
                    </a>
                </div>
                

                
            </div>
            <span class="float-right">
                <a href="/blog/{{$post->slug}}/edit" class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2">Edit</a>
            </span>
            <span class="float-right">
                <form
                    action="/blog/{{$post->slug}}"
                    method="POST">
                    @csrf
                    @method('delete')
                    <button
                        class="text-red-500 pr-3"
                        type="submit">DELETE
                    </button>
                    
                </form>
            </span>
            
        <div>    
            

        

        @elseif ($post->visible ==1)
            <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
                <div>
                    <img src="{{asset('images/' . $post->image_path)}}" alt="">
                </div>

                <div>
                    <h2 class="text-gray-700 font-bold text-5xl pb-4">
                    {{$post->title}}
                    </h2>

                    <span class="text-gray-500">
                        By<span class="font-bold italic text-gray-800">
                        {{$post->user->first_name}}
                        </span><br>
                        Owner_id<span class="font-bold italic text-gray-800">
                        {{$post->user->id}}</span><br>
                        Created on {{date('jS M Y', strtotime($post->updated_at))}}
                    </span>

                    <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
                        {{$post->description}}
                    </P>

                    <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
                        {{$post->content}}
                    </P>
                    <a href="/blog/{{$post->slug}}" class="uppercase bg-gray-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">keep reading
                    </a>
                </div>
                <div>

                    
                </div>
            </div>
            
        @endif
    @endforeach
<div>
    <div class ="text-center">
        {{$posts->links()}}
    </div>
</div>




@endsection