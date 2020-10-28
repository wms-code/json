<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('maintb_id');
            $table->bigInteger('ctin');
            $table->char('cfs', 2);
            $table->char('cfs3b', 2);
            $table->string('fldtr1');  
            $table->string('flprdr1');            
            $table->timestamps();
        });

        Schema::create('invoice_items', function (Blueprint $table) {
            $table->bigInteger('invoice_id');            
            $table->Integer('num'); 
            $table->json('itm_det');
            $table->double('val', 4,2);
            $table->char('inv_typ', 2);  
            $table->char('pos', 5); 
            $table->string('idt'); 
            $table->char('rchrg', 5);
            $table->string('chksum');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('invoice_items');
    }
}
