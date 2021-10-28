<?php
session_start();
include 'Commands.php';
$class = new Commands();

$result = $class->getItems();
?>
<html>
    <title>PHP Practice</title>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}   
        </style>

    <body class="w3-light-grey">

        <!-- Top container -->
        <div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
            <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
            <span class="w3-bar-item w3-right">Logo</span>
        </div>

        <!-- Sidebar/menu -->
        <nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
            <div class="w3-container w3-row">
                <div class="w3-col s4">
                    <img src="img/user.png" class="w3-circle w3-margin-right" style="width:46px">
                </div>
                <div class="w3-col s8 w3-bar">
                    <span>Welcome, <strong><?php echo $class->getFirstName($_SESSION["AdminUsername"], $_SESSION["AdminPassword"]); ?></strong></span><br>
                    <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
                    <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
                    <a href="LogIn.php" class="w3-bar-item w3-button"><i class="fa fa-sign-out"></i></a>
                </div>
            </div>
            <hr>
            <div class="w3-container">
                <h5>Inventory</h5>
            </div>
            <div class="w3-bar-block">
                <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
                <a href="dashboard.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bell fa-fw"></i>  Dashboard</a>
                <?php if ($class->checkIfMasterAdmin($_SESSION["AdminUsername"], $_SESSION["AdminPassword"]) == TRUE) { ?>
                    <a href="RegisterAdmin.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>  Register Admin</a>
                <?php } ?>
                <a href="PersonalInfo.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Personal Information</a>
                <a href="Inventory.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-bullseye fa-fw"></i>  Inventory</a>
                <a href="AdminTransactionLogs.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i>  Admin Transaction Logs</a>
                <a href="InventoryTransactionLogs.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i>  Inventory Transaction Logs</a>
            </div>
        </nav>


        <!-- Overlay effect when opening sidebar on small screens -->
        <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

        <!-- !PAGE CONTENT! -->
        <div class="w3-main" style="margin-left:300px;margin-top:43px;">

            <!-- Header -->
            <header class="w3-container" style="padding-top:22px">
                <h5><b><i class="fa fa-bullseye fa-fw"></i> Inventory</b></h5>
            </header>
            <div class="row">
                <div class="col-12">
                    <section>
                        <center>
                            <table style="width:70%" class="content-table">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Item Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php while ($rows = mysqli_fetch_assoc($result)) { ?>
                                        <tr class='tbodyDT' onclick='setActive(this);'>  
                                            <td>'<?php echo $rows["ItemName"]; ?>'</td>
                                            <td><?php echo $rows["ItemQuantity"]; ?>'</td>
                                            <td>
                                                <form method="POST" action="AddItem.php">
                                                    <input type="hidden" name="AddItemValue" value="1"/>
                                                    <input type="hidden" name="ItemName" value="<?php echo $rows["ItemName"]; ?>"/>
                                                    <input type="hidden" name="ItemQuantity" value="<?php echo $rows["ItemQuantity"]; ?>"/>
                                                    <input type="submit" value="Add Item"/>
                                                </form></td>
                                            <td><form method="POST" action="EditItem.php">
                                                    <input type="hidden" name="ItemName" value="<?php echo $rows["ItemName"]; ?>"/>
                                                    <input type="hidden" name="ItemQuantity" value="<?php echo $rows["ItemQuantity"]; ?>"/>
                                                    <input type="submit" value="Edit Item"/>
                                                </form>
                                            </td>
                                            <td>
                                                <form method="POST" action="DeleteItemPROCESS.php">
                                                    <input type="hidden" name="ItemName" value="<?php echo $rows["ItemName"]; ?>"/>
                                                    <input type="hidden" name="ItemQuantity" value="<?php echo $rows["ItemQuantity"]; ?>"/>
                                                    <input type="submit" value="Delete Item"/>
                                                </form></td>
                                        </tr>
                                    <?php } ?>


                                </tbody>
                            </table>
                        </center>
                        <br><br><br>
                        <center>
                            <form method="POST" action="AddItem.php">
                                <input type="submit" value="Add New Item" class="w3-button w3-dark-grey" onclick="location.href = 'AddItem.php';"/>                   
                            </form>
                        </center>
                </div>
                </center>
                </section>
            </div>


        </section>
    </div>
</div>
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-16 w3-light-grey">

</footer>
<!-- End page content -->
</div>

<script>
// Get the Sidebar
    var mySidebar = document.getElementById("mySidebar");
// Get the DIV with overlay effect
    var overlayBg = document.getElementById("myOverlay");
// Toggle between showing and hiding the sidebar, and add overlay effect
    function w3_open() {
        if (mySidebar.style.display === 'block') {
            mySidebar.style.display = 'none';
            overlayBg.style.display = "none";
        } else {
            mySidebar.style.display = 'block';
            overlayBg.style.display = "block";
        }
    }

// Close the sidebar with the close button
    function w3_close() {
        mySidebar.style.display = "none";
        overlayBg.style.display = "none";
    }
</script>
</body>
</html>

