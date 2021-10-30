<?php


function getUsers($page = 1)
{
    global $db;
    $query = "SELECT * FROM users LIMIT ".(($page-1)*10).",".($page*10);
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function countUserPages()
{
    global $db;
    $query = "SELECT COUNT(*) FROM users";
    $result = mysqli_query($db, $query);
    return round($result->fetch_row()['0'] / 10);
}

function changeUserStatus($id)
{
    $user = getUserById($id);
    if ($user['user_type'] == 'super_admin') {
        return 'No one can block Super Admin!';
    }
    if ($user['user_type'] == 'admin' && $_SESSION['user']['admin'] == 'admin') {
        return 'Admin can\'t block another Admin!';
    }
    global $db;
    $query = "UPDATE users SET is_active = !is_active WHERE id=" . $id;
    $result = mysqli_query($db, $query);
}

function changeUserRole($id)
{
    global $db;
    $query = "UPDATE `users` SET `user_type`= IF(STRCMP(users.user_type,'user')=0,'admin','user') WHERE id = " . $id;
    $result = mysqli_query($db, $query);
}

function getUserById($id)
{
    global $db;
    $query = "SELECT * FROM users WHERE id=" . $id;
    $result = mysqli_query($db, $query);
    $user = mysqli_fetch_assoc($result);
    return $user;
}
