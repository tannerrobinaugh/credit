<?php
    
    require_once 'db_connection.php';
    $uname = $pass = "";
    if (isset($_POST['login'])) {
        $uname = test_input($_POST["uname"]);
        $pass = test_input($_POST["psw"]);
        $conn = openDB();
        $sql = "SELECT * FROM account WHERE Username = '$uname'";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($pass, $row['Password'])) {
                //session_register("uname");
                //session_register("pass");
                header("Location: account.php");
            } else {
                echo "Login Failed";
            }
        } else {
            echo "Login Failed";
        }
        closeDB($conn);
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
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
            <button type = "submit" name="login">Login</button>
        </form>
    </body>
</html>