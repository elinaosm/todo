<?php 
    $errors = "";
    //pieslēgties datu bāzei
    $db = mysqli_connect("localhost", "root", "", "todo");

    if (isset($_POST['submit'])) {
        $task = $_POST['task'];
        if (empty($task)) {
            $errors = "What do you want to do?";
        }else {
            mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
            header('location: index.php');
        }
    }

    // uzdevuma dzēšana
    if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];
        mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
        header('location: index.php');
    }

  //  uzdevuma labošana
   if (isset($_GET['edit_task'])) {
       $id = $_GET['edit_task'];
    //IZLAAAAAABOT
        mysqli_query($db, "UPDATE tasks SET task='$task' id=$id");
   }

    $tasks = mysqli_query($db, "SELECT * FROM tasks");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>to do list</title>
   
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>TO DO LIST</h1>
    </div>
    <form method="POST" action="index.php" >
    <?php if (isset($errors)) { ?>
        <p><?php echo $errors; ?></p>
    <?php } ?>


        <input type="text" name="task" class="task_input">
        <button type="submit" name="submit" class="add_btn">+</button>
    </form>
  <table>
    <thead>
        <tr>
            <th>No</th>
            <th>TASK</th>
            <th>ACTIONS</th>
        </tr>
    </thead>?
    <tbody>
    <?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td class="task"><?php echo $row['task']; ?></td>
            <td class="edit">
                <a href="index.php?del_task=<?php echo $row['id']; ?>">edit</a>
            <td class="erase">
                <a href="index.php?del_task=<?php echo $row['id']; ?>">ER</a>
            </td>
        </tr>
    <?php $i++; } ?>
    
</body>
</html>