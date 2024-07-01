# aimedidierm/ahantu

A Laravel package to help developers seed Rwanda locations data (province, district, sector, cell, village) in Laravel applications.

## 🚀 Installation

Install this package as a dependency using [Composer](https://getcomposer.org).

```bash
composer require --dev aimedidierm/ahantu
```

## 🛠️ Usage

### Step 1: Publish the Configuration

After installing the package, you can publish the configuration file to customize it according to your needs.

```bash
php artisan vendor:publish --provider="Ahantu\Locations\LocationsServiceProvider"
```

### Step 2: Run the Artisan Command

To create models, migrations, and seeders for the locations, run the following Artisan command:

```bash
php artisan ahantu:install
```

This command will generate the necessary files and directories:

- Models: `Province`, `District`, `Sector`, `Cell`, `Village`
- Migrations: for creating the corresponding tables
- Seeders: for populating the tables with Rwanda location data

### Step 3: Run the Migrations and Seeders

After generating the files, run the migrations and seeders to create and populate the tables in your database.

```bash
php artisan migrate
php artisan db:seed --class=LocationsSeeder
```

## Contributing

Contributions are welcome!

## 📜 License

The aimedidierm/ahantu package is free and unencumbered software released into the public domain. Please see the [MIT LICENSE](MITLICENSE) for more information.
