<?php

class TextHandler
{
    public function writeToDB($file)
    {
        $array = explode("|", file_get_contents($file, FILE_USE_INCLUDE_PATH));
        foreach ($array as $line) {
            $this->createTask($line);
        }
    }

    private function createTask($line)
    {
        global $db;
        $arr_string = explode(" ", $line, 3);
        $category = trim($arr_string[0]);
        $date = trim($arr_string[1]);
        $title = trim(substr($arr_string[2], 0, strpos($arr_string[2], ';')));
        $description = trim(substr($arr_string[2], strpos($arr_string[2], ';') + 1));
        if ($category && $date && $title && $description && $this->isTaskUnique($category, $title)) {
            $query = "INSERT INTO tasks (category, title, description, created_at) 
            VALUES('$category', '$title', '$description', '$date')";
            mysqli_query($db, $query);
        }
    }
    public function isTaskUnique($category, $title)
    {
        global $db;
        $query = "SELECT COUNT(*) FROM `tasks` WHERE category = '".$category."' AND title = '".$title."'";
        $result = mysqli_query($db, $query);
        return $result->fetch_row()['0'] == 0;
    }
}
