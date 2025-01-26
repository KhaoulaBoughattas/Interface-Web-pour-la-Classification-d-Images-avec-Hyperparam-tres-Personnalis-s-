<?php
$file = "results.json";
if (file_exists($file)) {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="results.json"');
    readfile($file);
    exit;
} else {
    echo "Results file not found.";
}
?>
