<?php

    include 'db_connection.php';
    $uname = $pass = $email = "";
    if (isset($_POST['create'])) {
        $uname = test_input($_POST["uname"]);
        $pass = test_input($_POST["psw"]);
        $email = test_input($_POST["ema"]);
        $conn = openDB();
        $sql = "SELECT UserID FROM account WHERE Username = '$uname'";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) == 1) {
            alertUser("Username already in use");
        } else {
            $sql = "SELECT UserID FROM account WHERE Email = '$email'";
            $result = $conn->query($sql);
            if (mysqli_num_rows($result) == 1) {
                alertUser("Email address already in use");
            } else {
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO account (Username, Password, Email) VALUES ('$uname', '$pass', '$email')";
                if ($conn->query($sql) === TRUE) {
                    header("Location: account.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        closeDB($conn);
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function alertUser($message) {
        echo "<script type='text/javascript'>alert('$message')</script>";
    }
?>
<html>
    <head>

    </head>
    <body>
        <form action = "" method = "POST">
            <label for="uname">Username</label>
            <input type = "text" name = "uname" required />
            <label for="psw">Password</label>
            <input type = "password" name = "psw" required />
            <label for="ema">Email Address</label>
            <input type="text" name="ema" required />
            <button type = "submit" name = "create">Create Account</button>
        </form>
    </body>
</html>