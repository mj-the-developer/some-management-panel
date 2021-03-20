<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('national_code')->nullable();
            $table->enum('marital_status', [ 'متاهل', 'مجرد' ])->nullable();
            $table->integer('kids_qty')->nullable();
            $table->integer('under_supervision_qty')->nullable();
            $table->enum('education_status', [ 'بی سواد', 'سیکل', 'دیپلم', 'فوق دیپلم', 'لیسانس', 'فوق لیسانس', 'دکترا' ])->nullable();
            $table->string('insurance_status')->nullable();
            $table->text('address')->nullable();
            $table->string('landline_phone')->nullable();
            $table->string('phone')->nullable();
            $table->text('supportive_org_status')->nullable();
            $table->text('physical_status')->nullable();
            $table->longText('members_physical_status')->nullable();
            $table->longText('members_patient_status')->nullable();
            $table->longText('members_education_status')->nullable();
            $table->string('job')->nullable();
            $table->boolean('working_ability')->nullable();
            $table->enum('home_status', [ 'استیجاری', 'صاحب ملک' ])->nullable();
            $table->bigInteger('home_deposit_amount')->nullable();
            $table->bigInteger('home_rent_amount')->nullable();
            $table->boolean('has_car')->nullable();
            $table->bigInteger('monthly_rent_amount')->nullable();
            $table->text('furniture')->nullable();
            $table->bigInteger('monthly_need_amount')->nullable();
            $table->text('non_cash_need')->nullable();
            $table->longText('details')->nullable();
            $table->text('credit_card')->nullable();
            $table->boolean('has_problem_solved')->nullable();
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
        Schema::dropIfExists('poors');
    }
}
