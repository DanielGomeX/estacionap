<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Yajra\Datatables\Datatables;
use PDF;
use Illuminate\Support\Facades\DB;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);  //Middleware    }
}
    public function index(Request $request) //**verifica el rol para mostrar la vista de administrador */
    {
        $request->user()->authorizeRoles(['admin']);
        return view('estacionapp.administrador.administrador');
    }
    public function getUsers() //**trae las variables a mostrar en reporte */
    {
        $users = User::select(['rut','name','last_name','email','phone']);
        return Datatables::of($users)->make(true);
    }
    public function pdfUsers()
    {
        $users = DB::table('users')->get();
        $pdf = PDF::loadView('estacionapp.administrador.reporteUsuarios', ['users' => $users]);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream();
    }
    public function xlsxExport()
    {
        return Excel::download(new UsersExport, 'ususarios_estacionapp.xlsx');
    }
}
