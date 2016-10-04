<html>
    <head>
        <meta charset="utf-8">
        <title>
            My blog
        </title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/custom.css" rel="stylesheet">

    </head>
    <body id="body">
        <div class="wrapper">
            <?php include 'application/views/header.php'; ?>
            <div class='container'>
                <?php include 'application/views/'.$content_view; ?>
            </div>
            <div class="footer">
                <?php include 'appliction/views/footer.php'; ?>
            </div>
        </div>
    </body>
</html>