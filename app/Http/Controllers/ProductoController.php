<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProductoFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class ProductoController extends Controller
{
    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $texto=trim($request->get('texto'));
            $productos=DB::table('producto as a')
            ->join('categoria as c','a.id_categoria','=','c.id_categoria')
            ->select('a.id_producto','a.nombre','a.codigo','a.stock','c.categoria','a.descripcion','a.imagen','a.estado')
            ->where('a.nombre','LIKE','%'.$texto.'%')
            ->orwhere('a.codigo','LIKE','%'.$texto.'%')
            ->orderBy('id_producto', 'desc')
            ->paginate(10);
            return view('almacen.producto.index', compact('productos',"texto"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias=DB::table('categoria')->where('status','=','1')->get();
        return view("almacen.producto.create",["categorias"=>$categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoFormRequest $request)
    {
        //
        $producto=new Producto;
        $producto->id_categoria=$request->input('id_categoria');
        $producto->codigo=$request->input('codigo');
        $producto->nombre=$request->input('nombre');
        $producto->stock=$request->input('stock');
        $producto->descripcion=$request->input('descripcion');
        $producto->estado='Activo';
        //SCRIP PARA SUBIR LA IMAGEN 

        if($request->hasFile("imagen")){
            $imagen=$request->file("imagen");
            $nombreimagen=str::slug($request->nombre).".".$imagen->guessExtension();
            $ruta=public_path("/imagenes/productos/");

            copy($imagen->getRealPath(),$ruta.$nombreimagen);

            $producto->imagen=$nombreimagen;
        }
        $producto->save();
        return Redirect()->route('producto.index');


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        //return view("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $producto=Producto::findOrFail($id);
        $categorias=DB::table('categoria')->where('status','=','1')->get();
        return view("almacen.producto.edit",["producto"=>$producto,"categorias"=>$categorias]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoFormRequest $request,$id)
    {
        //
        $producto=Producto::findOrFail($id);
        $producto->id_categoria=$request->input('id_categoria');
        $producto->codigo=$request->input('codigo');
        $producto->nombre=$request->input('nombre');
        $producto->stock=$request->input('stock');
        $producto->descripcion=$request->input('descripcion');
        $producto->estado='Activo';
        //SCRIP PARA SUBIR LA IMAGEN 

        if($request->hasFile("imagen")){
            $imagen=$request->file("imagen");
            $nombreimagen=str::slug($request->nombre).".".$imagen->guessExtension();
            $ruta=public_path("/imagenes/productos/");

            copy($imagen->getRealPath(),$ruta.$nombreimagen);

            $producto->imagen=$nombreimagen;
        }
        $producto->update();
        return Redirect()->route('producto.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $producto=Producto::findOrFail($id);
        $producto->estado='Inactivo';
        $producto->update();
        /* return Redirect::to('almacen/producto'); */
        return redirect()->route('producto.index');
    }
}
