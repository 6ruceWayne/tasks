<?php

if (!isLoggedIn()) {
    ?>
<div class="container-lg">
    <div class="alert alert-danger" role="alert">
        You must log in first
    </div>
</div>
<?php
} else {
        ?>
<div class="container-lg">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" onclick="sortTable(0)">Category <i class="fa fa-fw fa-sort"></i></th>
                </th>
                <th scope="col" onclick="sortTable(1)">Title <i class="fa fa-fw fa-sort"></i></th>
                </th>
                <th scope="col" onclick="sortTable(2)">Description <i class="fa fa-fw fa-sort"></i></th>
                </th>
                <th scope="col" onclick="sortTable(3)">Created At <i class="fa fa-fw fa-sort"></i></th>
                </th>
                <th scope="col"> Open </th>
            </tr>
        </thead>
        <tbody>
            <?php
$tasks = getTasks(isset($_GET['page']) ? $_GET['page'] : 1);
        foreach ($tasks as $task) { ?>
            <tr <?php echo $task['done'] ? 'class="table-secondary"' : '' ?>>
                <th> <?php echo $task['category'] ?>
                </th>
                <th> <?php
                if (strlen($task['title']) < 40) {
                    echo $task['title'];
                } else {
                    echo mb_substr($task['title'], 0, 40).'...';
                }
                 ?>
                </th>
                <th> <?php
                if (strlen($task['description']) < 40) {
                    echo $task['description'];
                } else {
                    echo mb_substr($task['description'], 0, 40).'...';
                } ?>
                </th>
                <th> <?php echo $task['created_at'] ?>
                </th>
                <th>
                    <?php
    echo '<a class="btn btn-warning"
                        href="tasks/'.$task['id'].'"
                    role="button">show</a>'
                     ?>
                </th>
            </tr>
            <?php
    } ?>
        </tbody>
    </table>

    <?php
    $pages = countTasksPages();
        if ($pages > 1) {
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1; ?>
    <nav aria-label="...">
        <ul class="pagination">
            <?php
        for ($i=1;$i<=$pages;$i++) {
            if ($current_page ==$i) {
                ?>
            <li class="page-item active">
                <span class="page-link">
                    <?php echo $current_page ?>
                </span>
            </li>
            <?php
            } else {?>
            <li class="page-item"><a class="page-link"
                    href="index.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php
            } ?>
            <?php
        } ?>
        </ul>
    </nav>
    <?php
        } ?>
</div>
<?php
    }
