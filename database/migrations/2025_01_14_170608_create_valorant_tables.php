<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Models\Agents;
use Illuminate\Models\User;
use Illuminate\Support\Facades\Hash;
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
                $table->id('id');  // Columna 'id' con AUTO_INCREMENT (es la clave primaria)
                $table->char('agent_id', 36);  // UUID del agente
                $table->unsignedBigInteger('user_id');  // 'user_id' no debe ser AUTO_INCREMENT
                $table->text('content');
                $table->timestamps();  // 'created_at' y 'updated_at' generados automáticamente

                $table->foreign('agent_id')
                    ->references('id')->on('agents')
                    ->onDelete('cascade');
                $table->foreign('user_id')
                    ->references('id')->on('users')  // Hacer referencia a la tabla 'users'
                    ->onDelete('cascade');
            });
        }


        // Comment Likes
        if (!Schema::hasTable('comment_likes')) {
            Schema::create('comment_likes', function (Blueprint $table) {
                $table->id('user_id');    // UUID del usuario
                $table->unsignedBigInteger('comment_id');  // ID del comentario
                $table->primary(['user_id', 'comment_id']);
                $table->timestamps();

                $table->foreign('user_id')
                    ->references('id')->on('users')  // Se asegura que la columna `id` en `user` sea BIGINT o CHAR(36)
                    ->onDelete('cascade');
                $table->foreign('comment_id')
                    ->references('id')->on('comments')  // Tabla 'comments'
                    ->onDelete('cascade');
            });
        }

        // User Likes
        if (!Schema::hasTable('user_likes')) {
            Schema::create('user_likes', function (Blueprint $table) {
                $table->id('user_id');  // UUID del usuario
                $table->char('agent_id', 36); // UUID del agente
                $table->timestamp('created_at')->useCurrent();
                $table->primary(['user_id', 'agent_id']);

                $table->foreign('user_id')
                    ->references('id')->on('users')  // Mantenemos 'user'
                    ->onDelete('cascade');
                $table->foreign('agent_id')
                    ->references('id')->on('agents')
                    ->onDelete('cascade');
            });
        }
        // Replies
        if (!Schema::hasTable('replies')) {
            Schema::create('replies', function (Blueprint $table) {
                $table->id();  // Clave primaria (AUTO_INCREMENT)
                $table->foreignId('comment_id')->constrained()->onDelete('cascade');  // Referencia al comentario
                $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Referencia al usuario
                $table->text('content');  // Contenido de la respuesta
                $table->timestamps();  // Tiempos 'created_at' y 'updated_at'
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

        // replay likes
        if (!Schema::hasTable('reply_likes')) {
            Schema::create('reply_likes', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('reply_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_likes');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('user_likes');
        Schema::dropIfExists('user');
        Schema::dropIfExists('agent_abilities');
        Schema::dropIfExists('agents');
        Schema::dropIfExists('replies');
        Schema::dropIfExists('reply_likes');
    }
};
