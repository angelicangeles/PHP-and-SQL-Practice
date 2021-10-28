<?php
session_start();
include 'Commands.php';
$Person = new Commands();
$FirstName = htmlspecialchars($_REQUEST["FirstName"]);
$MiddleName = htmlspecialchars($_REQUEST["MiddleName"]);
$LastName = htmlspecialchars($_REQUEST["LastName"]);
$Suffix = htmlspecialchars($_REQUEST["Suffix"]);

$result = $Person->getPersonInfo($FirstName, $MiddleName, $LastName, $Suffix);
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
                    <span>Welcome, <strong><?php echo $Person->getFirstName($_SESSION["AdminUsername"], $_SESSION["AdminPassword"]); ?></strong></span><br>
                    <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
                    <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
                    <a href="LogIn.php" class="w3-bar-item w3-button"><i class="fa fa-sign-out"></i></a>
                </div>
            </div>
            <hr>
            <div class="w3-container">
                <h5>Personal Information</h5>
            </div>
            <div class="w3-bar-block">
                <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
                <a href="dashboard.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bell fa-fw"></i>  Dashboard</a>
                <a href="RegisterAdmin.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>  Register Admin</a>
                <a href="PersonalInfo.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw"></i>  Personal Information</a>
                <a href="Inventory.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"></i>  Inventory</a>
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
                <h5><b><i class="fa fa-users fa-fw"></i> Personal Information</b></h5>
            </header>
            <center>
                <form method="POST" action="PersonalInfoPROCESS.php">
                    <div class="row">
                        <div class="col-md-12">
                            <center> <h3 class="box-title">Update Personal Information</h3> 
                                <?php while ($rows = mysqli_fetch_assoc($result)) { 
                                    $_SESSION["FirstName"] = $rows["FirstName"];
                                    $_SESSION["MiddleName"] = $rows["MiddleName"];
                                    $_SESSION["LastName"] = $rows["LastName"];
                                    $_SESSION["Suffix"] = $rows["Suffix"];?>
                                    <input name='HiddenUsername' value='<?php echo $rows["Username"]; ?>' type='hidden'>
                                    <div class="form-group" >
                                        <input name='FirstName' value='<?php echo $rows["FirstName"]; ?>' type='text' class="form-control" placeholder="First Name" title='First Name' data-pattern='textOnly' required>
                                    </div>
                                    <div class="form-group">
                                        <input name='MiddleName'  value='<?php echo $rows["MiddleName"]; ?>' type='text' class="form-control"placeholder="Middle Name" data-pattern='textOnly' required>
                                    </div>
                                    <div class="form-group">
                                        <input name='LastName' value='<?php echo $rows["LastName"]; ?>' type='text' class="form-control"  placeholder="Last Name" data-pattern='textOnly' required>
                                    </div>
                                    <div class="form-group">
                                        <input name='Suffix'  value='<?php echo $rows["Suffix"]; ?>' type='text' class="form-control"  placeholder='Suffix' data-pattern='textOnly'>
                                    </div>
                                    <div class="form-group">
                                        <input name='ContactNo'  value='<?php echo $rows["ContactNo"]; ?>' class="form-control" type='tel'  placeholder="Contact No." minlength=11 maxlength=13 title='Contact Number' data-pattern='numberOnly' required>
                                    </div>
                                    <div class="form-group">
                                        <input  type='text' value='<?php echo $rows["HouseNo"]; ?>' class="form-control"  placeholder='House No.' name='HouseNo' title='House Number'>
                                    </div>
                                    <div class="form-group">
                                        <input type='text'  value='<?php echo $rows["StreetName"]; ?>' class="form-control"  placeholder='Street Name' name='StreetName' title='Street Name' required>
                                    </div>
                            </div>
                            <div class="form-group">
                                <input type='text'  value='<?php echo $rows["Subdivision"]; ?>' class="form-control"  placeholder='Subdivision' name='Subdivision' title='Subdivision'>
                            </div>
                            <div class="form-group">
                                <input type='text'  value='<?php echo $rows["Username"]; ?>' class="form-control"  placeholder='Username' name='Username' title='Username'>
                            </div>
                            <div class="form-group">
                                <input type='password' class="form-control"   value='<?php echo $rows["Password"]; ?>' placeholder='Password' name='Password' title='Password'>
                                <br><div class="custom-select" style='height: auto;'>
                                    <br>
                                    <label for="birthday" class="col-md-12">Birth Date </label><br>
                                    <input type='date' class="form-control"    value='<?php echo $rows["Birthday"]; ?>' placeholder="Birth Date" name='Birthday' value="yyyy-mm-dd" class='birthdate' title='Birth Date' required>
                                </div><br>
                                <div class="form-group">
                                    <input type='text'  value='<?php echo $rows["Barangay"]; ?>' class="form-control"  placeholder='Barangay' name='Barangay' title='Barangay'>
                                </div>
                                <div class="form-group">
                                    <input type='text'  value='<?php echo $rows["City"]; ?>' class="form-control"  placeholder='City' name='City' title='City'>
                                </div>
                                <div class="form-group">
                                    <input type='text'  value='<?php echo $rows["Region"]; ?>' class="form-control"  placeholder='Region' name='Region' title='Region'>
                                </div>
                                <div class="form-group">
                                    <input type="number"  value='<?php echo $rows["SSS"]; ?>' name="SSS" placeholder="SSS Reference No." required><br>
                                    <input type="number"  value='<?php echo $rows["PagIbig"]; ?>' name="PagIbig" placeholder="Pag Ibig Reference No." required><br>
                                    <input type="number"  value='<?php echo $rows["BirthCertificate"]; ?>' name="BirthCertificate" placeholder="NSO Birth Certicate Reference No." required><br>
                                    <input type="number"  value='<?php echo $rows["GSIS"]; ?>' name="GSIS" placeholder="GSIS Reference No."><br>
                                    <input type="number"  value='<?php echo $rows["PhilHealth"]; ?>' name="PhilHealth" placeholder="PhilHealth Reference No." required><br>
                                </div>

                                <br>
                                <center>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <?php if ($rows["Gender"] == "Male") { ?>
                                                <label for="gender" class="col-md-12">Gender: </label>
                                                <input type="radio" id="male" name="Gender" value="Male" checked>
                                                <label for="male">Male</label>
                                                <input type="radio" id="female" name="Gender" value="Female">
                                                <label for="female">Female</label>
                                            <?php } else { ?>
                                                <label for="gender" class="col-md-12">Gender: </label>
                                                <input type="radio" id="male" name="Gender" value="Male">
                                                <label for="male">Male</label>
                                                <input type="radio" id="female" name="Gender" value="Female" checked>
                                                <label for="female">Female</label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </center>
                            </div>   
                            <center>
                                <br>
                                <div id='BTNS'>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center">
                                            <input type="submit" value="Update" class="w3-button w3-dark-grey"/>
                                        </div>
                                    </div>
                                </div>

                            </center>

                        <?php } ?>
                    </div>
                </form>
            </center>
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

