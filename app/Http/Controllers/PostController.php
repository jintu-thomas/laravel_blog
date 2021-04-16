<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    public function index()
    {
        $posts=Post::paginate(3);
        return view('blog.index')->withPosts($posts);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
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
            'title'=>'required|max:225',
            'description'=>'required|max:225',
            'content'=>'required',
            'image'=>'required',
        ]);

        $newImagename=uniqid() .'-'.$request->title . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $newImagename);


        Post::create([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'content'=>$request->input('content'),
            'slug'=>SlugService::createSlug(Post::class,'slug',$request->title),
            'image_path'=>$newImagename,
            'user_id'=>auth()->user()->id,
            'visible'=>$request->input('visible')
            
        ]);
        return redirect('/blog')->with('message', 'your posst has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return view('blog.show')->with('post', Post::where('slug',$slug)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('blog.edit')->with('post', Post::where('slug',$slug)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'content'=>'required',
            'image'=>'required',
        ]);

        $newImagename=uniqid() .'-'.$request->title . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $newImagename);

        Post::where('slug', $slug)->update([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'content'=>$request->input('content'),
            'image_path'=>$newImagename,
            'slug'=>SlugService::createSlug(Post::class,'slug',$request->title),
            'user_id'=>auth()->user()->id,
                
            
        ]);
        return redirect('/blog')->with('message','your post has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post=Post::where('slug',$slug);
        $post->delete();

        return redirect('/blog')->with('message', 'your post has been deleted');
    }
    

}
