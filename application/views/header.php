<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">
                My blog
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class=""><a href="/Post/Create">+ CREATE NEW POST<span class="sr-only">(current)</span></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                    if ($_SESSION['authStatus'] != true) {
                        echo '<li ><a href = "/Auth/DisplaySignForm" > Sign In </a ></li >
                        <li ><a href = "/Auth/DisplayLoginForm" > Login</a ></li >';
                    } else {
                        echo '<li ><a href = "/"> You are loggined into the system </a ></li >';
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>
