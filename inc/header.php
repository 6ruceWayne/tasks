<?php
    include_once 'functions.php';
    include_once 'UserService.php';
    include_once 'TaskService.php';
    
    $base_link = "http://".$_SERVER['SERVER_NAME'];
    ?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo $base_link?>/js/main.js">
    </script>
</head>

<body>
    <section style='min-height: 90vh'>

        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Tasks</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                        <?php if (is_admin()) : ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="<?php $base_link?>/admin/admin_panel.php">Admin
                                panel</a>
                        </li>
                        <?php endif ?>
                    </ul>
                    <?php if (isLoggedIn() && isset($_SESSION['user'])) : ?>
                    <i style="padding-right: 20px; padding-left: 20px;color: #888;"><?php echo ucfirst($_SESSION['user']['username']).' '; ?></i>
                    <a href="<?php $base_link?>/index.php?logout='1'"
                        style="margin-right: 30px;color: red;">Logout</a>
                    <?php else : ?>
                    <a href="/login" style="margin-right: 30px; color: red;">Login</a>
                    <?php endif ?>
                </div>
            </div>
        </nav>