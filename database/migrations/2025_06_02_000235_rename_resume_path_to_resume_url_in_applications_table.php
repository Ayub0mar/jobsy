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
        Schema::table('applications', function (Blueprint $table) {
            $table->renameColumn('resume_path', 'resume_url');
        });
    }

    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->renameColumn('resume_url', 'resume_path');
        });
    }

};
