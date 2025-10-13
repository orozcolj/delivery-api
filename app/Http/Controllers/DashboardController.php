<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // La función view() busca un archivo llamado 'dashboard.blade.php'
        // dentro de la carpeta 'resources/views/' y lo muestra.
        return view('dashboard');
}
}
