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
        Schema::table('projects', function (Blueprint $table) {

            //creare il campo della foreign key
            $table->unsignedBigInteger('type_id')->nullable()->after('id');

            //creare la foreign key
            $table->foreign('type_id')
                ->references('id') //riferimento alla colonna id
                ->on('types') //creare la relazione alla tabella types
                ->onDelete('set null'); //in ogni oggetto cancellato sarà presente un tipo NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
            $table->dropColumn('type_id');
        });
    }
};
