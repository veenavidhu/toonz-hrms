<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_logo')->nullable();
            $table->text('company_address');
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->foreignId('state_id')->constrained('states')->onDelete('cascade');
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->string('postal_code');
            $table->string('phone_no');
            $table->string('fax_no')->nullable();
            
            $table->string('pf_no');
            $table->string('esi_no');
            $table->string('pan_no');
            $table->string('tan_no');
            $table->string('tds_circle');
            $table->string('uen');
            $table->string('gst_no')->nullable();
            
            // Registration Details
            $table->string('registration_no');
            $table->string('lst_no');
            $table->string('cst_no');
            $table->string('service_tax_no');
            $table->string('email_id');
            $table->string('website')->nullable();
            $table->text('reg_address');
            $table->string('reg_city');
            $table->string('reg_pin_no');
            
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
