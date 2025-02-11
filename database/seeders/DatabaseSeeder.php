<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Agents;
use Illuminate\Support\Facades\Log;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        for ($i=0; $i <10 ; $i++) {
            User::create([
                'username' => 'user'.$i,
                'password' => Hash::make('user'.$i),
                'role' => 'user',
            ]);
        }

        // Agents
        $json = File::get(database_path('data/agents.json'));
        $agents = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('Error en el JSON: ' . json_last_error_msg());
            return;
        }

        foreach ($agents as $agent) {
            Log::info('Insertando agente: ' . $agent['name']);
            try {
                $createdAgent = Agents::create([
                    'id' => $agent['id'],
                    'type' => $agent['type'],
                    'name' => $agent['name'],
                    'photo' => $agent['photo'],
                    'wallpaper' => $agent['wallpaper'],
                    'description' => $agent['description'],
                ]);

                foreach (['q', 'e', 'c', 'x'] as $abilityKey) {
                    if (isset($agent[$abilityKey])) {
                        $createdAgent->abilities()->create([
                            'ability_key' => $abilityKey,
                            'header' => $agent[$abilityKey]['header'],
                            'body' => $agent[$abilityKey]['body'],
                            'video' => $agent[$abilityKey]['video'],
                        ]);
                    }
                }

                // LikedBy
                if (isset($agent['likedBy'])) {
                    foreach ($agent['likedBy'] as $userId) {
                        DB::table('user_likes')->insert([
                            'user_id' => $userId,
                            'agent_id' => $createdAgent->id,
                        ]);
                    }
                }
            } catch (\Exception $e) {
                Log::error('Error al insertar el agente: ' . $e->getMessage());
            }
        }

    }
}
