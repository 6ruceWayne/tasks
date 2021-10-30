<?php

if (isset($_SESSION['user']) && $_SESSION['user']['is_active']) {
    $taskId = str_replace('?done', '', str_replace('/tasks/', '', $request));
    if (strpos($request, 'done')) {
        changeTaskStatus($taskId);
    }
    $task = getTaskById($taskId); ?>
<div class="container w-25">
    <div class="d-flex flex-column justify-content-center">
        <p class="h4">Category</p>
        <p class="h5"><?php echo $task['category']?>
        </p>

        <p class="h4">Title</p>
        <p class="h5"><?php echo $task['title']?>
        </p>

        <p class="h4">Description</p>
        <p class="h5"><?php echo $task['description']?>
        </p>

        <p class="h4">Created At</p>
        <p class="h5"><?php echo $task['created_at']?>
        </p>
        <?php
                    if (!$task['done']) {
                        $html = '<a class="btn btn-success" role="button"  href="/tasks/'.$task['id'].'?'.'done'.'">'.'done'.'</a>';
                    } else {
                        $html = '<div class="btn btn-secondary disabled" role="button">'.'The task is done'.'</div>';
                    }
    echo $html; ?>
    </div>
</div>
<?php
} else { ?>

<div class="container-lg">
    <div class="alert alert-danger" role="alert">
        <?php
        if (isset($_SESSION['user']) && !$_SESSION['user']['is_active']) {
            echo 'You were blocked by admins, you are not allowed to change this page';
        } else {
            echo 'You must log in first';
        }
    ?>
    </div>
</div>

<?php

}
