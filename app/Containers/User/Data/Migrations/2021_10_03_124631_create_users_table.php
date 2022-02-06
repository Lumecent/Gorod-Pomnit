<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create( 'users', function ( Blueprint $table ) {
            $table->id()->unsigned()->autoIncrement();
            $table->timestamps();
            $table->string( 'first_name' )->nullable();
            $table->string( 'last_name' )->nullable();
            $table->string( 'email' )->nullable();
            $table->string( 'password' )->nullable();
            $table->string( 'avatar' )->nullable();
            $table->string( 'country' )->nullable();
            $table->string( 'city' )->nullable();
            $table->integer( 'count_photos' )->default( 0 );
            $table->integer( 'count_reports' )->default( 0 );
            $table->integer( 'count_likes' )->default( 0 );
            $table->boolean( 'verified' )->default( 0 );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists( 'users' );
    }
}
