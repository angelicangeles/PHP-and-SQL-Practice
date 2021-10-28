<?php
session_start();
?>
<html>
    <body>
        <?php
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
        $HiddenUsername = htmlspecialchars($_REQUEST["HiddenUsername"]);

        include 'Commands.php';
        $PersonalInfoPROCESS = new Commands();
        $checkIfPersonExists = $PersonalInfoPROCESS->checkIfPersonExists($FirstName, $MiddleName, $LastName, $Suffix);
        $checkIfUsernameExists = $PersonalInfoPROCESS->checkIfUsernameExists($Username);
        $newPersonID = $PersonalInfoPROCESS->getPersonID($FirstName, $MiddleName, $LastName, $Suffix);
        $oldPersonID = $PersonalInfoPROCESS->getPersonID($_SESSION["FirstName"], $_SESSION["MiddleName"], $_SESSION["LastName"], $_SESSION["Suffix"]);
        
        $AdminAccountID = $PersonalInfoPROCESS->getAdminAccountID($_SESSION["AdminUsername"], $_SESSION["AdminPassword"]);
        if ($newPersonID == $oldPersonID) {
            if ($HiddenUsername == $Username) {
                $cond1 = $PersonalInfoPROCESS->updatePerson($oldPersonID, $FirstName, $MiddleName, $LastName, $Suffix, $Region, $City, $Barangay, $Subdivision, $StreetName, $HouseNo, $ContactNo, $Gender, $Birthday, $SSS, $PagIbig, $BirthCertificate, $GSIS, $PhilHealth);
                $cond2 = $PersonalInfoPROCESS->updateAdminAccount($oldPersonID, $Username, $Password);
                $TransactionLog = "Admin Edited the Personal Information of $FirstName $MiddleName $LastName $Suffix";
                $PersonalInfoPROCESS->adminTransactionLog($AdminAccountID, $TransactionLog);
                if ($HiddenUsername == $_SESSION["AdminUsername"]) {
                    $_SESSION["AdminUsername"] = $Username;
                    $_SESSION["AdminPassword"] = $Password;
                }
                if ($cond1 && $cond2 == TRUE) {
                    echo '<script>alert("Success updating personal information!");</script>';
                    header("location: PersonalInfo.php");
                    exit();
                } else {
                    echo '<script>alert("Failed updating personal information!");</script>';
                    header("location: PersonalInfo.php");
                    exit();
                }
            } else if ($checkIfUsernameExists == FALSE) {
                $cond1 = $PersonalInfoPROCESS->updatePerson($oldPersonID, $FirstName, $MiddleName, $LastName, $Suffix, $Region, $City, $Barangay, $Subdivision, $StreetName, $HouseNo, $ContactNo, $Gender, $Birthday, $SSS, $PagIbig, $BirthCertificate, $GSIS, $PhilHealth);
                $cond2 = $PersonalInfoPROCESS->updateAdminAccount($oldPersonID, $Username, $Password);
                $TransactionLog = "Admin Edited the Personal Information of $FirstName $MiddleName $LastName $Suffix";
                $PersonalInfoPROCESS->adminTransactionLog($AdminAccountID, $TransactionLog);
                if ($HiddenUsername == $_SESSION["AdminUsername"]) {
                    $_SESSION["AdminUsername"] = $Username;
                    $_SESSION["AdminPassword"] = $Password;
                }
                if ($cond1 && $cond2 == TRUE) {
                    echo '<script>alert("Success updating personal information!");</script>';
                    header("location: PersonalInfo.php");
                    exit();
                } else {
                    echo '<script>alert("Failed updating personal information!");</script>';
                    header("location: PersonalInfo.php");
                    exit();
                }
            } else {
                echo 'Failed updating 1';
                header("location: PersonalInfo.php");
                exit();
            }
        } else if ($checkIfPersonExists == FALSE) {
            if ($checkIfUsernameExists == FALSE) {
                $cond1 = $PersonalInfoPROCESS->updatePerson($oldPersonID, $FirstName, $MiddleName, $LastName, $Suffix, $Region, $City, $Barangay, $Subdivision, $StreetName, $HouseNo, $ContactNo, $Gender, $Birthday, $SSS, $PagIbig, $BirthCertificate, $GSIS, $PhilHealth);
                $cond2 = $PersonalInfoPROCESS->updateAdminAccount($oldPersonID, $Username, $Password);
                $TransactionLog = "Admin Edited the Personal Information of $FirstName $MiddleName $LastName $Suffix";
                $PersonalInfoPROCESS->adminTransactionLog($AdminAccountID, $TransactionLog);
                $_SESSION["AdminUsername"] = $Username;
                $_SESSION["AdminPassword"] = $Password;
                if ($cond1 && $cond2 == TRUE) {
                    echo '<script>alert("Success updating personal information!");</script>';
                    header("location: PersonalInfo.php");
                    exit();
                } else {
                    echo '<script>alert("Failed updating personal information!");</script>';
                    header("location: PersonalInfo.php");
                    exit();
                }
            } else {
                echo 'Failed updating 2';
                header("location: PersonalInfo.php");
                exit();
            }
        } else {
            echo 'Error!';
            header("location: PersonalInfo.php");
            exit();
        }
        ?>
    </body>
</html>
