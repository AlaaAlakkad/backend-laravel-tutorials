<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Stevebauman\Purify\Facades\Purify;


class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        //return Post::where('title', 'post two') ->take(1)-> get();
        $posts = Post::orderBy('created_at', 'desc') -> paginate(10);
        return view('posts.index')-> with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request, [
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        $post = new Post();
        $post -> title = Purify::clean($request -> input('title'));
        $post -> body =  Purify::clean($request -> input('body'));
        $post -> user_id = auth() -> user() -> id;
        $post -> save();
        return redirect('/posts') -> withSuccess('Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show') -> with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this -> validate($request, [
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        $post = Post::find($id);
        $post -> title = Purify::clean($request -> input('title'));
        $post -> body =  Purify::clean($request -> input('body'));
        $post -> save();
        return redirect('/posts') -> withSuccess('Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        $post -> delete();
        return redirect('/posts') -> withSuccess('Post Deleted');
    }
}
