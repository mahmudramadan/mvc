<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?= BASE_URL; ?>">Home</a>
            </li>
            <?php
            if (isset($_SESSION['isLogged'])) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL; ?>admin-page">News Page For Admin</a>
                </li>
            <?php } ?>
        </ul>
        <div class="form-inline my-2 my-lg-0">
            <?php
            if (isset($_SESSION['isLogged'])) {
                echo '<span style="color:#fff">Hi ' . $_SESSION['userLoggedName'] . "</span>";
                echo '<a class="btn btn-outline-success my-2 my-sm-0" href="'.BASE_URL.'logout-user">Logout</a>';
            } else {
                echo '<a class="btn btn-outline-success my-2 my-sm-0" href="'.BASE_URL.'login">Login</a>';
            }
            ?>
        </div>
    </div>
</nav>
