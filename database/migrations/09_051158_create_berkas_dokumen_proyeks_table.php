<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('berkas_dokumen_proyeks', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('template_dokumen')->nullable();
    $table->string('approval')->nullable();
    $table->timestamps();

    $table->foreign('template_dokumen')
          ->references('id')->on('berkas_dokumen_proyeks')
          ->onDelete('set null')
          ->onUpdate('cascade');
});
    }

    public function down(): void
{
    Schema::dropIfExists('dokumen_proyek');
}

};
