<footer class="container">
    <p>&copy; developed by Mahmoud Ramadan</p>
</footer>
<script>const BASE_URL = "<?=BASE_URL?>";</script>
<script
        src="<?= BASE_URL ?>assets/js/jquery.min.js"></script>
<script src="<?= BASE_URL ?>assets/js/bootstrap.bundle.min.js"></script>
<?php
if (isset($data['js'])) {
    foreach ($data['js'] as $jsFile) {
        echo '<script src="' . BASE_URL . $jsFile . '?v=' . BASE_URL . filemtime($jsFile) . '"></script>';
    }
}
?>
</body>
</html>
