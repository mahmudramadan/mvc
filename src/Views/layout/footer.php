<footer class="container">
    <p>&copy; developed by Mahmoud Ramadan</p>
</footer>
<script>const BASE_URL = "<?=BASE_URL?>";</script>
<script
        src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<?php
if (isset($data['js'])) {
    foreach ($data['js'] as $jsFile) {
        echo '<script src="' . $jsFile . '?v='.filemtime($jsFile).'"></script>';
    }
}
?>
</body>
</html>
