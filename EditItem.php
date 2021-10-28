<?php
session_start();
include 'Commands.php';
$class = new Commands();

$ItemName = htmlspecialchars($_REQUEST["ItemName"]);
$ItemQuantity = htmlspecialchars($_REQUEST["ItemQuantity"]);
?>
<html>
    <title>PHP Practice</title>
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
                <h5>Edit Item</h5>
            </div>
            <div class="w3-bar-block">
                <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
                <a href="index.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bell fa-fw"></i>  Dashboard</a>
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
                <h5><b><i class="fa fa-bullseye fa-fw"></i> Edit Item</b></h5>
            </header>
            <center>
                <form method="POST" action="EditItemPROCESS.php">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="white-box">
                                <h3 class="box-title">Inventory - Edit Item</h3><br><br>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <input type='text' value='<?php echo $ItemName; ?>' placeholder='Item Name' name='ItemName'>
                                    </div><br>
                                    <div class="col-md-2">
                                        <input type="number" value='<?php echo $ItemQuantity; ?>' name="ItemQuantity" placeholder="Item Quantity">
                                    </div>
                                    <br>
                                    <div class="col-sm-2">
                                        <input type="submit" value="Edit Item" class="w3-button w3-dark-grey"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </center>
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

