<?php
$targetFolder = __DIR__ . '/../cv-mitra-jaya-web/storage/app/public';
$linkFolder = __DIR__ . '/storage';
symlink($targetFolder, $linkFolder);

echo 'symlink process successfull complated';
