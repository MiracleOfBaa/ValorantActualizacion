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
        // Agents
        if (!Schema::hasTable('agents')) {
            Schema::create('agents', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('type');
                $table->string('name');
                $table->string('photo');
                $table->string('wallpaper');
                $table->text('description');
                $table->timestamps();  // 'created_at' y 'updated_at' generados automáticamente
            });
        }

        // User
        if (!Schema::hasTable('user')) {
            Schema::create('user', function (Blueprint $table) {  // Mantenemos 'user'
                $table->uuid('id')->primary();  // Usando UUID como clave primaria
                $table->string('username')->unique();
                $table->string('password');
                $table->enum('role', ['user', 'admin'])->default('user');
                $table->timestamps();  // 'created_at' y 'updated_at' generados automáticamente
            });
        }

        // Agent Abilities
        if (!Schema::hasTable('agent_abilities')) {
            Schema::create('agent_abilities', function (Blueprint $table) {
                $table->id();
                $table->char('agent_id', 36);  // UUID del agente
                $table->char('ability_key', 1);
                $table->string('header', 255);
                $table->text('body');
                $table->string('video', 255)->nullable();
                $table->timestamps();

                $table->foreign('agent_id')
                    ->references('id')->on('agents')
                    ->onDelete('cascade');
            });
        }

        // Comments
        if (!Schema::hasTable('comments')) {
            Schema::create('comments', function (Blueprint $table) {
                $table->id('id');
                $table->char('agent_id', 36);  // UUID del agente
                $table->char('user_id', 36);   // UUID del usuario
                $table->text('content');
                $table->timestamps();  // 'created_at' y 'updated_at' generados automáticamente
                $table->foreign('agent_id')
                    ->references('id')->on('agents')
                    ->onDelete('cascade');
                $table->foreign('user_id')
                    ->references('id')->on('user')  // Mantenemos 'user' para la tabla de usuarios
                    ->onDelete('cascade');
            });
        }

        // Comment Likes
        if (!Schema::hasTable('comment_likes')) {
            Schema::create('comment_likes', function (Blueprint $table) {
                $table->char('user_id', 36);    // UUID del usuario
                $table->unsignedBigInteger('comment_id');  // ID del comentario
                $table->primary(['user_id', 'comment_id']);
                $table->timestamps();  // 'created_at' y 'updated_at' generados automáticamente

                $table->foreign('user_id')
                    ->references('id')->on('user')  // Tabla 'user'
                    ->onDelete('cascade');
                $table->foreign('comment_id')
                    ->references('id')->on('comments')  // Tabla 'comments'
                    ->onDelete('cascade');
            });
        }

        // User Likes
        if (!Schema::hasTable('user_likes')) {
            Schema::create('user_likes', function (Blueprint $table) {
                $table->char('user_id', 36);  // UUID del usuario
                $table->char('agent_id', 36); // UUID del agente
                $table->timestamp('created_at')->useCurrent();
                $table->primary(['user_id', 'agent_id']);

                $table->foreign('user_id')
                    ->references('id')->on('user')  // Mantenemos 'user'
                    ->onDelete('cascade');
                $table->foreign('agent_id')
                    ->references('id')->on('agents')
                    ->onDelete('cascade');
            });
        }

        // Contact Messages
        if (!Schema::hasTable('contact_messages')) {
            Schema::create('contact_messages', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100);
                $table->string('email', 255);
                $table->text('message');
                $table->timestamps();  // 'created_at' y 'updated_at' generados automáticamente
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
        Schema::dropIfExists('agent_abilities');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('comment_likes');
        Schema::dropIfExists('user');  // Mantenemos 'user'
        Schema::dropIfExists('user_likes');
        Schema::dropIfExists('contact_messages');
    }
};
