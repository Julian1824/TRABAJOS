<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;
class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $datos['empleados']=Empleado::paginate(5);

      
      $sql = 'SELECT * FROM Empleados';
      $empleados = DB::select($sql);


        return view("empleado.index",$empleados);   
    }

    public function pdf()
    {
        $datos=Empleado::paginate();

        $pdf = PDF::loadView('empleado.pdf',['empleados'=>$datos]);
        //$pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
       // Descargar PDF return $pdf->download('__invoice.pdf');

       /// return view("empleado.pdf",$datos);
    
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("empleado.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$datosEmpleado = $request->all();---Mostrar los mesajes Formato json    return response()->json($datosEmpleado);

            $campos=[
                'Name'=>'required|string|max:100',
                'lastname'=>'required|string|max:100',
                'seclastname'=>'required|string|max:100',
                'Email'=>'required|email',
                'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',
            ];

            $mensaje=[
                'Name.required'=>'El Nombre es requerido',
                'lastname.required'=>'El Nombre es requerido',
                'seclastname.required'=>'El Apellido es requerido',
                'Email.required'=>'El Correo es requerido',
                'Foto.required'=>'La :attribute es requerido',
            ];
            $this->validate($request,$campos,$mensaje);

        $datosEmpleado = $request->except('_token');
        if($request->hasfile('Foto')){
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }
        Empleado::insert($datosEmpleado);
      return redirect('empleado')->with('mensaje','Empleado Agregado con exito');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado=Empleado::findOrFail($id);  
        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $campos=[
            'Name'=>'required|string|max:100',
            'lastname'=>'required|string|max:100',
            'seclastname'=>'required|string|max:100',
            'Email'=>'required|email',
            
        ];

        $mensaje=[
            'Name.required'=>'El Nombre es requerido',
            'lastname.required'=>'El Nombre es requerido',
            'seclastname.required'=>'El Apellido es requerido',
            'Email.required'=>'El Correo es requerido',
            'Foto.required'=>'La :attribute es requerido',
        ];

        if($request->hasfile('Foto')){
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg',];
            $mensaje=['Foto.required'=>'La :attribute es requerido',];
        }
        $this->validate($request,$campos,$mensaje);
        
        $datosEmpleado = $request->except('_token','_method');
        if($request->hasfile('Foto')){
            $empleado=Empleado::findOrFail($id);
            Storage::delete('public/'.$empleado->Foto);
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }

        Empleado::where('id','=',$id)->update($datosEmpleado);

        $empleado=Empleado::findOrFail($id);  
        //return view('empleado.edit', compact('empleado'));
        return redirect("empleado")->with('mensaje','Empleado Editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado=Empleado::findOrFail($id);
        if(Storage::delete('public/'.$empleado->Foto)){

            Empleado::destroy($id);

        }
        
        return redirect("empleado")->with('mensaje','Empleado Borrado');
    }
}
