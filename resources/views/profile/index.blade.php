@extends('layouts.app')
@section('content')

<div class="w-4/5 m-auto text-center">
    <div class="py-15 border-b border-gray-200">
        <h1 class ="text-6xl">
            My Profile
        </h1>
    </div>
</div> 

<div class="w-4/5 m-auto text-left">
    <div class="py-15 ">
        <h1 class ="text-2xl"><B>Id:</B>
        {{ Auth::user()->id }}<br>
        <B>Name:</B>
        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<br>
        <B>Mail</B>
        {{ Auth::user()->email }}

        </h1>
    </div>
</div>





@endsection