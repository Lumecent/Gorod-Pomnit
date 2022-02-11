<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfirmCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create( 'confirm_codes', static function ( Blueprint $table ) {
            $table->id()->unsigned()->autoIncrement();
            $table->integer( 'user_id' )->unsigned();
            $table->integer( 'code' );
            $table->string( 'action' );
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists( 'confirm_codes' );
    }
}
