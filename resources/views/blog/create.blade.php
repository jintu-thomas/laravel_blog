@extends('layouts.app')
@section('content')

<div class="w-4/5 m-auto text-left">
    <div class="py-15 ">
        <h1 class ="text-6xl">
            Create Blog 
        </h1>
    </div>
</div> 

@if ($errors->any())
    <div class ="w-4/5 m-auto">
        <ul>
            @foreach ($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
                
            @endforeach
        </ul>
    </div>
@endif

<div class="w-4/5 m-auto pt-20">
    <form
        action="/blog"
        method="POST"
        enctype="multipart/form-data">
        @csrf

        <input type ="text"
        name="title"
        placeholder="Title"
        class ="bg-gray-0 block border-b-2 w--full h-20 text-6xl otline-none">
        @error('title')
            <small class="text-danger">{{$message}}</small>
        @enderror

        <input type ="text"
        name="description"
        placeholder="Description"
        class ="bg-gray-0 block border-b-2 w--full h-20 text-6xl otline-none">
        @error('content')
            <small class="text-danger">{{$message}}</small>
        @enderror

        <textarea

            name="content"
            placeholder="Content"
            class="bg-gray-0 block border-b-2 w--full h-60 text-xl otline-none">
        </textarea>
        

        <div class ="bg-gray-lighter pt-15">
            <label class="w-44 flex flex-col items-center px-2 py-3 bg-white-rounded-lg shadow-lg tracking-wide uppercase-border border-blue cursor-pointer">
                <span class ="mt-2 text area leading-normal">
                    select a file
                </span>

                <input
                    type ="file" 
                    name="image"
                    class="hidden">
            </label>
        </div><br>

        

        POST WILL BE <input type="radio" name="visible" value="1">PUBLIC<br>
        <input type="radio"  name="visible" value="0">PRIVATE<br>

        <button type="submit"
            class="uppercase mt-15 bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
            Submit Post
        </button>
    </form>
<div>
                
                    


@endsection