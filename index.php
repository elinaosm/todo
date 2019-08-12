<?php 
    //pieslēgties datu bāzei
    $db = mysqli_connect("localhost", "root", "", "todo");

    if (isset($_POST['submit'])) {
        $task = $_POST['task'];

        mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
        header('location: index.php');
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
        <input type="text" name="task" class="task_input">
        <button type="submit" name="submit" class="add_btn">Add Task</button>
    </form>
  <table>
    <thead>
        <tr>
            <th>No</th>
            <th>TASK</th>
            <th>ACTIONS</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = mysqli_fetch_array($tasks)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td class="task"><?php echo $row['task']; ?></td>
            <td class="edit">
                <a href="#">edit</a>
            <td class="erase">
                <a href="#">erase</a>
            </td>
        </tr>
    <?php } ?>
    
</body>
</html>