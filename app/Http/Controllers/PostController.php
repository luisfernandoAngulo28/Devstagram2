<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //este constructor nos ayuda a ser mas segura la pagina
    //protege las url
    public function __construct()
    {
         $this->middleware('auth')->except(['show','index']);
    }
    //
    public function index(User $user){
      //dd($user); 
      // dd('Desde Muro');
      // dd(auth()->user());
      //dd($user->id);
      $posts=Post::where('user_id',$user->id)->latest()->paginate(5);
     // dd($posts);
        return view('dashboard', [
          'user' => $user, 
          'posts' => $posts
        ]);
    }
    // nos crea el formulario
    public function create()
    {
     // dd('Creando Post...');
     return view('posts.create');
    }

    //Almacena en la base de datos
    public function store(Request $request){
       //dd(' Creando Publicacion ');
       $this->validate($request,[
          'titulo' => 'required|max:255',
          'descripcion' => 'required',
          'imagen' => 'required'
       ]);
       /*
       Post::create([
        'titulo' => $request->titulo,
        'descripcion'=>$request->descripcion,
        'imagen'=>$request->imagen,
        'user_id'=> auth()->user()->id
       ]);*/

       // Otra forma
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();
        //Otra forma con relacion (Eloquend) para este requiere 
        //la relacion en los modelos
        $request->user()->posts()->create([
          'titulo' => $request->titulo,
          'descripcion' => $request->descripcion,
          'imagen' => $request->imagen,
          'user_id' => auth()->user()->id
      ]);
       return redirect()->route('posts.index', auth()->user()->username);
    }

    //Para poder Mostrar usamos el show
    public function show(User $user, Post $post)
    {
        return view('posts.show', [
          'post' => $post,
          'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
      //dd('Elimnando',$post->id);
      $this->authorize('delete', $post);
      $post->delete();
      // Eliminar la imagen
      $imagen_path = public_path('uploads/' . $post->imagen);

      if(File::exists($imagen_path)) {
          unlink($imagen_path);
      }

      return redirect()->route('posts.index',auth()->user()->username);
      
    }

}
