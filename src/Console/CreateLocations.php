<?php

namespace Ahantu\Locations\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
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

            $this->createSeeder($model);

            $time++;
        }

        $this->runSeeders();
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

    protected function createSeeder($model)
    {
        $seederName = Str::plural($model) . 'Seeder';
        $stubPath = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Database" . DIRECTORY_SEPARATOR . "Seeders" . DIRECTORY_SEPARATOR . "stubs" . DIRECTORY_SEPARATOR . strtolower($seederName) . ".stub";
        $seederFile = database_path("seeders/{$seederName}.php");

        if (File::exists($stubPath)) {
            $stub = File::get($stubPath);
            File::put($seederFile, "<?php\n\n" . $stub);
            $this->info("Seeder created: $seederFile");
        } else {
            $this->error("Stub not found: {$stubPath}");
        }
    }

    protected function runSeeders()
    {
        $seeders = ['ProvincesSeeder', 'DistrictsSeeder', 'SectorsSeeder', 'CellsSeeder', 'VillagesSeeder'];
        foreach ($seeders as $seeder) {
            Artisan::call('db:seed', ['--class' => $seeder]);
            $this->info("Seeder run: $seeder");
        }
    }
}
