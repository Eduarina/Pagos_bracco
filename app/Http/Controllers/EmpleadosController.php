<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class EmpleadosController extends Controller
{
    public function index(Request $request){

     $mail = $request->input("user");
     $pass = md5( $request->input("contra") );

      $user = \DB::table('tb_empleados')->where([
        ['Correo', '=', $mail]
      ])->first();

      if( $user ){
        if( $user->Pass == null ){
            DB::table('tb_empleados')->where(['id_empleado', '=', $user->id_empleado])->update([ 'Pass' => $pass ]);
            session()->put('id', $user->id_empleado);
            session()->put('name', $user->Nombre);
            return redirect('/home');
        }
        if( $user->Pass == $pass ){
            session()->put('id', $user->id_empleado);
            session()->put('name', $user->Nombre);
            return redirect('/home');
        }      
      }else{
        return back();
      }

    }

    public function fordwardHome(){
        
    }

    public function usuarios(){

        $user = DB::table('tb_empleados')->get();

        return view('usuarios', ['users' => $user]);

    }

    public function create(Request $rq){

        DB::table("tb_empleados")->insert([
            'Nombre' => $rq->input('user'),
            'Correo' => $rq->input('mail'),
            'Estado' => 1
        ]);

    }

}
