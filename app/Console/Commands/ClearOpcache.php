<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearOpcache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'opcache:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vider le cache OPcache';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!function_exists('opcache_reset')) {
            $this->error('OPcache n\'est pas activé sur ce serveur.');
            return 1;
        }

        if (opcache_reset()) {
            $this->info('✅ Cache OPcache vidé avec succès !');
            $this->comment('💡 Les modifications de code PHP seront maintenant prises en compte.');
            return 0;
        } else {
            $this->error('❌ Erreur lors du vidage du cache OPcache.');
            return 1;
        }
    }
}
