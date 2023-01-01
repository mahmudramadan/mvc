<?php
require __DIR__ . "/layout/header.php";
require __DIR__ . "/layout/nav.php";
if (isset($data['filePath'])) {
    require __DIR__ . "/".$data['filePath'].".php";
}
require __DIR__ . "/layout/footer.php";
