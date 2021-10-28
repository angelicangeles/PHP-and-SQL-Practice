<html>
    <body>
        <?php
        session_start();
        
        $ItemName = htmlspecialchars($_REQUEST["ItemName"]);
        $ItemQuantity = htmlspecialchars($_REQUEST["ItemQuantity"]);

        include 'Commands.php';
        $EditItemPROCESS = new Commands();
        $cond = $EditItemPROCESS->editItem($ItemName, $ItemQuantity);
        
        $AdminAccountID = $EditItemPROCESS->getAdminAccountID($_SESSION["AdminUsername"], $_SESSION["AdminPassword"]);
        
        if ($cond) {
            $TransactionLog = "Admin Edited Item: $ItemName, Quantity: $ItemQuantity";
            $EditItemPROCESS->inventoryTransactionLog($AdminAccountID, $TransactionLog);
            echo '<script>alert("Item Successfully Edited!");</script>';
        } else {
            echo '<script>alert("Error in Editing Item");</script>';
        }
        header("location: Inventory.php");
        exit();
        ?>
    </body>
</html>
