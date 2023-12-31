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
		Schema::create('attendees', function (Blueprint $table) {
			$table->id();
			$table->string('curp')->unique();
			$table->string('code')->nullable()->unique();
			$table->string('name');
			$table->string('email')->unique();
			$table->string('phone_number')->nullable()->unique();
			$table->integer('semester')->max(13)->nullable();
			$table->string('gender');
			$table->foreignId('career_id')->nullable()->constrained('careers')->cascadeOnDelete();
			$table->foreignId('workshop_id')->nullable()->constrained('workshops')->cascadeOnDelete();
			$table->foreignId('institution_id')->constrained('institutions')->cascadeOnDelete();
			$table->boolean('validated')->default(false);
			$table->timestamp('validated_at')->nullable();
			$table->string('validated_by')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('attendees');
	}
};
