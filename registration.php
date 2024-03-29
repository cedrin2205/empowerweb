<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
}

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $fullName = isset($_POST["fullname"]) ? $_POST["fullname"] : $username; 
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = isset($_POST["repeat_password"]) ? $_POST["repeat_password"] : $password; 
    $selectedRole = $_POST["role"];
    $lrn = $_POST["lrn"]; // Retrieve LRN from form submission

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $errors = array();

    if (empty($fullName) || empty($email) || empty($password) || empty($passwordRepeat) || $selectedRole === null || $selectedRole === "" || $selectedRole === "Select Role") {
        array_push($errors,"All fields are required, including selecting a role");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    if (strlen($password) < 8) {
        array_push($errors,"Password must be at least 8 characters long");
    }
    if ($password !== $passwordRepeat) {
        array_push($errors,"Password does not match");
    }

    require_once "database.php";

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $rowCount = mysqli_stmt_num_rows($stmt);

        if ($rowCount > 0) {
            array_push($errors,"Email already exists!");
        }

        mysqli_stmt_close($stmt);
    } else {
        array_push($errors, "Error: " . mysqli_error($conn));
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        $sql = "INSERT INTO users (full_name, email, password, role, lrn) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssss", $fullName, $email, $passwordHash, $selectedRole, $lrn);
            mysqli_stmt_execute($stmt);

            echo "<div class='alert alert-success'>You are registered successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
}
?>

    </div>
</body>
</html>
