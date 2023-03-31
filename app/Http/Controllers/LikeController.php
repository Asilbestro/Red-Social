<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class LikeController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userIdentificado = Auth::user();
        $likes = Like::where('user_id', $userIdentificado->id)
            ->orderBy('id', 'desc')->get();

        return view('like.index', [
            'likes' => $likes
        ]);
    }

    public function like($image_id)
    {
        //Recoger los datos del usuario y la iamgen
        $user_identificado = Auth::user();

        //Condicion para comporbar si existe el like de es usuario
        $isset_like = Like::where('user_id', $user_identificado->id)
            ->where('image_id', $image_id)
            ->count();

        if ($isset_like == 0) {
            $like = new Like();
            $like->user_id = $user_identificado->id;
            //Con int se convierte el string $image_id en un entero 
            $like->image_id = (int)$image_id;

            //Guardar
            $like->save();

            return response()->json([
                'like' => $like
            ]);
        } else {
            return response()->json([
                'message' => 'El like ya existe'
            ]);
        }
    }

    public function dislike($image_id)
    {
        //Recoger los datos del usuario y la iamgen
        $user_identificado = Auth::user();

        //Condicion para comporbar si existe el like y no duplicarlo
        $like = Like::where('user_id', $user_identificado->id)
            ->where('image_id', $image_id)
            ->first();

        if ($like) {
            //Elijminar like
            $like->delete();

            return response()->json([
                'like' => $like,
                'message' => 'Has dado dislike a la publicación'
            ]);
        } else {
            return response()->json([
                'message' => 'El like no existe'
            ]);
        }
    }
}
