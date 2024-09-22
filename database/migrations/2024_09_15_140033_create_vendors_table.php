<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id(); // Primary key, auto-incremented
            $table->unsignedBigInteger('user_id'); // Foreign key linking to the users table
            $table->string('shop_name'); // Vendor's shop name
            $table->string('address'); // Shop address
            $table->string('phone_number'); // Vendor's contact number
            $table->string('image_url')->nullable(); // URL for the vendor's image
            $table->timestamps(); // created_at and updated_at

            // Define foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}
