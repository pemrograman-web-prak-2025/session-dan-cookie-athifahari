<?php
// database/migrations/2024_01_01_000002_create_care_schedules_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('care_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plant_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['siram', 'pupuk', 'potong', 'semprot_hama']);
            $table->integer('interval_days');
            $table->date('next_date');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('care_schedules');
    }
}