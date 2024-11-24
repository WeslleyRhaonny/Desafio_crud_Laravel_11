<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Constraint\Constraint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('status_transacoes', function (Blueprint $table) {
            $table->id();
            $table->string("nome", 40);
        });

        Schema::create('transacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('status_id')->nullable()->constrained('status_transacoes')->nullOnDelete();
            $table->string('cpf', 14);
            $table->double('valor');
            $table->integer('id_arquivo_atual')->nullable();
            $table->foreignId('criado_por_id')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
            
        });

        Schema::create('arquivos', function (Blueprint $table) {
            $table->id();
            $table->string('arquivo', 255);
            $table->foreignId('transacao_id')->nullable()->constrained('transacoes')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {   
        Schema::dropIfExists('status_transacoes');
        Schema::dropIfExists('transacoes');
        Schema::dropIfExists('arquivos');
    }
};
