<?php
    $servername = "localhost";
    $username = "root";
    $password = NULL;
    $dbname = "users";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }
    $sql = "INSERT INTO account (Username, Password, Email) VALUES ('tannerrobinaugh', '".password_hash("somepassword", PASSWORD_DEFAULT)."', 'tannerrobinaugh@gmail.com')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created";
    } else {
        echo "Error";
    }
    echo "Connected Successfully";
?>