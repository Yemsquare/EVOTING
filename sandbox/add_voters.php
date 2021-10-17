<?php

//Include authentication
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class Voters
require("classes/Voters.php");

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Login</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style_admin.css">
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
                <li><a href="add_nominees.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Nominees</a></li>
                <li class="active"><a href="add_voters.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Voters</a></li>
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
        <div class="col-md-4">
            <?php
            if(isset($_POST['submit'])) {
                $name       = trim($_POST['name']);
                $course     = trim($_POST['course']);
                $year       = trim($_POST['year']);
                $stud_id    = trim($_POST['stud_id']);

                $insertVoter = new Voters();
                $rtnInsertVoter = $insertVoter->INSERT_VOTER($name, $course, $year, $stud_id);
            }
            ?>
            <h4>Add Voters</h4><hr>
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" role="form">
                <div class="form-group-sm">
                    <label for="name">Name</label>
                    <input required type="text" name="name" class="form-control" placeholder="LName, FName MI.">
                </div>
                <div class="form-group-sm">
                    <label for="course">Course</label>
                    <select required name="course" class="form-control">
                        <option value="">*****Select Department*****</option>
                        <option value="BSIT">COMPUTER SCIENCE</option>
                        <option value="COE">COMPUTER ENGINEER</option>
                        <option value="BEE">FOOD TECHNOLOGY</option>
                        <option value="BSE">SCIENCE AND TECHNOLOGY</option>
                        <option value="BSA">HOSPITALITY MANAGEMENT</option>
                        <option value="BSF">MATHEMATICS AND STATISTICS</option>
                        <option value="BHRM">NUTRITION AND DIETETICS</option>
                        <option value="BSHT">LIBRARY AND INFORMATION SCIENCE</option>
                        <option value="CRIMINOLOGY">MASS COMMUNICATION</option>
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
                        <option value="">*****Select Year*****</option>
                        <option value="I">ND I</option>
                        <option value="II">ND II</option>
                        <option value="III">HND I</option>
                        <option value="IV">HND II</option>
                        <option value="V">PND I</option>
                        <option value="VI">PND II</option>
                    </select>
                </div>
                <div class="form-group-sm">
                    <label for="stud_id">Student ID No.</label>
                    <input required type="text" name="stud_id" class="form-control">
                </div><hr>
                <div class="form-group-sm">
                    <input type="submit" name="submit" value="Submit" class="btn btn-info">
                </div>
            </form>
        </div>

        <?php
        $readVoters = new Voters();
        $rtnReadVoters = $readVoters->READ_VOTERS();
        ?>
        <div class="col-md-8">
            <h4>List of Association</h4><hr>
            <div class="table-responsive">
                <?php if($rtnReadVoters) { ?>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th>Name</th>
                        <th>Department/Year</th>
                        <th>Student ID</th>
                        <th><span class="glyphicon glyphicon-edit"></span></th>
                        <th><span class="glyphicon glyphicon-remove"></span></th>
                    </tr>
                    <?php while($rowVoter = $rtnReadVoters->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $rowVoter['name']; ?></td>
                        <td><?php echo $rowVoter['course'] . "-" . $rowVoter['year']; ?></td>
                        <td><?php echo $rowVoter['stud_id']; ?></td>
                        <td><a href="./edit_voter.php?id=<?php echo $rowVoter['id']; ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                        <td><a href="./delete_voter.php?id=<?php echo $rowVoter['id']; ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
                    </tr>
                    <?php } //End while ?>
                </table>
                    <?php $rtnReadVoters->free(); ?>
                <?php } //End if ?>
            </div>
        </div>
    </div>
</div>






<!-- Footer -->
<nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">

    <div class="container">
        <div class="navbar-text pull-left">
        Copyright 2021 @ Ilaro Campus
        </div>
    </div>

</nav>
<!-- End Footer -->

<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

</body>
</html>