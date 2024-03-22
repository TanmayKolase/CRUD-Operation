<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of Users</h2>
        <a class="btn btn-primary" href="/Project/createUser.php" role="button">New User</a><br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $servername = "localhost";
                $username = "Tanmay";
                $password = "Tanmay";
                $database = "profiles";

                $connection = new mysqli($servername, $username, $password, $database);

                // Verify the connection 
                if($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                // Read the data
                $sql = "SELECT * FROM users";
                $result = $connection->query($sql);

                // Verify the result 
                if(!$result) {
                    die("Invalid Query: " . $connection->error);
                }

                // Read the data
                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>$row[id]</td>
                        <td>$row[name]</td>
                        <td>$row[email]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='/Project/update.php?id=$row[id]'>Update</a>
                            <a class='btn btn-danger btn-sm' href='/Project/delete.php?id=$row[id]'>Delete</a>
                        </td>
                    </tr>
                    ";
                }

                // connection close
                $connection->close();
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
