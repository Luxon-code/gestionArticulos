<?php

namespace App\Http\Controllers;

use App\Mail\enviarCorreo;
use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Verifica si el usuario existe
     *
     * @param Request $request
     * @return void
     */
    public function inciarSesion(Request $request){
        try{
            $result = Usuario::where('usuNombre', $request->usuNombre)->where('usuContraseña',md5($request->usuContraseña))->get();
            if($result->count()>0){
                $response = ['estado'=>true];
            }else{
                $response = ['estado'=>false,'mensaje'=>'Nombre de usuario o contraseña incorrectas'];
            }
        }catch(Exception $e){
            $response = ['estado'=>false,'mensaje'=>$e->getMessage()];
        }
        return $response;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $usuario = new Usuario();
            $usuario->usuNombre = $request->usuNombre;
            $usuario->usuContraseña = md5($request->usuContraseña);
            $usuario->usuCorreo = $request->usuCorreo;
            $result = $usuario->save();
            if($result){
                Mail::to($request->usuCorreo)->send(new enviarCorreo($usuario));
                $response = ['estado'=>true,'mensaje'=>'Usuario creado'];
            }else{
                $response = ['estado'=>false,'mensaje'=>'Problemas al crear Usuario'];
            }
        }catch(Exception $e){
            $response = ['estado'=>false,'mensaje'=>$e->getMessage()];
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        //
    }
}
