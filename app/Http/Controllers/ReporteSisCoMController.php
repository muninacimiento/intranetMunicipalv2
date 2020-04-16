<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;

class ReporteSisCoMController extends Controller
{
    public function index(Request $request)
    {

    	/*
         * Definimos variable que contendrá la fecha actual del sistema
         */
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

    	return view('siscom.reporte.index', compact('dateCarbon'));

    }
}
