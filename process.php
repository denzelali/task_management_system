<?php
session_start();
include("config.php");

// REGISTER PROCESS
if (isset($_POST["regButton"])) {
    $email = $_POST["email"];
    $fname = $_POST["fname"];
    $mname = $_POST["mname"];
    $lname = $_POST["lname"];
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];

    $check_email_query = "SELECT * FROM `users` WHERE `email` = '$email'";
    $email_result = mysqli_query($conn, $check_email_query);

    if (!$email_result) {
        $_SESSION['status'] = "Error: " . mysqli_error($conn);
        $_SESSION['status_code'] = "error";
        header("Location: register.php");
        exit();
    }

    $email_count = mysqli_num_rows($email_result);

    if ($email_count > 0) {
        $_SESSION['status'] = "Email address already taken";
        $_SESSION['status_code'] = "error";
        header("Location: register.php");
        exit();
    }

    if ($password !== $repassword) {
        $_SESSION['status'] = "Password does not match";
        $_SESSION['status_code'] = "error";
        header("Location: register.php");
        exit();
    }


    $query = "INSERT INTO `users` (`email`, `fname`, `mname`, `lname`, `password`) VALUES ('$email', '$fname', '$mname', '$lname', '$password')";
    $query_result = mysqli_query($conn, $query);

    if (!$query_result) {
        $_SESSION['status'] = "Error: " . mysqli_error($conn);
        $_SESSION['status_code'] = "error";
        header("Location: register.php");
        exit();
    }

    $_SESSION['status'] = "Registration Success!";
    $_SESSION['status_code'] = "success";
    header("Location: register.php");
    exit();
}

// LOGIN PROCESS
if (isset($_POST["loginButton"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login_query = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password' LIMIT 1 ";
    $login_result = mysqli_query($conn, $login_query);

    if (!$login_result) {
        $_SESSION['status'] = "Error executing the login query: " . mysqli_error($conn);
        $_SESSION['status_code'] = "error";
        header("Location: login.php");
        exit();
    }

    if (mysqli_num_rows($login_result) > 0) {
        $data = mysqli_fetch_assoc($login_result);

        $user_id = $data['id'];
        $full_name = $data['fname'] . ' ' . $data['mname'] . ' ' . $data['lname'];
        $user_email = $data['email'];

        $_SESSION['auth'] = true;
        $_SESSION['auth_user'] = [
            'user_id' => $user_id,
            'user_name' => $full_name,
            'user_email' => $user_email,
        ];

        $_SESSION['status'] = "Welcome $full_name!";
        $_SESSION['status_code'] = "success";
        header("Location: view_tasks.php");
        exit();
    } else {
        $_SESSION['status'] = "Invalid Username/Password";
        $_SESSION['status_code'] = "error";
        header("Location: login.php");
        exit();
    }
}
// CREATE TASK
if (isset($_POST["createTask"])) {

    $task_id = $_POST['task_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $due_date = $_POST['due_date'];
    

    $task_query = "INSERT INTO tasks (task_id, title, description, priority, due_date) VALUES ('$task_id', '$title', '$description', '$priority', '$due_date')";

    if (!$conn->query($task_query)) {
        $_SESSION['status'] = "Error creating task: " . $conn->error;
        $_SESSION['status_code'] = "error";
        header("Location: view_tasks.php");
        exit();
    }


    $_SESSION['status'] = "New record created successfully";
    $_SESSION['status_code'] = "success";
    header("Location: view_tasks.php");
    exit();
}


if (isset($_POST["deleteTask"])) {
    // Check if task_id is set and is a valid integer
    if(isset($_POST['task_id']) && is_numeric($_POST['task_id'])) { //add
        // Sanitize the task_id to prevent SQL injection
        $id = mysqli_real_escape_string($conn, $_POST['task_id']);
        
        $delete_query = "DELETE FROM tasks WHERE task_id = '$id'";
        
        if ($conn->query($delete_query)) {
            $_SESSION['status'] = "Task deleted successfully";
            $_SESSION['status_code'] = "success";
            header("Location: view_tasks.php");
            exit();
        } else {
            $_SESSION['status'] = "Error deleting task: " . $conn->error;
            $_SESSION['status_code'] = "error";
            header("Location: view_tasks.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "Invalid task ID";
        $_SESSION['status_code'] = "error";
        header("Location: view_tasks.php");
        exit();
    }
}

// THIS IS FOR UPDATE
if (isset($_POST["processTask"])) {
    $id = $_SESSION['task_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $due_date = $_POST['due_date'];

    $update_query = "UPDATE tasks SET title='$title', description='$description', priority='$priority', due_date='$due_date' WHERE task_id='$id'";


        if ($conn->query($update_query)) {
            $_SESSION['status'] = "Task updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: view_tasks.php");
            exit();
        } else {
            $_SESSION['status'] = "Error updating task: " . $conn->error;
            $_SESSION['status_code'] = "error";
            header("Location: view_tasks.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "Invalid task ID";
        $_SESSION['status_code'] = "error";
        header("Location: view_tasks.php");
        exit();
    }


?>
