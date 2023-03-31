<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request)
    {
        //Validación de campos
        $validate = $this->validate($request, [
            'image_id' => 'integer|required',
            'content' => 'string|required'
        ]);

        //Recoger datos del formulario
        $user = Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        //Asigno los valores al objeto
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        //Guardar en mi BD
        $comment->save();

        //Redirección
        return redirect()->route('image.detail', ['id' => $image_id])->with([
            'message' => 'Se há publicado tu comentario'
        ]);
    }

    public function delete($id)
    {
        //Conseguir datos del usuario logueado
        $user_identificado = Auth::user();

        //Conseguir objeto del comentario
        $comment = Comment::find($id);

        //Comprobar si soy el dueño del comentario o de la publicación
        if ($user_identificado && ($comment->user_id == $user_identificado->id || $comment->image->user_id == $user_identificado->id)) {
            //Eliminar el comentario
            $comment->delete();

            //Redirección
            return redirect()->route('image.detail', ['id' => $comment->image_id])->with([
                'message' => 'Se há borrado tu comentario'
            ]);
        } else {
            return redirect()->route('image.detail', ['id' => $comment->image_id])->with([
                'message' => 'El comentario no se há eliminado'
            ]);
        }
    }
}
