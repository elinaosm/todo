<?php 
    $errors = "";
    //connect to database
    $db = mysqli_connect("localhost", "root", "", "todo");

    if (isset($_POST['submit'])) {
        $task = $_POST['task'];
        if (empty($task)) {
            $errors = "Just do it - write in something";
        }else {
            mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
            header('location: index.php');
        }
    }

    // delete task
    if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];
        mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
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
    <link rel="stylesheet href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a61116abf5.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <button class="open-button" onclick="openForm()">Open Form</button>
    <div class="form-popup" id="myForm">
        <form action="/action_page.php" class="form-container">
            <h1>Login Register</h1>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" required>
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
            <button type="submit" class="btn">Login</button>
            <button type="submit" class="btn">Register</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
         </form>
        </div>

<script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
}   
    function closeForm() {
        document.getElementById("myForm").style.display = "none";
}
</script>

    <div class="header">
        <h1>TODO List</h1>
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
            <th></th>
            <th>TASK</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td class="task"><?php echo $row['task']; ?></td>
            <td class="edit">
                <a href="index.php?edit_task=<?php echo $row['id']; ?>"><i class="far fa-edit"></i></a></td>
            <td class="erase">
                <a href="index.php?del_task=<?php echo $row['id']; ?>"><i class="far fa-trash-alt"></i></a>
            </td>
        </tr>
    <?php $i++; } ?>
    </tbody>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="footer">
        <p>TODO List 2019</p>
    </div>
</body>
</html>