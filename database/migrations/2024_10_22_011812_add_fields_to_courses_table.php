<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->text('lessons')->nullable();
            $table->text('about')->nullable();
            $table->text('benefits')->nullable();
            $table->text('reviews')->nullable();
            $table->text('tools')->nullable();
            $table->text('faqs')->nullable();
        });
    }

    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['lessons', 'about', 'benefits', 'reviews', 'tools', 'faqs']);
        });
    }
};
