<?php
    include 'inc/header.php';

    $request = $_SERVER['REQUEST_URI'];
switch ($request) {
    case '/' :
        require __DIR__ . '/views/index.php';
        break;
    case '' :
        require __DIR__ . '/views/index.php';
        break;
    case stristr($request, '/index.php') :
        require __DIR__ . '/views/index.php';
        break;
    case stristr($request, '/tasks/') :
        require __DIR__ . '/views/tasks.php';
        break;
    case '/register' :
        require __DIR__ . '/views/register.php';
        break;
    case '/login' :
        require __DIR__ . '/views/login.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}
    ?>
<?php
    include 'inc/footer.php';
