<?php

/**
 * Script to clean boat descriptions in the scraped JSON data
 * - Converts literal \n to actual newlines
 * - Removes excessive newlines (max 2 consecutive)
 * - Cleans up trailing backslashes and weird patterns
 * - Trims excess whitespace
 */

$jsonFile = __DIR__ . '/../database/seeders/bateaux_scraped_data.json';

echo "Reading JSON file...\n";
$jsonContent = file_get_contents($jsonFile);

if ($jsonContent === false) {
    die("Error: Could not read the JSON file.\n");
}

echo "Parsing JSON data...\n";
$boats = json_decode($jsonContent, true);

if ($boats === null) {
    die("Error: Could not parse JSON data. " . json_last_error_msg() . "\n");
}

echo "Found " . count($boats) . " boats to process.\n\n";

$cleanedCount = 0;

foreach ($boats as $index => &$boat) {
    if (!isset($boat['description']) || empty($boat['description'])) {
        continue;
    }

    $originalDescription = $boat['description'];
    $cleaned = $originalDescription;

    // Replace literal \n with actual newlines
    $cleaned = str_replace('\n', "\n", $cleaned);

    // Remove patterns like \n\n\ or similar trailing backslashes
    $cleaned = preg_replace('/\\\+\s*$/', '', $cleaned);
    $cleaned = preg_replace('/\n\\\+/', "\n", $cleaned);

    // Replace multiple consecutive newlines with maximum 2 newlines
    $cleaned = preg_replace('/\n{3,}/', "\n\n", $cleaned);

    // Trim excess whitespace from the entire description
    $cleaned = trim($cleaned);

    // Remove trailing and leading whitespace from each line
    $lines = explode("\n", $cleaned);
    $lines = array_map('trim', $lines);
    $cleaned = implode("\n", $lines);

    // Remove empty lines at the beginning and end
    $cleaned = trim($cleaned);

    if ($cleaned !== $originalDescription) {
        $boat['description'] = $cleaned;
        $cleanedCount++;

        echo "Cleaned boat #" . ($index + 1) . " - " . ($boat['modele'] ?? 'Unknown') . "\n";
        echo "  Original length: " . strlen($originalDescription) . " chars\n";
        echo "  Cleaned length: " . strlen($cleaned) . " chars\n";
        echo "  Before: " . substr(str_replace("\n", "\\n", $originalDescription), 0, 100) . "...\n";
        echo "  After:  " . substr(str_replace("\n", "\\n", $cleaned), 0, 100) . "...\n\n";
    }
}

echo "\nCleaned $cleanedCount boat descriptions.\n";

// Create backup of original file
$backupFile = $jsonFile . '.backup.' . date('Y-m-d_H-i-s');
echo "Creating backup at: $backupFile\n";
copy($jsonFile, $backupFile);

// Save cleaned data back to JSON file
echo "Saving cleaned data to JSON file...\n";
$jsonOutput = json_encode($boats, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

if ($jsonOutput === false) {
    die("Error: Could not encode JSON data. " . json_last_error_msg() . "\n");
}

$result = file_put_contents($jsonFile, $jsonOutput);

if ($result === false) {
    die("Error: Could not write to JSON file.\n");
}

echo "\nSuccess! Cleaned data saved to: $jsonFile\n";
echo "Backup saved to: $backupFile\n";
echo "\nTotal boats processed: " . count($boats) . "\n";
echo "Descriptions cleaned: $cleanedCount\n";
