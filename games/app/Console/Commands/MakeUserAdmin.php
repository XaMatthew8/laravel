<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MakeUserAdmin extends Command
{
    protected $signature = 'make:admin {email}';
    protected $description = 'Hace que un usuario sea administrador';

    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("No se encontró ningún usuario con el email: {$email}");
            return 1;
        }

        $user->admin = true;
        $user->save();

        $this->info("El usuario {$email} ahora es administrador.");
        return 0;
    }
} 