<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;

class ProveedorController extends Controller
{
    public function add(Request $request){
        $id = 0;
        $id = \DB::table("tb_proveedores")->insertGetId([
            'Nombre' => $request->input("name_prov"),
            'id_area' => $request->input("taller"),
            'Estado' => 1
        ]);
        return $id;
    }

    public function proveedores(){

        $provs = DB::table('tb_proveedores')
                    ->join('ctg_area', 'tb_proveedores.id_area', '=', 'ctg_area.id_area')
                    ->select(
                        'tb_proveedores.id_proveedor as ID',
                        'tb_proveedores.Nombre as Proveedor',
                        'ctg_area.Nombre as Area',
                        'tb_proveedores.Telefono as Telefono',
                        'tb_proveedores.Correo as Correo',
                        'tb_proveedores.Cuenta as Cuenta'
                        )
                    ->get();
        return view('proveedores', ['proveedores' => $provs]);

    }

    public function details(Request $rq){

        $info = DB::table('tb_proveedores')
                    ->where('id_proveedor', '=', $rq->input('id'))
                    ->get();
        return $info;

    }

    public function update(Request $req){

        DB::table('tb_proveedores')
                ->where('id_proveedor', '=', $req->input('ID'))
                ->update([
                    'Nombre' => $req->input('prov'),
                    'Telefono' => $req->input('tel'),
                    'Correo' => $req->input('mail'),
                    'Cuenta' => $req->input('count'),
                ]);

        return redirect('/proveedores');

    }

}
