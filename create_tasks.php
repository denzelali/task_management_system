<?php
session_start()
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create A Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0, 100;0,200;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css" />
</head>

<header>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-body">
    <div class="container-fluid">
      <button
        data-mdb-collapse-init
        class="navbar-toggler"
        type="button"
      >
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarExample01">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="view_tasks.php">View Tasks</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="create_tasks.php">Add Task</a>
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
<section class="vh-100 bg-DFFFD8" style="background-color: #DFFFD8;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body">
                        <h5 class="card-title text-center">Create Task</h5>
                        <form action="process.php" method="POST">
                            
                            <div class="mb-3">
                                <label for="title" class="form-label">Title: </label>
                                <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description: </label>
                                <textarea id="description" name="description" class="form-control" placeholder="Enter Description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="priority" class="form-label">Priority: </label>
                                <select name="priority" id="priority" class="form-select" required>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="due_date" class="form-label">Due Date: </label>
                                <input type="date" id="due_date" name="due_date" class="form-control" required>
                            </div>
                            <button type="submit" name="createTask" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>