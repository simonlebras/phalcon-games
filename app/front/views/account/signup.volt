<h1 class="text-center">Sign up</h1>
<form method="post" action="/account/signup" enctype="multipart/form-data" autocomplete="off">
    <div class="form-group">
        <label for="login">Login</label>
        <input type="text" class="form-control" id="login" name="login" placeholder="Login" required="true">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="true">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="true">
    </div>
    <div class="form-group">
        <label for="file">Avatar</label>
        <input type="file" id="file" name="file" required="true">
        <p class="help-block">Choose your avatar</p>
    </div>
    <button type="submit" class="btn btn-default btn-block">Submit</button>
</form>