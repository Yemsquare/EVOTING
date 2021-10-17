<?php

//Include authentication
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class Organization
require("classes/Organization.php");

//Include class Position
require("classes/Position.php");

//Include class Nominees
require("classes/Nominees.php");

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Login</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style_admin.css">

    <script>
        function getPos(val) {
            $.ajax({
                type: "POST",
                url: "get_pos.php",
                data: 'org='+val,
                success: function(data) {
                    $("#pos-list").html(data);
                }
            });
        }
    </script>
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Voting Sytem</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="admin_page.php"><span class="glyphicon glyphicon-home"></span></a></li>
                <li><a href="add_org.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Association</a></li>
                <li><a href="add_pos.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Position</a></li>
                <li class="active"><a href="add_nominees.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Nominees</a></li>
                <li><a href="add_voters.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Voters</a></li>
                <li><a href="vote_result.php"><span class="glyphicon glyphicon-plus-sign"></span>Vote Result</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="process/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->

    </div><!-- /.container-fluid -->
</nav>
<!-- End Header -->





<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <?php
            if(isset($_POST['update'])) {
                $org        = trim($_POST['organization']);
                $pos        = trim($_POST['position']);
                $name       = trim($_POST['name']);
                $course     = trim($_POST['course']);
                $year       = trim($_POST['year']);
                $stud_id    = trim($_POST['stud_id']);
                $nominee_id = trim($_POST['nom_id']);

                $updateNominee = new Nominees();
                $rtnUpdateNominee = $updateNominee->UPDATE_NOMINEE($org, $pos, $name, $course, $year, $stud_id, $nominee_id);

            }
            ?>
            <h4>Edit Nominee</h4><hr>

            <?php
            if(isset($_GET['id'])) {
                $nom_id = trim($_GET['id']);

                $editNominee = new Nominees();
                $rtnEditNominee = $editNominee->EDIT_NOMINEE($nom_id);
            }
            ?>

            <?php if($rtnEditNominee) { ?>
                <?php while($rowNominee = $rtnEditNominee->fetch_assoc()) { ?>
                <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" role="form">
                    <?php
                    $readOrg = new Organization();
                    $rtnReadOrg = $readOrg->READ_ORG();
                    ?>
                    <div class="form-group-sm">
                        <label for="organization">Association</label>
                        <?php if($rtnReadOrg) { ?>
                            <select required name="organization" class="form-control" id="org-list" onchange="getPos(this.value);">
                                <option value="<?php echo $rowNominee['org']; ?>"><?php echo $rowNominee['org']; ?></option>
                                <?php while($rowOrg = $rtnReadOrg->fetch_assoc()) { ?>
                                    <option value="<?php echo $rowOrg['org']; ?>"><?php echo $rowOrg['org']; ?></option>
                                <?php } //End while ?>
                            </select>
                            <?php $rtnReadOrg->free(); ?>
                        <?php } //End if ?>
                    </div>
                    <div class="form-group-sm">
                        <label for="position">Position</label>
                        <select required name="position" class="form-control" id="pos-list">
                            <option value="<?php echo $rowNominee['pos']; ?>"><?php echo $rowNominee['pos']; ?></option>
                        </select>
                    </div>
                    <div class="form-group-sm">
                        <label for="name">Name</label>
                        <input required type="text" name="name" class="form-control" value="<?php echo $rowNominee['name']; ?>">
                    </div>
                    <div class="form-group-sm">
                        <label for="course">Course</label>
                        <select required name="course" class="form-control">
                            <option value="<?php echo $rowNominee['course']; ?>"><?php echo $rowNominee['course']; ?></option>
                            <option value="">*****Select Department*****</option>
                        <option value="CSC">COMPUTER SCIENCE</option>
                        <option value="CNG">COMPUTER ENGINEER</option>
                        <option value="FT">FOOD TECHNOLOGY</option>
                        <option value="SLT">SCIENCE AND TECHNOLOGY</option>
                        <option value="HM">HOSPITALITY MANAGEMENT</option>
                        <option value="MATH&STA">MATHEMATICS AND STATISTICS</option>
                        <option value="NUTD">NUTRITION AND DIETETICS</option>
                        <option value="LIS">LIBRARY AND INFORMATION SCIENCE</option>
                        <option value="MCOM">MASS COMMUNICATION</option>
                        <option value="OTM">OFFICE TECHNOLOGY AND MANAGEMENT</option>
                        <option value="ACCT">ACCOUNTANCY</option>
                        <option value="BF">BANKING AND FINANCE</option>
                        <option value="BAM">BUSINESS ADMINISTRATION AND MANAGEMENT</option>
                        <option value="GS">GENERAL STUDIES</option>
                        <option value="MK"> MARKETING</option>
                        <option value="PA">PUBLIC ADMINISTRATION</option>
                        <option value="INS">INSURANCE</option>
                        <option value="TAX">TAXATION</option>
                        <option value="CNG">CIVIL ENGINEERING</option>
                        <option value="EEE">ELECTRICAL/ELECTRONICS ENGINEERING</option>
                        <option value="MENG">MECHANICAL ENGINEERING</option>
                        <option value="ABET">AGRICULTURAL AND BIO - ENVIRONMENTAL ENGINEERING TECHNOLOGY</option>
                        <option value="BT">BUILDING TECHNOLOGY</option>
                        <option value="EMV">ESTATE MANAGEMENT AND VALUATION</option>
                        <option value="QS">QUANTITY SURVEYING</option>
                        <option value="URP">URBAN AND REGIONAL PLANNING</option>
                        <option value="SG">SURVEYING & GEOINFORMATICS </option>
                        <option value="AT">ARCHITECTURAL TECHNOLOGY</option>
                        <option value="AR">ARTS & DESIGN</option>
                        <option value="TPM">TRANSPORTATION PLANNING & MANAGEMENT</option>
                        </select>
                    </div>
                    <div class="form-group-sm">
                        <label for="year">Year</label>
                        <select required name="year" class="form-control">
                            <option value="<?php echo $rowNominee['year']; ?>"><?php echo $rowNominee['year']; ?></option>
                            <option value="NDI">ND I</option>
                            <option value="NDII">ND II</option>
                            <option value="HNDI">HND I</option>
                            <option value="HNDII">HND II</option>
                            <option value="PNDI">PND I</option>
                            <option value="PNDII">PND II</option>
                        </select>
                    </div>
                    <div class="form-group-sm">
                        <label for="stud_id">Student ID</label>
                        <input required type="text" name="stud_id" class="form-control" value="<?php echo $rowNominee['stud_id']; ?>">
                    </div>
                    <hr/>
                    <div class="form-group-sm">
                        <input type="hidden" name="nom_id" value="<?php echo $rowNominee['id']; ?>">
                        <input type="submit" name="update" value="Update" class="btn btn-info">
                    </div>
                </form>
                <?php } //End while ?>
                <?php $rtnEditNominee->free(); ?>
            <?php } //End if ?>
        </div>
    </div>
</div>






<!-- Footer -->
<nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">

    <div class="container">
        <div class="navbar-text pull-left">
            Copyright 2021
        </div>
    </div>

</nav>
<!-- End Footer -->

<script src="../assets/js/jquery.js"></script>
<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

</body>
</html>