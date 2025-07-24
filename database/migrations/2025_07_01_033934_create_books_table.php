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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->integer('publication_year');
            $table->text('description');
            $table->longText('cover_image_data')->nullable();
            $table->string('original_cover_name')->nullable();
            $table->string('pdf_file_path')->nullable();
            $table->string('original_pdf_name')->nullable();
            $table->json('pages')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['cover_image_data', 'original_cover_name', 'pdf_file_path', 'original_pdf_name']);
        });
    }

};
