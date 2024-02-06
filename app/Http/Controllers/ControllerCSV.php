<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerCSV extends Controller
{
    
    public function uploadCsv(){
        return view('pages.admin.view_upload_csv');
    }
}
