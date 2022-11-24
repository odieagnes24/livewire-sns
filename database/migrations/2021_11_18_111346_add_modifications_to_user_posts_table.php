<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModificationsToUserPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_posts', function (Blueprint $table) {
            $table->after('contents', function($table){
                $table->string('media_type')->nullable();
                $table->text('media_type_src')->nullable();
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
            $table->dropColumn('media_type');
            $table->dropColumn('media_type_src');
        });
    }
}
