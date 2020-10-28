<?php

use App\Models\Maintb;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;



Route::get('/', function () {

    Artisan::call('migrate:fresh');    
  
     $jsonobj= json_decode (file_get_contents(base_path('test.JSON') ),true);

   

    $data=[
        'gstin' =>$jsonobj['gstin'],
        'fp' =>$jsonobj['fp'],
        'b2b' =>json_encode($jsonobj['b2b']),

    ];



     $dbs= Maintb::create($data);
   return  $maindbs = Maintb::all();



  

});
