<?php
require __DIR__ . "/layout/header.php";
require __DIR__ . "/layout/nav.php";
if (isset($filePath)) {
    require __DIR__ . "/$filePath.php";
}
require __DIR__ . "/layout/footer.php";
