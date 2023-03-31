<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\Models\Image;
use App\Models\Like;
use App\Models\Comment;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('image.create');
    }

    public function save(Request $request)
    {
        //Validación
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'required|image'
        ]);

        //Recoger los datos
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        //Asignar valores nuevo al objeto
        $user = Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $description;

        //Subir imagen al servidor
        if ($image_path) {
            //Poner nombre único
            $image_path_name = time() . $image_path->getClientOriginalName();

            //Guardar en la carpeta storage (storage/app/users)
            Storage::disk('images')->put($image_path_name, File::get($image_path));

            //Seteo el nombre de la imagen en el objeto
            $image->image_path = $image_path_name;
        }

        //Guarda todo en la base de datos
        $image->save();

        return redirect()->route('home')->with([
            'message' => 'La foto há sido subida correctamente!!'
        ]);
    }

    public function getImage($filename)
    {
        $file = Storage::disk('images')->get($filename);

        return new Response($file, 200);
    }

    public function detail($id)
    {
        $image = Image::find($id);

        return view('image.detail', [
            'image' => $image
        ]);
    }

    public function delete($id)
    {
        //obtiene el objeto del usuario
        $user = Auth::user();

        //obtiene el objeto de la imagen
        $image = Image::find($id);

        //consigue  comentario donde image_id sea igual al id
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();

        //cambiar $image->user->id a $image->user_id
        if ($user && $image && $image->user_id == $user->id) {
            //Eliminar los comentarios
            if ($comments && count($comments) >= 1) {
                foreach ($comments as $comment) {
                    //Hay que recorrer la tabla de comentarios y borrar todos los que tenga la imagen, y de igual manera con los likes e imagenes.
                    $comment->delete();
                }
            }

            //Eliminar los likes
            if ($likes && count($likes) >= 1) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }

            //Eliminar ficheros de imagen
            Storage::disk('images')->delete($image->image_path);

            //Eliminar registro de imagen
            $image->delete();

            //Mensaje de exito
            $message = array('message' => 'La imagen borró correctamente!!');
        } else {
            $message = array('message' => 'La imagen no se há borrado correctamente!!');
        }

        return redirect()->route('home')->with($message);
    }

    public function edit($id)
    {
        $user = Auth::user();
        $image = Image::find($id);

        if ($user && $image && $image->user_id == $user->id) {
            return view('image.edit', [
                'image' => $image
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function update(Request $request)
    {
        //Validación
        $validate = $this->validate($request, [
            'description' => 'required'
        ]);

        //Recoger los datos
        $image_id = $request->input('image_path');
        $image_path = $request->file('image_path');
        $description = $request->Input('description');

        //Obtener objeto imagen
        $image = Image::find($image_id);
        $image->description = $description;

        //Subir imagen al servidor
        if ($image_path != null) {
            //Poner nombre único
            $image_path_name = time() . $image_path->getClientOriginalName();

            //Guardar en la carpeta storage (storage/app/users)
            Storage::disk('images')->put($image_path_name, File::get($image_path));

            //Seteo el nombre de la imagen en el objeto
            $image->image_path = $image_path_name;
        }

        //Actualizar registro
        $image->update();

        return redirect()->route('image.detail', ['id' => $image_id])->with(['message' => 'Imagen actualizada con éxito']);
    }
}
