<?php
// database/migrations/2024_01_01_000003_create_care_logs_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareLogsTable extends Migration
{
    public function up()
    {
        Schema::create('care_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plant_id')->constrained()->onDelete('cascade');
            $table->enum('action_type', ['siram', 'pupuk', 'potong', 'semprot_hama']);
            $table->date('date');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('care_logs');
    }
}