<?php

namespace App\Http\Controllers\WebAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Support\Facades\Storage;

use App\Post;
use App\Category;
use App\Tag;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');       
        $posts = Post::orderBy('id', 'DESC')->where('user_id', auth()->user()->id)->get();
        return view('webadmin.posts.index', compact('posts', 'dateCarbon'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $tags = Tag::orderBy('name', 'ASC')->get();
        return view('webadmin.posts.create', compact('categories', 'tags'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        
        $post = Post::create($request->all());

        //IMAGE
        if ($request->hasFile('file')) {
            $path = Storage::disk('public')->put('news_image', $request->file('file'));
            $post->fill(['file'=>asset($path)])->save();
        }

        //Tags
        $post->tags()->sync($request->get('tags'));

        return redirect()->route('posts.index')->with('info', 'Noticia Creada Correctamente.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $post = Post::findOrFail($id);
        return view('webadmin.posts.show', compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $tags = Tag::orderBy('name', 'ASC')->get();
        $post = Post::findOrFail($id);
        return view('webadmin.posts.edit', compact('post', 'categories', 'tags'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        
        $post = Post::findOrFail($id);
        $post->fill($request->all())->save();

        //IMAGE
        if ($request->file('file')) {
            $path = Storage::disk('public')->put('news_image', $request->file('file'));
            $post->fill(['file'=>asset($path)])->save();
        }

        //Tags
        $post->tags()->sync($request->get('tags'));

        return redirect()->route('posts.index')->with('info', 'Noticia Actualizada Correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Post::findOrFail($id)->delete();
        return redirect()->route('posts.index')->with('info', 'Noticia Eliminada Correctamente.');

    }
}
