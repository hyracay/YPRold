<?php
if (isset($_GET['file'])) {
    $file = urldecode($_GET['file']);

    // Check if the file exists
    if (file_exists($file)) {
        // Set headers to force download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        flush(); // Flush system output buffer
        readfile($file);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "No file specified.";
}
