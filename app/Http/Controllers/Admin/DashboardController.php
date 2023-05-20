<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller{
    public function __construct(){
        $this->middleware(['auth','check:2']);
    }

    public function manage(){

        $data['activePage'] = ['dashboard' => 'dashboard'];
        $data['breadcrumb'] = [
            ['title' => 'Home'],
        ];
        return view('dashboard' , [
            'data' => $data,
        ]);
    }
}
