<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

$tables = DB::select('SHOW TABLES');
$database = env('DB_DATABASE');
$output = "-- MySQL Backup - " . date('Y-m-d H:i:s') . "\n";
$output .= "-- Database: {$database}\n\n";

foreach ($tables as $table) {
    $tableName = $table->{'Tables_in_' . $database};
    $output .= "-- Table: {$tableName}\n";
    $createTable = DB::select("SHOW CREATE TABLE {$tableName}")[0];
    $output .= $createTable->{'Create Table'} . ";\n\n";
    
    $rows = DB::table($tableName)->get();
    foreach ($rows as $row) {
        $values = array_map(function($v) {
            return is_null($v) ? 'NULL' : "'" . addslashes($v) . "'";
        }, (array)$row);
        $output .= "INSERT INTO {$tableName} VALUES (" . implode(',', $values) . ");\n";
    }
    $output .= "\n";
}

file_put_contents(__DIR__ . '/backups/backup-' . date('Ymd-His') . '.sql', $output);
echo "Backup created successfully!\n";

