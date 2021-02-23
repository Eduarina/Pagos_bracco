<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Models\ProveedoresController;
use Carbon\Carbon;

class PagosController extends Controller
{
    public function index(){

        if(!session()->get('id')) return redirect('/');
    
        $id = session()->get('id');

        $datos = DB::table( 'tb_solicitudes' )
                    ->join('tb_proveedores', 'tb_proveedores.id_proveedor', '=', 'tb_solicitudes.id_proveedor' )
                    ->join('ctg_area', 'tb_proveedores.id_area', '=', 'ctg_area.id_area' )
                    ->select( 'tb_proveedores.Nombre as Nombre', 'ctg_area.Nombre as Area', DB::raw('sum(tb_solicitudes.Monto) as Total'))
                    ->where([
                        ['tb_solicitudes.Estado', '=', '5']
                    ])
                    ->groupBy('Nombre', 'Area')
                    ->orderBy('Total', 'desc')
                    ->limit(6)
                    ->get();

        if( $id != 1 ){
            $datos = $datos->where(['tb_solicitudes.id_empleado', '=', $id]);
        }                        

        $provs = DB::table('tb_proveedores')
                    ->join('ctg_area', 'tb_proveedores.id_area', '=', 'ctg_area.id_area' )
                    ->select( 'tb_proveedores.id_proveedor as ID', 'tb_proveedores.Nombre as Nombre', 'tb_proveedores.id_area as Id', 'ctg_area.Nombre as Area' )
                    ->get();

        $areas = \DB::table('ctg_area')->get();

        $mias = DB::table('tb_solicitudes')
                    ->orderBy('Fecha_solicitud','desc')
                    ->get();
        if( $id != 1 ){
            $mias = $mias->where(['tb_solicitudes.id_empleado', '=', $id]);
        }         

        $total = DB::table('tb_solicitudes');
        if( $id != 1 )  $total = $total->where('id_empleado', "=", $id)->count();
        else $total = $total->count();

        $pendiente = DB::table('tb_solicitudes')
                    ->where([
                        ['Estado','=','3']
                    ])->get();
        if( $id != 1 ) $pendiente = $pendiente->where(['id_empleado', "=", $id])->count();
        else $pendiente = $pendiente->count();

        $pagados = DB::table('tb_solicitudes')
                    ->where([
                        ['Estado','=','5']
                    ])->get();
        if( $id != 1 ) $pagados = $pagados->where(['id_empleado', "=", $id])->count();
        else $pagados = $pagados->count();

        $pagos = DB::table('tb_solicitudes')
                    ->where([
                        ['Estado','=','5']
                    ])->get();
        if( $id != 1 ) $pagos = $pagos->where(['id_empleado', "=", $id]);
        $pagos = $pagos->sum('Monto');

        $monto = DB::table('tb_solicitudes')->where('Estado', '=', '5')->sum('Monto');

        
         return view("template" ,[
                        'provs' => $provs,
                        'areas' => $areas,
                        'solicitado' => $total,
                        'pendientes' => $pendiente,
                        'pagados' => $pagados,
                        'total' => $pagos,
                        'mias' => $mias,
                        'montos' => $datos
                    ]);

    }

    public function save(Request $req){

        $prov = $req->input('prov');
        $monto = $req->input('monto');
        $desc = $req->input('descripcion');
        $fecha = Carbon::now();

        \DB::table('tb_solicitudes')->insert([
            'id_proveedor' => $prov,
            'id_empleado' => 1,
            'Descripcion' => $desc,
            'Monto' => $monto,
            'Fecha_solicitud' => $fecha,
            'Estado' => 3
        ]);

    }

    public function pagos(){

        if(!session()->get('id')) return redirect('/');

        $pagos = DB::table("tb_solicitudes")
                    ->join('tb_empleados', 'tb_solicitudes.id_empleado', '=', 'tb_empleados.id_empleado')
                    ->join('tb_proveedores', 'tb_solicitudes.id_proveedor', '=', 'tb_proveedores.id_proveedor')
                    ->join('ctg_area', 'tb_proveedores.id_area', '=', 'ctg_area.id_area')
                    ->select(
                        'tb_solicitudes.id_solicitud as ID',
                        'tb_solicitudes.Monto as Monto',
                        'tb_solicitudes.Comprobante as Comprobante',
                        'tb_solicitudes.Descripcion as Descripcion',
                        'tb_solicitudes.Fecha_solicitud as Fecha',
                        'tb_solicitudes.Estado as Edo',
                        'tb_empleados.Nombre as Solicita',
                        'ctg_area.Nombre as Area',
                        'tb_proveedores.Nombre as Proveedor'
                    )
                    ->get();
        //echo $pagos;
        return view('pagos', ['all' => $pagos]);

    }

    public function cuentas(Request $req){

        $cuenta = DB::table('tb_solicitudes')
                    ->join('tb_proveedores', 'tb_solicitudes.id_proveedor', '=', 'tb_proveedores.id_proveedor')
                    ->where( 'tb_solicitudes.id_solicitud', '=', $req->input("ID") )
                    ->select('tb_proveedores.Cuenta')
                    ->get();

        return $cuenta;

    }

    public function pagar( Request $req ){

        $req->validate([
            'file' => 'required|mimes:jpg,png,pdf|max:2048',
        ]);

        $filename = 'Pago_'.$req->input('cuenta').'_'.Carbon::now()->format('d_m_Y').'.'.$req->file->extension();
        //echo $filename;
        $req->file->move(public_path('comprobantes'), $filename);

        DB::table('tb_solicitudes')
            ->where('id_solicitud', $req->input('ID'))
            ->update([
                'Comprobante' => $filename,
                'Fecha_pago' => Carbon::now(),
                'Estado' => 5
            ]);

    }

}


