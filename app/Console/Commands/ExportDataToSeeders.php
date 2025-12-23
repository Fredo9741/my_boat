<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Type;
use App\Models\Action;
use App\Models\Zone;
use App\Models\Equipement;
use App\Models\Bateau;
use App\Models\Media;

class ExportDataToSeeders extends Command
{
    protected $signature = 'db:export-to-seeders {--tables=* : Specific tables to export}';
    protected $description = 'Export local database data to seeder files';

    public function handle()
    {
        $this->info('🚀 Exportation des données locales vers les seeders...');
        $this->newLine();

        $tables = $this->option('tables');
        $exportAll = empty($tables);

        if ($exportAll || in_array('types', $tables)) {
            $this->exportTypes();
        }

        if ($exportAll || in_array('actions', $tables)) {
            $this->exportActions();
        }

        if ($exportAll || in_array('zones', $tables)) {
            $this->exportZones();
        }

        if ($exportAll || in_array('equipements', $tables)) {
            $this->exportEquipements();
        }

        if ($exportAll || in_array('bateaux', $tables)) {
            $this->exportBateaux();
        }

        if ($exportAll || in_array('media', $tables)) {
            $this->exportMedia();
        }

        $this->newLine();
        $this->info('✅ Export terminé avec succès !');
        $this->info('📁 Fichiers générés dans database/seeders/');

        return Command::SUCCESS;
    }

    protected function exportTypes()
    {
        $this->info('📦 Export des types de bateaux...');
        $types = Type::orderBy('libelle')->get();
        $count = $types->count();

        $code = "<?php\n\nnamespace Database\\Seeders;\n\nuse Illuminate\\Database\\Seeder;\nuse Illuminate\\Support\\Facades\\DB;\n\nclass TypeSeeder extends Seeder\n{\n    public function run(): void\n    {\n";

        foreach ($types as $type) {
            $code .= "        DB::table('types')->insert([\n";
            $code .= "            'libelle' => " . $this->formatValue($type->libelle) . ",\n";
            $code .= "            'slug' => " . $this->formatValue($type->slug) . ",\n";
            $code .= "            'libelle_translations' => " . $this->formatJson($type->libelle_translations) . ",\n";
            $code .= "            'photo' => " . $this->formatValue($type->photo) . ",\n";
            $code .= "            'icone' => " . $this->formatValue($type->icone) . ",\n";
            $code .= "            'created_at' => now(),\n";
            $code .= "            'updated_at' => now(),\n";
            $code .= "        ]);\n\n";
        }

        $code .= "    }\n}\n";

        File::put(database_path('seeders/TypeSeeder.php'), $code);
        $this->line("   ✓ {$count} types exportés");
    }

    protected function exportActions()
    {
        $this->info('📦 Export des actions/badges...');
        $actions = Action::orderBy('libelle')->get();
        $count = $actions->count();

        $code = "<?php\n\nnamespace Database\\Seeders;\n\nuse Illuminate\\Database\\Seeder;\nuse Illuminate\\Support\\Facades\\DB;\n\nclass ActionSeeder extends Seeder\n{\n    public function run(): void\n    {\n";

        foreach ($actions as $action) {
            $code .= "        DB::table('actions')->insert([\n";
            $code .= "            'libelle' => " . $this->formatValue($action->libelle) . ",\n";
            $code .= "            'slug' => " . $this->formatValue($action->slug) . ",\n";
            $code .= "            'libelle_translations' => " . $this->formatJson($action->libelle_translations) . ",\n";
            $code .= "            'color' => " . $this->formatValue($action->color) . ",\n";
            $code .= "            'created_at' => now(),\n";
            $code .= "            'updated_at' => now(),\n";
            $code .= "        ]);\n\n";
        }

        $code .= "    }\n}\n";

        File::put(database_path('seeders/ActionSeeder.php'), $code);
        $this->line("   ✓ {$count} actions exportées");
    }

