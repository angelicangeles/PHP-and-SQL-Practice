<?php

class Commands {

    public $servername = "";
    public $username = "";
    public $password = "";
    public $database = "";
    public $conn = "";

    function __construct() {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "rootPass123";
        $this->database = "practice";
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
    }

    function checkIfMasterAdmin($Username, $Password) {
        try {
            $sql = "SELECT AdminAccountID from adminaccount where Username='$Username' and Password='$Password'";
            $result = mysqli_query($this->conn, $sql);
            if (mysqli_num_rows($result) > 0) {

                while ($rows = mysqli_fetch_assoc($result)) {
                    if ($rows['AdminAccountID'] == '1') {
                        return TRUE;
                    }
                }
            } else {
                echo '0 results';
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
        return FALSE;
    }

    function checkIfNoData() {
        try {
            $sql = "SELECT AdminAccountID from adminaccount";
            $result = mysqli_query($this->conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
    }

    function registerPerson($FirstName, $MiddleName, $LastName, $Suffix, $Region, $City, $Barangay, $Subdivision, $StreetName, $HouseNo, $ContactNo, $Gender, $Birthday, $SSS, $PagIbig, $BirthCertificate, $GSIS, $PhilHealth) {
        try {
            $sql = "INSERT into person(FirstName, MiddleName, LastName, Suffix, Region, City, Barangay,
            Subdivision, StreetName, HouseNo, ContactNo, Gender, Birthday, SSS, PagIbig, BirthCertificate,
            GSIS, PhilHealth) values ('$FirstName', '$MiddleName', '$LastName', '$Suffix', '$Region', '$City', '$Barangay',
            '$Subdivision', '$StreetName', '$HouseNo', '$ContactNo', '$Gender', '$Birthday', '$SSS', '$PagIbig', '$BirthCertificate',
            '$GSIS', '$PhilHealth')";
            $result = mysqli_query($this->conn, $sql);
            if ($result) {
                echo '<script>alert("Success registering person!")</script>';
                return TRUE;
            } else {
                echo '<script>alert("Failed registering person!")</script>';
                return FALSE;
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
    }

    function getPersonID($FirstName, $MiddleName, $LastName, $Suffix) {
        try {
            $sql = "SELECT PersonID from person where FirstName='$FirstName' AND MiddleName='$MiddleName' AND LastName='$LastName' AND Suffix='$Suffix'";
            $result = mysqli_query($this->conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($rows = mysqli_fetch_assoc($result)) {
                    return $rows["PersonID"];
                }
            } else {
                echo '0 results';
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
        return -1;
    }

    function registerAdmin($PersonID, $Username, $Password) {
        try {
            $sql = "INSERT into adminaccount(PersonID, Username, Password) values ('$PersonID', '$Username', '$Password')";
            $result = mysqli_query($this->conn, $sql);
            if ($result) {
                echo '<script>alert("Success!")</script>';
                return TRUE;
            } else {
                echo '<script>alert("Failed!")</script>';
                return FALSE;
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
    }

    function logIn($Username, $Password) {
        try {
            $sql = "SELECT AdminAccountID from adminaccount where Username='$Username' and Password='$Password'";
            $result = mysqli_query($this->conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                return TRUE;
            } else {
                echo '0 results';
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
        return FALSE;
    }

    function getFirstName($Username, $Password) {
        try {
            $sql = "SELECT Person.FirstName as FirstName from adminaccount inner join person on adminaccount.PersonID = person.PersonID where AdminAccount.Username='$Username' and AdminAccount.Password='$Password'";
            $result = mysqli_query($this->conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($rows = mysqli_fetch_assoc($result)) {
                    return $rows["FirstName"];
                }
            } else {
                echo '0 first name results';
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
        return null;
    }
    
    function getAdminAccountID($Username, $Password) {
        try {
            $sql = "SELECT AdminAccountID from adminaccount where Username='$Username' and Password='$Password'";
            $result = mysqli_query($this->conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($rows = mysqli_fetch_assoc($result)) {
                    return $rows["AdminAccountID"];
                }
            } else {
                echo '0 admin account ID results';
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
        return null;
    }

    function checkIfPersonExists($FirstName, $MiddleName, $LastName, $Suffix) {
        try {
            $sql = "SELECT * from person where FirstName='$FirstName' AND MiddleName='$MiddleName' AND LastName='$LastName' AND Suffix='$Suffix'";
            $result = mysqli_query($this->conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo '<script>alert("Person already exists!")</script>';
                return TRUE;
            } else {
                echo '0 person results';
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
        return FALSE;
    }

    function checkIfUsernameExists($Username) {
        try {
            $sql = "SELECT * from adminaccount where Username='$Username'";
            $result = mysqli_query($this->conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo '<script>alert("Username already exists, try another one!")</script>';
                return TRUE;
            } else {
                echo '0 username results';
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
        return FALSE;
    }

    function getPersonInfo($FirstName, $MiddleName, $LastName, $Suffix) {
        try {
            $sql = "SELECT * from person inner join adminaccount on adminaccount.PersonID = person.PersonID where Person.FirstName='$FirstName' AND Person.MiddleName='$MiddleName' AND Person.LastName='$LastName' AND Person.Suffix='$Suffix'";
            $result = mysqli_query($this->conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                return $result;
            } else {
                echo '0 person results';
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
        return $result;
    }

    function updatePerson($PersonID, $FirstName, $MiddleName, $LastName, $Suffix, $Region, $City, $Barangay, $Subdivision, $StreetName, $HouseNo, $ContactNo, $Gender, $Birthday, $SSS, $PagIbig, $BirthCertificate, $GSIS, $PhilHealth) {
        try {
            $sql = "UPDATE person set FirstName='$FirstName', MiddleName='$MiddleName', LastName='$LastName', Suffix='$Suffix', Region='$Region', City='$City', Barangay='$Barangay',
            Subdivision='$Subdivision', StreetName='$StreetName', HouseNo='$HouseNo', ContactNo='$ContactNo', Gender='$Gender', Birthday='$Birthday', SSS='$SSS', PagIbig='$PagIbig', BirthCertificate='$BirthCertificate',
            GSIS='$GSIS', PhilHealth='$PhilHealth' where PersonID='$PersonID'";
            $result = mysqli_query($this->conn, $sql);
            if ($result) {
                echo '<script>alert("Success updating person!")</script>';
                return TRUE;
            } else {
                echo '<script>alert("Failed updating person!")</script>';
                return FALSE;
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
    }

    function updateAdminAccount($PersonID, $Username, $Password) {
        try {
            $sql = "UPDATE adminaccount set Username='$Username', Password='$Password' where PersonID='$PersonID'";
            $result = mysqli_query($this->conn, $sql);
            if ($result) {
                echo '<script>alert("Success updating admin account!")</script>';
                return TRUE;
            } else {
                echo '<script>alert("Failed updating admin account!")</script>';
                return FALSE;
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
    }

    function addItem($ItemName, $ItemQuantity) {
        try {
            $sql1 = "SELECT * from inventory where ItemName='$ItemName'";
            $result1 = mysqli_query($this->conn, $sql1);
            if (mysqli_num_rows($result1) > 0) {
                $sql2 = "SELECT ItemQuantity from inventory where ItemName='$ItemName'";
                $result2 = mysqli_query($this->conn, $sql2);
                while ($rows = mysqli_fetch_assoc($result2)) {
                    $sql3 = "UPDATE inventory SET ItemQuantity=(" . $rows['ItemQuantity'] . '+' . $ItemQuantity . ") where ItemName = '$ItemName'";
                    $result3 = mysqli_query($this->conn, $sql3);
                    if ($result3) {
                        echo '<script>alert("Item updated!")</script>';
                        return TRUE;
                    }
                }
            } else {
                $sql = "INSERT INTO inventory (ItemName, ItemQuantity) VALUES ('$ItemName', $ItemQuantity)";
                $result = mysqli_query($this->conn, $sql);
                if ($result) {
                    echo '<script>alert("Success adding item!")</script>';
                    return TRUE;
                } else {
                    echo '<script>alert("Failed adding item!")</script>';
                    return FALSE;
                }
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
    }

    function getItems() {
        try {
            $sql = "SELECT ItemName, ItemQuantity from inventory";
            $result = mysqli_query($this->conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                return $result;
            } else {
                echo '0 item results';
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
        return $result;
    }

    function editItem($ItemName, $ItemQuantity) {
        try {
            $sql = "UPDATE inventory set ItemQuantity='$ItemQuantity' where ItemName='$ItemName'";
            $result = mysqli_query($this->conn, $sql);
            if ($result) {
                echo '<script>alert("Success editing item!")</script>';
                return TRUE;
            } else {
                echo '<script>alert("Failed editing item!")</script>';
                return FALSE;
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
    }

    function deleteItem($ItemName, $ItemQuantity) {
        try {
            $sql = "DELETE FROM inventory WHERE ItemName='$ItemName' and ItemQuantity='$ItemQuantity'";
            $result = mysqli_query($this->conn, $sql);
            if ($result) {
                echo '<script>alert("Success deleting item!")</script>';
                return TRUE;
            } else {
                echo '<script>alert("Failed deleting item!")</script>';
                return FALSE;
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
    }

    function adminTransactionLog($AdminAccountID, $TransactionLog) {
        try {
            $sql = "INSERT into admintransactionlogs(AdminAccountID, TransactionLog, TransactionDate) values('$AdminAccountID','$TransactionLog', curdate())";
            $result = mysqli_query($this->conn, $sql);
            if ($result) {
                echo '<script>alert("Success creating admin transaction log!")</script>';
                return TRUE;
            } else {
                echo '<script>alert("Failed creating admin transaction log!")</script>';
                return FALSE;
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
    }

    function inventoryTransactionLog($AdminAccountID, $TransactionLog) {
        try {
            $sql = "INSERT into inventorytransactionlogs(AdminAccountID, TransactionLog, TransactionDate) values('$AdminAccountID','$TransactionLog', curdate())";
            $result = mysqli_query($this->conn, $sql);
            if ($result) {
                echo '<script>alert("Success creating inventory transaction log!")</script>';
                return TRUE;
            } else {
                echo '<script>alert("Failed creating inventory transaction log!")</script>';
                return FALSE;
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
    }

        function getAdminTransactionLog() {
            try {
                $sql = "SELECT * from admintransactionlogs INNER JOIN adminaccount on admintransactionlogs.AdminAccountID=adminaccount.AdminAccountID INNER JOIN person on person.PersonID=adminaccount.PersonID";
                $result = mysqli_query($this->conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    return $result;
                } else {
                    echo('<script>alert("0 results");</script>');
                }
            } catch (Exception $ex) {
                echo $ex->getTraceAsString();
            }
            return $result;
        }

        function getInventoryTransactionLog() {
            try {
                $sql = "SELECT * from inventorytransactionlogs INNER JOIN adminaccount on inventorytransactionlogs.AdminAccountID=adminaccount.AdminAccountID INNER JOIN person on person.PersonID=adminaccount.PersonID";
                $result = mysqli_query($this->conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    return $result;
                } else {
                    echo('<script>alert("0 results");</script>');
                }
            } catch (Exception $ex) {
                echo $ex->getTraceAsString();
            }
            return $result;
        }
    }