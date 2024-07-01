<?php

namespace Ahantu\Locations\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateLocations extends Command
{
    protected $signature = 'ahantu:install';
    protected $description = 'Create models, migrations, and seeders for Rwanda locations from provinces to villages.';

    public function handle()
    {
        $models = ['Province', 'District', 'Sector', 'Cell', 'Village'];
        $time = time();

        foreach ($models as $model) {
            $migrationName = 'create_' . Str::plural(strtolower($model)) . '_table';
            $this->createMigration($migrationName, $time);

            $this->copyModel($model);
            $this->info("Model created for $model");

            $time++;
        }

        $this->createSeeders();
    }

    protected function createMigration($migrationName, $time)
    {
        $timestamp = date('Y_m_d_His', $time);
        $migrationFile = database_path("migrations/{$timestamp}_{$migrationName}.php");

        $stub = $this->getMigrationStub($migrationName);
        File::put($migrationFile, "<?php\n\n" . $stub);

        $this->info("Migration created: $migrationFile");
    }

    protected function getMigrationStub($migrationName)
    {
        $stubPath = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Database" . DIRECTORY_SEPARATOR . "Migrations" . DIRECTORY_SEPARATOR . "stubs" . DIRECTORY_SEPARATOR . "{$migrationName}.stub";
        if (File::exists($stubPath)) {
            return File::get($stubPath);
        }
        throw new \Exception("Stub not found: {$stubPath}");
    }

    protected function copyModel($model)
    {
        $sourcePath = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Database" . DIRECTORY_SEPARATOR . "Models" . DIRECTORY_SEPARATOR . "{$model}.php";
        $destinationPath = app_path("Models/{$model}.php");

        if (File::exists($sourcePath)) {
            File::copy($sourcePath, $destinationPath);
        } else {
            throw new \Exception("Model file not found: {$sourcePath}");
        }
    }


    protected function createSeeders()
    {
        $seedersPath = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Database" . DIRECTORY_SEPARATOR . "Seeders";
        File::copyDirectory($seedersPath, database_path('seeders'));

        $this->info('Seeders copied to database/seeders');
    }
}