    protected function exportZones()
    {
        $this->info('📦 Export des zones...');
        $zones = Zone::orderBy('libelle')->get();
        $count = $zones->count();

        $code = "<?php\n\nnamespace Database\\Seeders;\n\nuse Illuminate\\Database\\Seeder;\nuse Illuminate\\Support\\Facades\\DB;\n\nclass ZoneSeeder extends Seeder\n{\n    public function run(): void\n    {\n";

        foreach ($zones as $zone) {
            $code .= "        DB::table('zones')->insert([\n";
            $code .= "            'libelle' => " . $this->formatValue($zone->libelle) . ",\n";
            $code .= "            'slug' => " . $this->formatValue($zone->slug) . ",\n";
            $code .= "            'libelle_translations' => " . $this->formatJson($zone->libelle_translations) . ",\n";
            $code .= "            'created_at' => now(),\n";
            $code .= "            'updated_at' => now(),\n";
            $code .= "        ]);\n\n";
        }

        $code .= "    }\n}\n";

        File::put(database_path('seeders/ZoneSeeder.php'), $code);
        $this->line("   ✓ {$count} zones exportées");
    }

    protected function exportEquipements()
    {
        $this->info('📦 Export des équipements...');

        if (!DB::getSchemaBuilder()->hasTable('equipements')) {
            $this->line("   ⊘ Table 'equipements' n'existe pas, skip");
            return;
        }

        $equipements = Equipement::orderBy('libelle')->get();
        $count = $equipements->count();

        $code = "<?php\n\nnamespace Database\\Seeders;\n\nuse Illuminate\\Database\\Seeder;\nuse Illuminate\\Support\\Facades\\DB;\n\nclass EquipementSeeder extends Seeder\n{\n    public function run(): void\n    {\n";

        foreach ($equipements as $eq) {
            $code .= "        DB::table('equipements')->insert([\n";
            $code .= "            'libelle' => " . $this->formatValue($eq->libelle) . ",\n";
            $code .= "            'categorie' => " . $this->formatValue($eq->categorie ?? 'autre') . ",\n";
            $code .= "            'icone' => " . $this->formatValue($eq->icone ?? null) . ",\n";
            $code .= "            'ordre' => " . $this->formatValue($eq->ordre ?? 0) . ",\n";
            $code .= "            'created_at' => now(),\n";
            $code .= "            'updated_at' => now(),\n";
            $code .= "        ]);\n\n";
        }

        $code .= "    }\n}\n";

        File::put(database_path('seeders/EquipementSeeder.php'), $code);
        $this->line("   ✓ {$count} équipements exportés");
    }

