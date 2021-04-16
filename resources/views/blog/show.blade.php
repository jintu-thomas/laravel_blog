@extends('layouts.app')
@section('content')



<div class="w-4/5 m-auto text-left">
    <div class="py-15 ">
        <h1 class ="text-6xl">
            {{$post->title}}
        </h1>
    </div>
</div> 

<div>
    <img src="{{asset('images/' . $post->image_path)}}" alt="">
</div>
<div class="w-4/5 m-auto pt-20">
    By<span class="font-bold-italic text-gray-800">{{$post->user->first_name}}
    </span>Created on {{date('jS M Y', strtotime($post->updated_at))}}


    <div class="w-4/5 m-auto text-left">
        <div class="py-15 ">
            <h1 class ="text-6xl">
                {{$post->description}}
            </h1>
        </div> 
        <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
            {{$post->content}}

        </p>
    </div>
</div> 


@endsection

                
                    


