<?php

$servername = "localhost";
$username = "Tanmay";
$password = "Tanmay";
$database = "profiles";

//create connection
$connection = new mysqli($servername, $username, $password, $database);

$name = "";
$email = "";

$errorMessage = "";
$sucessMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: /project/index.php");
        exit;
    }

    $id = $_GET["id"];


    //read row data of selected client
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /project/index.php");
        exit;
    }

    $name = $row["name"];
    $email = $row["email"];
} else {
    //post method: update data
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];

    do {
        if (empty($id) || empty($name) || empty($email)) {
            $errorMessage = "All fields are required";
            break;
        }

        $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        
        $sucessMessage = "User added successfully";
        header("location: /project/index.php");
        exit;
    } while (false);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>New User</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                </div>
                ";
        }
        ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>

            <?php
            if (!empty($sucessMessage)) {
                echo "
                    <div class='row mb-3'>
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>$sucessMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                    </div>
                    </div>
                    ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/project/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>