<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
   public function store2(Request $request)
   {
    //return "Desde Imagen Controller";
    $imagen=$request->file('file');
    //genera un id unico el uuid para la imagen
    $nombreImagen=Str::uuid().".".$imagen->extension();
    $imagenServidor=Image::make($imagen);
    $imagenServidor->fit(1000,1000);//cuanto medira ancho
    $imagenPath=public_path('uploads').'/'.$nombreImagen;
    $imagenServidor->save($imagenPath);

    return response()->json(['imagen'=>$imagen->extension()]);
   }
   public function store(Request $request)
   {
       $imagen = $request->file('file');

       $nombreImagen = Str::uuid() . "." . $imagen->extension();

       $imagenServidor = Image::make($imagen);
       $imagenServidor->fit(1000, 1000);

       $imagenPath = public_path('uploads') . '/' . $nombreImagen;
       $imagenServidor->save($imagenPath);

       return response()->json(['imagen' => $nombreImagen ]);
   }
}
