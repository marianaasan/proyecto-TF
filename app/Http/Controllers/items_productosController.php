<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\proveedores;
use App\productos;
use DB;
use App\items_productos;

class items_productosController extends Controller

   {
 public function index()  // index: Mostrar registros existentes (GET)
    {

        $productos=productos::all();
        $proveedores=categorias::all();
        $items_productos=DB::table('items_productos')->select('items_productos.fecha_compra')->join('items_producto.id_producto','=','productos.id_producto')->join('items_productos.id_proveedor','=','proveedores.id_proveedor')->get(); 

        return view('items_productos.index')->with('items_productos',$items_productos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()  //create: Mostrar nuevos datos a crear (GET)
    {
         $proveedores=proveedores::all();
         $productos=productos::all();
         return view ('items_productos.create')->with ('proveedores',$proveedores)->with ('productos',$productos); //carpeta provincia - archivo create
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)  //store: Crear nuevos datos (POST)
    {
   
            $request->validate([

            'fecha_compra' => 'required',

        ],[
            'required' =>'campo obligatorio',
           
        ]);

        $items_productos=new items_productos();
        $items_productos->id_producto=$request->id_producto; 
        $items_productos->id_proveedor=$request->id_proveedor;
     	$items_productos->fecha_compra=$request->fecha_compra; 
       
        $items_productos->save();

   return redirect()->route('ortopedia.items_productos.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)  //show: Mostrar un registro (GET)
    {
       // dd($id);
         $productos=productos::findOrfail($id);
         $categorias=categorias::all();
         $productos=DB::table('productos')->select('productos.producto as productos','productos.id_producto','categorias.categoria as categorias','categorias.id_categoria','productos.precio','productos.stock')->join('categorias','categorias.id_categoria','=','productos.id_categoria')->where('productos.id_producto','=',$id)->get(); 
          //  $categorias=categorias::all();
            return view('productos.show')->with('productos',$productos)->with('categorias',$categorias);
         // ->where('compromisos.id_compromiso','=',$id)->get(); 
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)  //edit: Mostrar un registro a modificar (GET)
    {
        
       // $productos  = productos::findOrFail($request->id_producto);
       //return view('productos.edit')->with('productos', $productos);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)  //update: Modificar un registro (PUT)
    {
        
        $productos=productos::findOrfail($request->id_producto);
        $productos->producto=$request->producto;
        $productos->id_categoria=$request->id_categoria;
       // $productos->id_producto= $request->id_producto;
		$productos->precio=$request->precio;
        $productos->stock=$request->stock;
        $productos->save();
        return redirect()->route('ortopedia.productos.index',$request->id_producto);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)  //destroy: Eliminar un registro (DELETE)
   {
      // dd($id); 
    $productos=productos::findOrfail($id);
    $productos->delete();
    //$productos = productos::all();
       
    return redirect::back();
    }
}




}
