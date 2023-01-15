<?php
include_once('confiq.php');
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(!$connection){
    throw new Exception ('Could not connect to database');
}
$query = "SELECT * FROM tasks where complete=0";
$result = mysqli_query($connection, $query);

// $queryComplete = "SELECT * FROM `tasks` WHERE `task` LIKE '$del_id'";
// //$sql = "SELECT *  FROM `tasks` WHERE `task` LIKE \'asdfa\'";
// $query = "SELECT * FROM tasks where complete=0";
// $result = mysqli_query($connection, $query);
$tasksa = $_GET['name'] ??'';

$queryComplete = "SELECT *  FROM tasks WHERE task LIKE '%".$tasksa."%'";
$resultComplete = mysqli_query($connection, $queryComplete);
$num = mysqli_num_rows($resultComplete);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css">
    
    
    <title>Document</title>
    
</head>
<body>
    <div class="container">
    <?php
    if($num != 0){ ?> 
    <h1>orders </h1>
    <table>
        <thead>
        <tr><th></th>
            <th>ID</th>
            <th>Tasks</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        </thead> <tbody>

        <?php
        while($cdata= mysqli_fetch_assoc($resultComplete)){ ?> 
        <tr>
            <th><input type="checkbox" name="check" id="check" checked value="<?php echo $cdata['id'] ?>"></th>
            <td><?php echo $cdata['id'] ?></td>
            <td><?php echo $cdata['task'] ?></td>
            <td><?php echo $cdata['date'] ?></td>
            <td><a href="#" class="delete" data-delid="<?php echo $cdata['id'] ?>">Delete</a></td>
        </tr>

        <?php } 
        ?>
        
        </tbody>
    </table>
    <br>
    <?php }
    ?>
    <h1 class="title">Here you can add your Orders</h1>
    <form action="function.php" method="POST">
        <input type="text" name="task" placeholder="Enter your order">
        <input type="date" name="ddate" placeholder="Enter your order">
        <?php $added = $_GET['added'] ??'';
            if($added){
                echo '<p> order added successfully</p>';
            }
            ?>
        <input type="submit" name="submit" value="Add Task">
        <input type="hidden" name="action" value="add">
    </form>
            
    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    

</html>