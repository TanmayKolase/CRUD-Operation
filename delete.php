<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "Tanmay";
    $password = "Tanmay";
    $database = "profiles";

    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM users WHERE id=$id";
    $connection->query($sql);
}

header("location: /project/index.php");
exit;
