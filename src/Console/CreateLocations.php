<?php

namespace Ahantu\Locations\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateLocations extends Command
{
    protected $signature = 'make:locations';
    protected $description = 'Create models, migrations, and seeders for locations';

    public function handle()
    {
        $models = ['Province', 'District', 'Sector', 'Cell', 'Village'];

        foreach ($models as $model) {
            $migrationName = 'create_' . Str::plural(strtolower($model)) . '_table';
            $this->createMigration($migrationName);

            Artisan::call('make:model', ['name' => "Ahantu\\Locations\\Database\\Models\\$model"]);
            $this->info("Model created for $model");
        }

        $this->createSeeders();
    }

    protected function createMigration($migrationName)
    {
        $timestamp = date('Y_m_d_His');
        $migrationFile = database_path("migrations/{$timestamp}_{$migrationName}.php");

        $stub = $this->getMigrationStub($migrationName);
        File::put($migrationFile, "<?php\n\n" . $stub);

        $this->info("Migration created: $migrationFile");
    }

    protected function getMigrationStub($migrationName)
    {
        $stubPath = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Database" . DIRECTORY_SEPARATOR . "Migrations" . DIRECTORY_SEPARATOR . "stubs" . DIRECTORY_SEPARATOR . "{$migrationName}.stub";
        $this->info("Looking for stub at: {$stubPath}"); // for debugging
        if (File::exists($stubPath)) {
            return File::get($stubPath);
        }
        throw new \Exception("Stub not found: {$stubPath}");
    }


    protected function createSeeders()
    {
        $seedersPath = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Database" . DIRECTORY_SEPARATOR . "Seeders";
        File::copyDirectory($seedersPath, database_path('seeders'));

        $this->info('Seeders copied to database/seeders');
    }
}
