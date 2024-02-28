<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css" />

    <title>View Tasks</title>

    <style>
        /* Custom CSS */
        .btn-group {
            display: flex;
            align-items: center;
        }

        .btn-group button {
            margin-right: 5px;
        }
    </style>
</head>

<header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body ">
        <div class="container-fluid">
            <button data-mdb-collapse-init class="navbar-toggler" type="button">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarExample01">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="#">Home</a>
                    </li>
                    <li>
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar -->

</header>

<body>

    <section class="bg-dark">
        <div class="container py-4">

            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-header">
                    <h2 class="text-center">Task Management System</h2>
                </div>
                <div class="card-body">
                    <div class="add">
                        <a href="create_tasks.php"><button class="btn btn-primary">Create Task</button></a>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-warning">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Priority</th>
                                    <th>Due Date</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include("config.php");

                                $check_qry = "SELECT * FROM tasks";
                                $result = $conn->query($check_qry);

                                if ($result->num_rows > 0) {
                                    $i = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row['task_id'];
                                ?>

                                        <tr>
                                            <td><?php echo $i++ ?>.</td>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo $row['description']; ?></td>
                                            <td><?php echo $row['priority']; ?></td>
                                            <td><?php echo $row['due_date']; ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <form action="edit_task.php" method="POST">
                                                        <!-- UPDATE -->
                                                        <input type="hidden" name="task_id" value="<?php echo $id; ?>">
                                                        <input type="hidden" name="title" value="<?php echo $row['title']; ?>">
                                                        <input type="hidden" name="description" value="<?php echo $row['description']; ?>">
                                                        <input type="hidden" name="priority" value="<?php echo $row['priority']; ?>">
                                                        <input type="hidden" name="due_date" value="<?php echo $row['due_date']; ?>">
                                                        <button type="submit" name="updateTask" class="btn btn-success">Update</button>
                                                    </form>
                                                    <form action="delete_task.php" method="POST">
                                                        <!-- DELETE -->
                                                        <input type="hidden" name="task_id" value="<?php echo $id; ?>">
                                                        <button type="submit" name="deleteTask" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No tasks found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROMPT DIALOG GAMIT SWEET ALERT UG POPPER -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php
    if (isset($_SESSION['status']) && $_SESSION['status_code'] != '') {
    ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['status_code']; ?>",
            });
        </script>
    <?php
        unset($_SESSION['status']);
        unset($_SESSION['status_code']);
    }
    ?>

</body>

</html>