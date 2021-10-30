<?php
include '../inc/header.php';
include 'TextHandler.php';

?>
<?php if (!is_admin()) { ?>
<div class="alert alert-danger" role="alert">
    Ooops, you shouldn't be here ;)
</div>
<?php } elseif ($_FILES['the_file']) {
    $error = '';
    $fileExtensionAllowed = 'txt';
    $fileName = $_FILES['the_file']['name'];
    $fileTmpName  = $_FILES['the_file']['tmp_name'];
    $array = explode('.', $fileName);
    $fileExtension = strtolower(end($array));
    if (isset($_POST['submit'])) {
        if (empty($fileExtension)) {
            $error = "Empty request";
        } elseif (!empty($fileExtension) && $fileExtension != $fileExtensionAllowed) {
            $error = "This file extension is not allowed. Please upload a TXT file. FileExtensionAllowed: ". $fileExtensionAllowed . " Extention:".$fileExtension.";";
        }
        if (empty($error)) {
            $writer = new TextHandler();
            $wrong = $writer->writeToDB($_FILES['the_file']['tmp_name']); ?>
<div class="container-lg">
    <div class="alert alert-success" role="alert">
        File is uploaded
    </div>
</div>
<?php
        } else {
            ?>
<div class="container-lg">
    <div class="alert alert-danger" role="alert">
        <?php echo $error . "\n"; ?>
    </div>
</div>
<?php
        }
    }
}

        if (isset($_GET['id'])) {
            $result = changeUserStatus($_GET['id']);
            if ($result) {?>
<div class="container-lg">
    <div class="alert alert-danger" role="alert">
        <?php echo $result ?>
    </div>
</div>
<?php
            }
        }
        if (isset($_GET['grant'])) {
            $result = changeUserRole($_GET['grant']);
        }
?>
<div class="container w-25 mt-5 mb-5">
    <form action="admin_panel.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <label class="form-label" for="customFile">Upload your text file</label>
            <input type="file" class="form-control" id="customFile" name="the_file" />
            <input type="submit" name="submit" value="Start Upload">
        </div>
    </form>
</div>

<div class="container-lg mb-5">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" onclick="sortTable(0)">Id <i class="fa fa-fw fa-sort"></i></th>
                <th scope="col" onclick="sortTable(1)">Username <i class="fa fa-fw fa-sort"></i></th>
                <th scope="col" onclick="sortTable(2)">Email <i class="fa fa-fw fa-sort"></i></th>
                <th scope="col" onclick="sortTable(3)">Usertype <i class="fa fa-fw fa-sort"></i></th>
                <th scope="col" onclick="sortTable(4)">Active <i class="fa fa-fw fa-sort"></i></th>
                <th scope="col" onclick="sortTable(5)">Block <i class="fa fa-fw fa-sort"></i></th>
                <?php
                if (is_super_admin()) {
                    ?>
                <th scope="col" onclick="sortTable(6)">Rights <i class="fa fa-fw fa-sort"></i></th>
                <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $users = getUsers(isset($_GET['page']) ? $_GET['page'] : 1);
            foreach ($users as $user) {
                ?>
            <tr>
                <th scope="row" id="user_id"><?php echo $user['id'] ?>
                </th>
                <th> <?php echo $user['username'] ?>
                </th>
                <th> <?php echo $user['email'] ?>
                </th>
                <th> <?php echo $user['user_type'] ?>
                </th>
                <th id="user_status"> <?php if ($user['is_active']) {?>
                    <div class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                            <path
                                d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            <path fill-rule="evenodd"
                                d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                        </svg></div>
                    <?php
                } else {
                    ?>
                    <div class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z" />
                            <path fill-rule="evenodd"
                                d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z" />
                        </svg>
                    </div>
                    <?php
                } ?>
                </th>
                <th>
                    <?php
                    $buttonText = $user['is_active'] ? 'ban' : 'unban';
                $link = (isset($_GET['page']) ? 'page='.$_GET['page'].'&' : '').'id='.$user['id'].'&status='.($user['is_active'] ? 0 : 1);
                echo '<a class="btn btn-warning" role="button"  href="admin_panel.php?'. $link.'">'.$buttonText.'</a>'
                     ?>
                </th>
                <?php
                if (is_super_admin()) {
                    ?>
                <th><?php
                $buttonText = $user['user_type'];
                    $link = (isset($_GET['grant']) ? '' : '&grant='.$user['id']);
                    echo '<a class="btn btn-info" role="button"  href="admin_panel.php?'.$link .'">'.$buttonText.'</a>'
                
                ?>
                </th>
                <?php
                } ?>
            </tr>
            <?php
            }
            ?>

        </tbody>
    </table>
    <?php
    $pages = countUserPages();
    if ($pages > 1) {
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1; ?>
    <nav aria-label="...">
        <ul class="pagination">
            <?php
        for ($i=1;$i<=$pages;$i++) {
            if ($current_page == $i) {
                ?>
            <li class="page-item active">
                <span class="page-link">
                    <?php echo $current_page ?>
                </span>
            </li>
            <?php
            } else {?>
            <li class="page-item"><a class="page-link"
                    href="admin_panel.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php
            } ?>
            <?php
        } ?>
        </ul>
    </nav>
    <?php
    }
    ?>
</div>
<?php include '../inc/footer.php';
