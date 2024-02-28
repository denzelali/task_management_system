<?php
session_start();
include("config.php");

// CREATE TASK
if(isset($_POST["createTask"])) {

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


// THIS IS FOR UPDATE
if(isset($_POST["processTask"])) {
    
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
