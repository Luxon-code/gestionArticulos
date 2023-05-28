<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Exception;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return Categoria::all();
        }catch(Exception $e){
            return "Error: " . $e->getMessage();
        }
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
            $categoria = new Categoria();
            $categoria->catNombre = $request->catNombre;
            $result = $categoria->save();
            if($result){
                $response = ['estado'=>true, 'mensaje'=>"Categoria agregada correctamente"];
            }else{
                $response = ['estado'=>false, 'mensaje'=>"Problemas al agregar la categoria"];
            }
        }catch(Exception $e){
            $response = ['estado'=>false, 'mensaje'=>$e->getMessage()];
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        try{
            return Categoria::find($categoria->id);
        }catch(Exception $e){
            return "Error: " . $e->getMessage();
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        try{
            $result=Categoria::findOrfail($categoria->id)->update($request->all());
            if($result){
                $response = ['estado'=>true,'mensaje'=>'Categoría actualizada'];
            }else{
                $response = ['estado'=>false,'mensaje'=>'Problemas al actualizar categoria'];
            }
        }catch(Exception $e){
            $response = ['estado'=>false,'mensaje'=>$e->getMessage()];
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        try{
            $result = Categoria::findOrfail($categoria->id)->delete();
            if($result){
                $response = ['estado'=>true, 'mensaje'=>'Categoria Eliminada'];
            }else{
                $response = ['estado'=>false, 'mensaje'=>'Problemas al eliminar la categoria'];
            }
        }catch(Exception $e){
            $response = ['estado'=>false, 'mensaje'=>$e->getMessage()];
        }
        return $response;
    }
}
