<?php
session_start();
include("config.php");

if (isset($_POST["deleteTask"])) {

    if (isset($_POST['task_id']) && is_numeric($_POST['task_id'])) { //add

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
