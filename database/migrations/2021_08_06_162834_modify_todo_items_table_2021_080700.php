<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTodoItemsTable2021080700 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('todo_items', function (Blueprint $table) {
            $table->foreign('todo_id', 'ti_ti_fk')
                ->references('id')
                ->on('todos')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('todo_items', function (Blueprint $table) {
            $table->dropForeign('ti_ti_fk');
        });
    }
}
