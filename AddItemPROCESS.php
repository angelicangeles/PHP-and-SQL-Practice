<html>
    <body>
        <?php
        session_start();
        
        $ItemName = htmlspecialchars($_REQUEST["ItemName"]);
        $ItemQuantity = htmlspecialchars($_REQUEST["ItemQuantity"]);

        include 'Commands.php';
        $AddItemPROCESS = new Commands();
        $cond = $AddItemPROCESS->addItem($ItemName, $ItemQuantity);
        
        $AdminAccountID = $AddItemPROCESS->getAdminAccountID($_SESSION["AdminUsername"], $_SESSION["AdminPassword"]);
        
        if ($cond) {
            $TransactionLog="Admin Added Item: $ItemName, Quantity: $ItemQuantity";
            $AddItemPROCESS->inventoryTransactionLog($AdminAccountID, $TransactionLog);
            echo '<script>alert("Item Successfully Added!");</script>';
        } else {
            echo '<script>alert("Error in Adding Item!");</script>';
        }
        echo $TransactionLog;
        header("location: Inventory.php");
        exit();
        ?>
    </body>
</html>
