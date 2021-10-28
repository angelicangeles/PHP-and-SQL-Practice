<html>
    <body>
        <?php
        session_start();
        
        $FirstName = htmlspecialchars($_REQUEST["FirstName"]);
        $MiddleName = htmlspecialchars($_REQUEST["MiddleName"]);
        $LastName = htmlspecialchars($_REQUEST["LastName"]);
        $Suffix = htmlspecialchars($_REQUEST["Suffix"]);
        $Region = htmlspecialchars($_REQUEST["Region"]);
        $City = htmlspecialchars($_REQUEST["City"]);
        $Barangay = htmlspecialchars($_REQUEST["Barangay"]);
        $Subdivision = htmlspecialchars($_REQUEST["Subdivision"]);
        $StreetName = htmlspecialchars($_REQUEST["StreetName"]);
        $HouseNo = htmlspecialchars($_REQUEST["HouseNo"]);
        $ContactNo = htmlspecialchars($_REQUEST["ContactNo"]);
        $Gender = htmlspecialchars($_REQUEST["Gender"]);
        $Birthday = htmlspecialchars($_REQUEST["Birthday"]);
        $SSS = htmlspecialchars($_REQUEST["SSS"]);
        $PagIbig = htmlspecialchars($_REQUEST["PagIbig"]);
        $BirthCertificate = htmlspecialchars($_REQUEST["BirthCertificate"]);
        $GSIS = htmlspecialchars($_REQUEST["GSIS"]);
        $PhilHealth = htmlspecialchars($_REQUEST["PhilHealth"]);
        $Username = htmlspecialchars($_REQUEST["Username"]);
        $Password = htmlspecialchars($_REQUEST["Password"]);
        $HiddenValue = htmlspecialchars($_REQUEST["HiddenValue"]);

        include 'Commands.php';
        $SignUpPROCESS = new Commands();
        
        $AdminAccountID = $SignUpPROCESS->getAdminAccountID($_SESSION["AdminUsername"], $_SESSION["AdminPassword"]);
        if ($SignUpPROCESS->checkIfPersonExists($FirstName, $MiddleName, $LastName, $Suffix) == FALSE && $SignUpPROCESS->checkIfUsernameExists($Username) == FALSE) {
            $cond = $SignUpPROCESS->registerPerson($FirstName, $MiddleName, $LastName, $Suffix, $Region, $City, $Barangay, $Subdivision, $StreetName, $HouseNo, $ContactNo, $Gender, $Birthday, $SSS, $PagIbig, $BirthCertificate, $GSIS, $PhilHealth);
            $TransactionLog = "Master Admin Registered a New Admin Name: $FirstName $MiddleName $LastName $Suffix";
            $SignUpPROCESS->adminTransactionLog($AdminAccountID, $TransactionLog);
            if ($cond == TRUE) {
                $PersonID = $SignUpPROCESS->getPersonID($FirstName, $MiddleName, $LastName, $Suffix);
                $cond = $SignUpPROCESS->registerAdmin($PersonID, $Username, $Password);
                if ($cond == TRUE) {
                    echo '<script>alert("Success registering admin!");</script>';
                    if ($HiddenValue == 1) {
                        header("location: RegisterAdmin.php");
                        exit();
                    }
                    header("location: LogIn.php");
                    exit();
                } else {
                    echo '<script>alert("Failed registering admin!");</script>';
                    header("location: SignUp.php");
                    exit();
                }
            }
        } else {
            echo '<script>alert("Failed registering person!");</script>';
            if ($HiddenValue == 1) {
                header("location: RegisterAdmin.php");
                exit();
            }
            header("location: SignUp.php");
            exit();
        }
        ?>
    </body>
</html>
