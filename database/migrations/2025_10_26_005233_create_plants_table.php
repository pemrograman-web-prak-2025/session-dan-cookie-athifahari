<?php
// database/migrations/2024_01_01_000001_create_plants_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantsTable extends Migration
{
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('species');
            $table->string('photo')->nullable();
            $table->text('notes')->nullable();
            $table->string('category')->default('Umum');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plants');
    }
}