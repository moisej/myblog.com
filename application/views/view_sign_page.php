<div id="content">
    <div class="panel panel-default">
        <div class="panel-body">
            <div id="create_post_content">
                <h1>Registration</h1>
                <form enctype="multipart/form-data" method="post" action="/Auth/SignIn">
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input type="text" class="form-control" id="login" name="login" placeholder="Login" maxlength="10">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" maxlength="10">
                    </div>
                    <button type="submit" class="btn btn-danger">Sign in</button>
                </form>
            </div>
        </div>
    </div>
</div>