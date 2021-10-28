<?php
session_start();
?>
<html>
    <body>
        <?php
        session_start();
        
        $Username = htmlspecialchars($_REQUEST["Username"]);
        $Password = htmlspecialchars($_REQUEST["Password"]);
        $_SESSION["AdminUsername"] = $Username;
        $_SESSION["AdminPassword"] = $Password;
        include 'Commands.php';
        $LogInPROCESS = new Commands();
        
        $AdminAccountID = $LogInPROCESS->getAdminAccountID($_SESSION["AdminUsername"], $_SESSION["AdminPassword"]);
        if ($LogInPROCESS->logIn($_SESSION["AdminUsername"], $_SESSION["AdminPassword"])) {
            $TransactionLog = "Admin Username: $Username Logged In";
            $LogInPROCESS->adminTransactionLog($AdminAccountID, $TransactionLog);
            header("location: dashboard.php");
            exit();
        } else {
            echo'<script>alert("Account does not exist!");</script>';
            header("location: LogIn.php");
            exit();
        }
        ?>
    </body>
</html>