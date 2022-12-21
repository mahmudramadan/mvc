<main role="main">
    <div class="container">
        <div class="row">
            <h1 style="margin: auto;text-align: center">Login page</h1>
        </div>
        <form class="form-signin">
            <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72"
                 height="72">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" id="submitButton" type="submit">Sign in</button>

            <div id="form-error"></div>
        </form>
    </div> <!-- /container -->
</main>

