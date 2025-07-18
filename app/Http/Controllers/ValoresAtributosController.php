<?php

namespace App\Http\Controllers;

use App\Models\Attributes;
use App\Models\AttributesValues;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ValoresAtributosController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // $attributes = Attributes::where("status", "=", true)->get(); // actualizar a where status = 1 
    $valoresAttr =  AttributesValues::where("status", "=", true)->with('attribute')->get();
    return view('pages.attrValues.index', compact('valoresAttr'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $attributes = Attributes::where("status", "=", true)->get();
    return view('pages.attrValues.create', compact('attributes'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'valor' => 'required',
    ]);

    $AttValues = new AttributesValues();
    try {

      if ($request->hasFile("imagen")) {
        $file = $request->file('imagen');
        $routeImg = 'storage/images/imagen/';
        $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

        $this->saveImg($file, $routeImg, $nombreImagen);

        $AttValues->imagen = $routeImg . $nombreImagen;
        // $AttValues->name_image = $nombreImagen;
      }

      $AttValues->attribute_id = $request->attribute_id;
      $AttValues->valor = $request->valor;
      $AttValues->descripcion = $request->descripcion;
      $AttValues->color = $request->color;
      $AttValues->save();

      return redirect()->route('valoresattributes.index')->with('success', 'Publicación creado exitosamente.');
    } catch (\Throwable $th) {
      return response()->json(['messge' => 'Verifique sus datos ' . $th], 400);
    }
  }

  public function saveImg($file, $route, $nombreImagen)
  {
    $manager = new ImageManager(new Driver());
    $img =  $manager->read($file);


    if (!file_exists($route)) {
      mkdir($route, 0777, true); // Se crea la ruta con permisos de lectura, escritura y ejecución
    }

    $img->save($route . $nombreImagen);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Request $request, string $id)
  {

    $attributesValues = AttributesValues::with('attribute')
      ->whereHas('attribute', function ($query) use ($id) {
        $query->where('attributes_values.id', $id);
      })
      ->get();
    $attributes = Attributes::where("status", "=", true)->get(); // actualizar a where status = 1 
    $attributesValues = $attributesValues[0];


    return view('pages.attrValues.edit', compact('attributesValues', 'attributes'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $request->validate([
      'valor' => 'required',
    ]);
    $AttValues = AttributesValues::find($id);
    try {

      if ($request->hasFile("imagen")) {
        $file = $request->file('imagen');
        $routeImg = 'storage/images/imagen/';
        $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

        $this->saveImg($file, $routeImg, $nombreImagen);

        $AttValues->imagen = $routeImg . $nombreImagen;
        // $AttValues->name_image = $nombreImagen;
      }


      $AttValues->attribute_id = $request->attribute_id;
      $AttValues->valor = $request->valor;
      $AttValues->descripcion = $request->descripcion;
      $AttValues->color = $request->color;
      $AttValues->save();

      return redirect()->route('valoresattributes.index')->with('success', 'Publicación creado exitosamente.');
    } catch (\Throwable $th) {

      return response()->json(['messge' => 'Verifique sus datos ' . $th], 400);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  // public function borrar(Request $request)
  // {
  //   $id = $request->id;
  //   $service = AttributesValues::findOrfail($id);

  //   $service->status = false;

  //   $service->save();
  //   return response()->json(['message' => 'Registro eliminado.']);
  // }

  public function borrar(Request $request)
{
    $id = $request->id;
    $attributeValue = AttributesValues::findOrFail($id);

    $relatedProducts = $attributeValue->attributeProductValues()
        ->with('product')
        ->get()
        ->pluck('product.producto')
        ->filter()
        ->toArray();

    if (count($relatedProducts) > 0) {
        $productList = implode(', ', array_slice($relatedProducts, 0, 5)); // Mostrar hasta 5 productos
        $message = count($relatedProducts) > 5 
            ? "No se puede eliminar. Está siendo usado en $productList y otros más."
            : "No se puede eliminar. Está siendo usado en: $productList";
            
        return response()->json([
            'success' => false,
            'message' => $message
        ], 422);
    }

    $attributeValue->delete();
    
    return response()->json([
        'success' => true,
        'message' => 'Registro eliminado correctamente.'
    ]);
}

  public function updateVisible(Request $request)
  {
    // Lógica para manejar la solicitud AJAX
    //return response()->json(['mensaje' => 'Solicitud AJAX manejada con éxito']);
    try {
      $id = $request->id;

      $status = $request->status;

      $testimony = AttributesValues::findOrFail($id);

      $testimony->visible = $status;

      $testimony->save();

      return response()->json(['message' => 'Estado modificado.']);
    } catch (\Throwable $th) {
      return response()->json(['message' => $th], 400);
    }
  }
}
