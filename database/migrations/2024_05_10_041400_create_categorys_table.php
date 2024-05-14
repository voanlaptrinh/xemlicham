<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categorys', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();

            $table->text('metaTitle')->nullable();
            $table->text('metaDescription')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('categorys')->onDelete('cascade');
            $table->timestamps();
        });

        DB::table('categorys')->insert([
            [
                'title' => 'Lịch tháng',
                'metaTitle' => 'Lịch tháng',
                'metaDescription' => 'Lịch tháng',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Lịch năm',
                'metaTitle' => 'Lịch năm',
                'metaDescription' => 'Lịch năm',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorys');
    }
};
