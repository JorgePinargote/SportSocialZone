<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Publicacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Events\NewComment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Comment::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = request()->all();
        $request->validate([
            'idpublicacion' => 'required|string',
            'texto'=> 'required|string'
        ]);
        
        $publicacion = Publicacion::find($input['idpublicacion']);
        
        if($publicacion != null){
            $comment = new Comment(['userid' => Auth::user()->id, 
                                    'username' => Auth::user()->name,  
                                    'avatar' => Auth::user()->avatar,
                                    'comentario' => $input['texto']]);

            $publicacion->comentarios()->save($comment);   
            
            //event(new NewComment($comment));
            broadcast(new NewComment($comment))->toOthers();
            
            return $comment->toJson();
        }

        return response()->json([
            'Message' => 'publicacion no encontrada'
        ],400 );
        //
    }


    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();  
        return response()->json([
            'Message' => 'Comentario eliminado correctamente'
        ],200);  
    }


    public function commentByPublicacion($idpublicacion){
        $publi = Publicacion::find($idpublicacion);

        if($publi != null){
            return $publi->comentarios;
        }

        return response()->json(['Messaje'=> 'Publicacion no encontrada'],400);
    }



    public function idnoticia(Comment $comment){
        $publicacion = $comment->publicacion;
        return $publicacion->idnoticia;
    }


}
