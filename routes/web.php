<?php

use App\Models\Maintb;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;



Route::get('/', function () {

    Artisan::call('migrate:fresh');    
  
    $jsonobj= json_decode (file_get_contents(base_path('test.JSON') ),true);

    $data['gstin']=$jsonobj['gstin'];
    $data['fp']=$jsonobj['fp'];
    //$data['b2b']=json_encode($jsonobj['b2b']);
     $dbs= Maintb::create($data);

    // Invoice Table 

    foreach ($jsonobj['b2b'] as  $record) {

        $invoice['maintb_id']=$dbs->id;
        $invoice['ctin']=$record['ctin'];
        $invoice['cfs']=$record['cfs'];
        $invoice['cfs3b']=$record['cfs3b'];
        $invoice['fldtr1']=$record['fldtr1'];
        $invoice['flprdr1']=$record['flprdr1'];
        $ins=Invoice::create($invoice);  

        // InvoiceItem Table 

        foreach ($record['inv'] as  $item) {

            $items['invoice_id']=$ins->id;
            $items['num']=$item['itms'][0]['num'];
            $items['itm_det']=json_encode($item['itms'][0]['itm_det']);
            $items['val']=$item['val'];
            $items['inv_typ']=$item['inv_typ'];
            $items['pos']=$item['pos'];
            $items['idt']=$item['idt'];
            $items['rchrg']=$item['rchrg'];
            $items['chksum']=$item['chksum'];

            InvoiceItem::create($items);
        }
        
        

    }

   return  $maindbs = Maintb::with('invoices.items')->first();


});
