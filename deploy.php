<?php
$zip = new ZipArchive;
if ($zip->open(__DIR__ . '/deploy.zip') === TRUE) {
    $zip->extractTo(__DIR__);
    $zip->close();
    echo "✅ Deployment complete!";
    unlink(__DIR__ . '/deploy.zip'); // cleanup
} else {
    echo "❌ Failed to extract.";
}
