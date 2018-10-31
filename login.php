<?php
    
    $uname = $pass = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uname = test_input($_POST["uname"]);
        $pass = test_input($_POST["psw"]);
        $servername = "localhost";
        $username = "root";
        $password = NULL;
        $dbname = "users";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: ". $conn->connect_error);
        }
        $sql = "SELECT * FROM account WHERE Username = '$uname'";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($pass, $row['Password'])) {
                //session_register("uname");
                //session_register("pass");
                echo "Login Successful";
            } else {
                echo "Login Failed";
            }
        } else {
            echo "Login Failed";
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>