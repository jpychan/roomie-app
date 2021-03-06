<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseFractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_fractions', function (Blueprint $table) {
            $table->primary(['expense_id', 'borrower_id']);
            $table->integer('expense_id')->unsigned();
            $table->foreign('expense_id')
                  ->references('id')->on('expenses')
                  ->onDelete('cascade');
            $table->integer('borrower_id')->unsigned();
            $table->foreign('borrower_id')->references('id')->on('users');
            $table->integer('amount_owed_cents');
            $table->boolean('paid');
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
        Schema::drop('expense_fractions');
    }
}
