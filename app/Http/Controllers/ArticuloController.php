<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Exception;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return Articulo::select('articulos.*','categorias.catNombre')
                            ->join('categorias','articulos.artCategoria','=','categorias.id')->get();
        }catch(Exception $e){
            return "Error: ".$e->getMessage();
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
            $articulo = new Articulo();
            $articulo->artCodigo = $request->artCodigo;
            $articulo->artNombre = $request->artNombre;
            $articulo->artPrecio = $request->artPrecio;
            $articulo->artCategoria = $request->artCategoria;
            $result = $articulo->save();
            if($result){
                $response = ['estado'=>true, 'mensaje'=>"Articulo agregado"];
            }else{
                $response = ['estado'=>false, 'mensaje'=>"Problemas al agregar el articulo"];
            }
        }catch(Exception $e){
            $response = ['estado'=>false, 'mensaje'=>$e->getMessage()];
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show(Articulo $articulo)
    {
        try{
            return Articulo::find($articulo->id);
        }catch(Exception $e){
            return "Error: ".$e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articulo $articulo)
    {
        try{
            $result = Articulo::findOrFail($articulo->id)->update($request->all());
            if($result){
                $response = ['estado'=>true,'mensaje'=>'Articulo actualizado'];
            }else{
                $response = ['estado'=>false,'mensaje'=>'Problemas al actualizar el articulo'];
            }
        }catch(Exception $e){
            $response = ['estado'=>false,'mensaje'=>$e->getMessage()];
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articulo $articulo)
    {
        try{
            $result = Articulo::findOrFail($articulo->id)->delete();
            if($result){
                $response = ['estado'=>true,'mensaje'=>'Articulo Eliminado'];
            }else{
                $response = ['estado'=>false,'mensaje'=>'Problemas al eliminar el articulo'];
            }
        }catch(Exception $e){
            $response = ['estado'=>false,'mensaje'=>$e->getMessage()];
        }
        return $response;
    }
}
