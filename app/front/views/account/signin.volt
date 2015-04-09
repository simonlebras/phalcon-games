<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <h1 class="text-center">Sign in</h1>
        <form method="post" action="/account/signin" autocomplete="off">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Login" required="true">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                       required="true">
            </div>
            <button type="submit" class="btn btn-success btn-block">Submit</button>
        </form>
    </div>
</div>