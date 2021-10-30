<?php
include_once 'functions.php';

function getTaskById($id)
{
    global $db;
    $query = "SELECT * FROM tasks WHERE id=" . $id;
    $result = mysqli_query($db, $query);
    $task = mysqli_fetch_assoc($result);
    return $task;
}

function getTasks($page = 1)
{
    global $db;
    $query = "SELECT * FROM tasks LIMIT ".(($page-1)*10).",".($page*10);
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function countTasksPages()
{
    global $db;
    $query = "SELECT COUNT(*) FROM tasks";
    $result = mysqli_query($db, $query);
    return round($result->fetch_row()['0'] / 10);
}


function changeTaskStatus($taskId)
{
    global $db;
    $query = "UPDATE tasks SET done = '1' WHERE id=" . $taskId;
    $result = mysqli_query($db, $query);
}
