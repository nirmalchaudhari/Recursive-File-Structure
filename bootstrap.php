<?php

include("core/db.php");
include("config/db.php");
$db = new db($db['dbhost'], $db['dbuser'], $db['dbpass'], $db['dbname']);

include("core/MigrationSeeders.php");

$migrationSeederDirectory = __DIR__;
$migrationSeederDirectory =  "{$migrationSeederDirectory}/migrations-seeders";

$preOperations = new MigrationSeeder($db, $migrationSeederDirectory);
$migrations = ['flstrcture-migration.sql'];
$preOperations->createMigrationSeeder($migrations);
$seeders = ['flstruct-seeder.txt'];
$preOperations->createMigrationSeeder($seeders, false);
