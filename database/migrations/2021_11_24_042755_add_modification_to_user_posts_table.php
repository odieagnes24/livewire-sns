<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModificationToUserPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_posts', function (Blueprint $table) {
            $table->after('media_type_src', function($table){
                $table->string('visibility')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_posts', function (Blueprint $table) {
            $table->dropColumn('visibility');
        });
    }
}
