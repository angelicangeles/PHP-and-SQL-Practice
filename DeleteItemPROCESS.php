<html>
    <body>
        <?php
        session_start();
        
        $ItemName = htmlspecialchars($_REQUEST["ItemName"]);
        $ItemQuantity = htmlspecialchars($_REQUEST["ItemQuantity"]);

        include 'Commands.php';
        $DeleteItemPROCESS = new Commands();
        $cond = $DeleteItemPROCESS->deleteItem($ItemName, $ItemQuantity);
        
        $AdminAccountID = $DeleteItemPROCESS->getAdminAccountID($_SESSION["AdminUsername"], $_SESSION["AdminPassword"]);
        
        if ($cond) {
            $TransactionLog = "Admin Deleted Item: $ItemName, Quantity: $ItemQuantity";
            $DeleteItemPROCESS->inventoryTransactionLog($AdminAccountID, $TransactionLog);
            echo '<script>alert("Item Successfully Edited!");</script>';
        } else {
            echo '<script>alert("Error in Editing Item");</script>';
        }
        header("location: Inventory.php");
        exit();
        ?>
    </body>
</html>