    protected function exportBateaux()
    {
        $this->info('📦 Export des bateaux...');
        $bateaux = Bateau::with(['type', 'zone', 'slogan'])->get();
        $count = $bateaux->count();

        $code = "<?php\n\nnamespace Database\\Seeders;\n\nuse Illuminate\\Database\\Seeder;\nuse App\\Models\\Bateau;\nuse App\\Models\\Type;\nuse App\\Models\\Zone;\nuse App\\Models\\Action;\n\nclass BateauSeeder extends Seeder\n{\n    public function run(): void\n    {\n";

        foreach ($bateaux as $bateau) {
            $code .= "        Bateau::create([\n";
            $code .= "            'visible' => " . ($bateau->visible ? 'true' : 'false') . ",\n";
            $code .= "            'occasion' => " . ($bateau->occasion ? 'true' : 'false') . ",\n";

            if ($bateau->type) {
                $code .= "            'type_id' => Type::where('slug', " . $this->formatValue($bateau->type->slug) . ")->first()->id,\n";
            } else {
                $code .= "            'type_id' => null,\n";
            }

            if ($bateau->zone) {
                $code .= "            'zone_id' => Zone::where('slug', " . $this->formatValue($bateau->zone->slug) . ")->first()->id,\n";
            } else {
                $code .= "            'zone_id' => null,\n";
            }

            if ($bateau->slogan) {
                $code .= "            'slogan_id' => Action::where('slug', " . $this->formatValue($bateau->slogan->slug) . ")->first()->id,\n";
            } else {
                $code .= "            'slogan_id' => null,\n";
            }

            $code .= "            'modele' => " . $this->formatValue($bateau->modele) . ",\n";
            $code .= "            'slug' => " . $this->formatValue($bateau->slug) . ",\n";
            $code .= "            'prix' => " . $this->formatValue($bateau->prix) . ",\n";
            $code .= "            'afficher_prix' => " . ($bateau->afficher_prix ? 'true' : 'false') . ",\n";
            $code .= "            'description' => " . $this->formatValue($bateau->description) . ",\n";
            $code .= "            'symboles' => " . $this->formatValue($bateau->symboles) . ",\n";
            $code .= "            'mots' => " . $this->formatValue($bateau->mots) . ",\n";
            $code .= "            'chantier' => " . $this->formatValue($bateau->chantier) . ",\n";
            $code .= "            'architecte' => " . $this->formatValue($bateau->architecte) . ",\n";
            $code .= "            'pavillon' => " . $this->formatValue($bateau->pavillon) . ",\n";
            $code .= "            'annee' => " . $this->formatValue($bateau->annee) . ",\n";
            $code .= "            'materiaux' => " . $this->formatValue($bateau->materiaux) . ",\n";
            $code .= "            'longueurht' => " . $this->formatValue($bateau->longueurht) . ",\n";
            $code .= "            'largeur' => " . $this->formatValue($bateau->largeur) . ",\n";
            $code .= "            'tirantdeau' => " . $this->formatValue($bateau->tirantdeau) . ",\n";
            $code .= "            'poidslegeencharges' => " . $this->formatValue($bateau->poidslegeencharges) . ",\n";
            $code .= "            'surfaceaupres' => " . $this->formatValue($bateau->surfaceaupres) . ",\n";
            $code .= "            'heuresmoteur' => " . $this->formatValue($bateau->heuresmoteur) . ",\n";
            $code .= "            'puissance' => " . $this->formatValue($bateau->puissance) . ",\n";
            $code .= "            'moteur' => " . $this->formatValue($bateau->moteur) . ",\n";
            $code .= "            'systemeantiderive' => " . $this->formatValue($bateau->systemeantiderive) . ",\n";
            $code .= "            'cabines' => " . $this->formatValue($bateau->cabines) . ",\n";
            $code .= "            'passagers' => " . $this->formatValue($bateau->passagers) . ",\n";
            $code .= "        ]);\n\n";
        }

        $code .= "    }\n}\n";

        File::put(database_path('seeders/BateauSeeder.php'), $code);
        $this->line("   ✓ {$count} bateaux exportés");
    }

    protected function exportMedia()
    {
        $this->info('📦 Export des médias...');

        if (!DB::getSchemaBuilder()->hasTable('media')) {
            $this->line("   ⊘ Table 'media' n'existe pas, skip");
            return;
        }

        $media = Media::with('bateau')->orderBy('ordre')->get();
        $count = $media->count();

        $code = "<?php\n\nnamespace Database\\Seeders;\n\nuse Illuminate\\Database\\Seeder;\nuse App\\Models\\Bateau;\nuse App\\Models\\Media;\n\nclass MediaSeeder extends Seeder\n{\n    public function run(): void\n    {\n";

        foreach ($media as $m) {
            if (!$m->bateau) continue;

            $code .= "        \$bateau = Bateau::where('slug', " . $this->formatValue($m->bateau->slug) . ")->first();\n";
            $code .= "        if (\$bateau) {\n";
            $code .= "            Media::create([\n";
            $code .= "                'bateau_id' => \$bateau->id,\n";
            $code .= "                'type' => " . $this->formatValue($m->type) . ",\n";
            $code .= "                'url' => " . $this->formatValue($m->url) . ",\n";
            $code .= "                'ordre' => " . $this->formatValue($m->ordre) . ",\n";
            $code .= "                'legende_fr' => " . $this->formatValue($m->legende_fr ?? null) . ",\n";
            $code .= "                'legende_en' => " . $this->formatValue($m->legende_en ?? null) . ",\n";
            $code .= "            ]);\n";
            $code .= "        }\n\n";
        }

        $code .= "    }\n}\n";

        File::put(database_path('seeders/MediaSeeder.php'), $code);
        $this->line("   ✓ {$count} médias exportés");
    }

    protected function formatValue($value)
    {
        if ($value === null) {
            return 'null';
        }

        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        if (is_numeric($value)) {
            return $value;
        }

        return "'" . addslashes((string)$value) . "'";
    }

    protected function formatJson($value)
    {
        if ($value === null) {
            return 'null';
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return "'" . addslashes($value) . "'";
            }
        }

        return "'" . addslashes(json_encode($value)) . "'";
    }
}
