<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Invocamos a la Entidad Posts
use App\Post;

//Invocamos a la Entidad Category
use App\Category;

//Invocamos a la Entidad Tag
use App\Tag;
use Carbon\Carbon;

class NewController extends Controller
{
    
	public function index(){

		$dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

		$posts = Post::where('status', 'PUBLISHED')->orderBy('id', 'DESC')->paginate(6);

		return view('web.noticias.index', compact('posts', 'dateCarbon'));

	}

	public function show($slug){

		$dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

		$post = Post::where('slug', $slug)->first();

		return view('web.noticias.show', compact('post', 'dateCarbon'));

	}

	public function category($slug){

		$dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

		//Obtenemos solo el ID de la Categoria mediante el método PLUCK
		$category=Category::where('slug', $slug)->pluck('id')->first();

		$posts=Post::where('category_id', $category)->where('status', 'PUBLISHED')->orderBy('id', 'DESC')->paginate(5);

		return view('web.noticias.index', compact('posts', 'dateCarbon'));

	}

	public function tag($slug){

		$dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

		$posts=Post::whereHas('tags', function($query) use($slug){

			$query->where('slug', $slug);//Consición que afecta a las etiquetas de acuerdo a su relación con los posts

		})->orderBy('id', 'DESC')->paginate(5);

		return view('web.noticias.index', compact('posts', 'dateCarbon'));

	}

	public function webIndex(){

		$dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

		$posts = Post::where('status', 'PUBLISHED')->latest()->take(3)->get();
//dd($posts);
		return view('web.index', compact('posts', 'dateCarbon'));

	}

}
