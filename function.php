<?php
include_once('confiq.php');

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$connection){
    throw new Exception ('Could not connect to database');
}else{
    $action = $_POST['action'] ?? '';
    if(!$action){
        header('Location: index.php');
    }else{
        if("add" == $action){
            $task = $_POST['task'] ?? '';
            $date = $_POST['ddate'] ?? '';
            $query = "INSERT INTO tasks(task, date) VALUES('$task', '$date')";
            mysqli_query($connection, $query);
            header('Location: index.php?name='.$task);
            //mysqli_query($connection, "TRUNCATE TABLE tasks");
        }
    }    
}
mysqli_close($connection);