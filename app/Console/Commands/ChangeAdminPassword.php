<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ChangeAdminPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:change-password {email?} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change admin password via command line';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get email from argument or ask
        $email = $this->argument('email') ?? $this->ask('Email de l\'administrateur', 'admin@myboat.re');

        // Find user
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("❌ Aucun utilisateur trouvé avec l'email : {$email}");
            return Command::FAILURE;
        }

        // Get password from option or ask
        $password = $this->option('password') ?? $this->secret('Nouveau mot de passe (min. 8 caractères)');

        if (strlen($password) < 8) {
            $this->error('❌ Le mot de passe doit contenir au moins 8 caractères');
            return Command::FAILURE;
        }

        // Confirm password
        if (!$this->option('password')) {
            $confirm = $this->secret('Confirmer le mot de passe');

            if ($password !== $confirm) {
                $this->error('❌ Les mots de passe ne correspondent pas');
                return Command::FAILURE;
            }
        }

        // Update password
        $user->password = bcrypt($password);
        $user->save();

        $this->info("✅ Mot de passe changé avec succès pour : {$email}");

        return Command::SUCCESS;
    }
}
