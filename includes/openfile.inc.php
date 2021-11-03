<?php
$path = $_GET["path"];

try {
    $fileName = $path;

    if (!file_exists($fileName)) {
        throw new Exception('File open failed');
    }

    // The function returns a pointer to the file if it is successful or zero if it is not. Files are opened for read or write operations.
    $file = fopen($fileName, "r");

    // Reads the file
    $content = fread($file, filesize($fileName));

    echo $content;

    // Close the file buffer
    fclose($file);
} catch (Throwable $t) {
    echo $t->getMessage();
}