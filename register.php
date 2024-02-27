<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <style>
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-width: 300px;
            margin: 100px auto;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            background-color: #F8E8EE;
        }

        .container h3 {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

        }

        .container input[type="text"],
        .container input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 2px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        a {
            text-decoration: none;
            color: blue;
            cursor: pointer;
        }

        a:hover {
            text-decoration: underline;
        }

        button {
            width: 100%;
            padding: 8px;
            background-color: #FDCEDF;
            border-radius: 5px;


        }
    </style>
</head>

<body>
    <form action="process.php" method="POST">

        <div class="container">
            <h3>REGISTER</h3>
            <label>Email <input type="text" name="email" required></label><br>
            <label>Firstname <input type="text" name="fname" required></label><br>
            <label>Middlename <input type="text" name="mname" required></label><br>
            <label>Lastname <input type="text" name="lname" required></label><br>
            <label>Password <input type="password" name="password" id="passwordField" required></label><br>
            <label>Repeat password <input type="password" name="repassword" id="repasswordField" required></label>
            <a href="#" onclick="togglePasswordVisibility()">Show/Hide Password</a><br><br>
            <button type="submit" name="regButton">Register</button><br><br>

            <a href="login.php">🔐Login </a>
        </div>
    </form>

    <!-- SHOW/HIDE PASSWORD FUNCTIONALITY -->
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("passwordField");
            var repasswordField = document.getElementById("repasswordField");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                repasswordField.type = "text";
            } else {
                passwordField.type = "password";
                repasswordField.type = "password";
            }
        }
    </script>

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