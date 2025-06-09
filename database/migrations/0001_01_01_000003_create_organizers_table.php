<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('organizers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->unique() // satu user hanya bisa jadi satu organizer
                ->constrained()
                ->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->string('address');
            $table->string('logo')->nullable();
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('organizers');
    }
};