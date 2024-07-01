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

            Artisan::call('make:model', ['name' => "Ahantu\\Models\\$model"]);
            $this->info("Model created for $model");
        }

        $this->createSeeders();
    }

    protected function createMigration($migrationName)
    {
        $timestamp = date('Y_m_d_His');
        $migrationFile = database_path("migrations/{$timestamp}_{$migrationName}.php");

        $stub = $this->getMigrationStub($migrationName);
        File::put($migrationFile, $stub);

        $this->info("Migration created: $migrationFile");
    }

    protected function getMigrationStub($migrationName)
    {
        $stub = File::get(__DIR__ . "/../Database/Migrations/stubs/{$migrationName}.stub");
        return $stub;
    }

    protected function createSeeders()
    {
        $seedersPath = __DIR__ . '/../Database/Seeders';
        File::copyDirectory($seedersPath, database_path('seeders'));

        $this->info('Seeders copied to database/seeders');
    }
}
