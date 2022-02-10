<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create( 'tokens', static function ( Blueprint $table ) {
            $table->id()->unsigned()->autoIncrement();
            $table->integer( 'user_id' )->unsigned();
            $table->string( 'token' );
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
        Schema::dropIfExists( 'tokens' );
    }
}
