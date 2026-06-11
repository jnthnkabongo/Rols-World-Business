<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Categorie;

// Create categories
Categorie::create([
    'nom' => 'Électronique',
    'description' => 'Catégorie pour les appareils électroniques'
]);

Categorie::create([
    'nom' => 'Chaussures',
    'description' => 'Catégorie pour les chaussures'
]);

echo "Categories created successfully!\n";
