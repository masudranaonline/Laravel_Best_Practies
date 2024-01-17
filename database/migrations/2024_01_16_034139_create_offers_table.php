<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Constans\Status;
use NunoMaduro\Collision\Adapters\Phpunit\State;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->integer('price');
            $table->string('status')->default(Status::DRAFT);
            $table->foreignId('author_id')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offers', function(Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropIfExists();
        });
    }
};
