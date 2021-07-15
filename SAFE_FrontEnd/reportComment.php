
<?php
//starting a session
session_start();

$serverName = "TommyXia";
$connectionInfo = array( "Database"=>"CPMS", "UID"=>"tester", "PWD"=>"tester");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

//session id
$EmailAddress = $_SESSION['EmailAddress'];
$Password = $_SESSION['Password'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Reviewer Comment Page</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="authorInfo.html">CPMS</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search" aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="settingAdmin.html" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="settingAdmin.html">Account Settings</a></li>
            
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="login.html">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!--Left Side Nav Buttons-->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Reports</div>
                            
                            <a class="nav-link" href="homeAdmin.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Home
                            </a>


                            <a class="nav-link" href="reportAuthor.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Author Reports
                            </a>

                            <a class="nav-link" href="reportPaper.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Paper Reports
                            </a>

                            <a class="nav-link" href="reportReviewer.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Reviewers Reports
                            </a>

                            <a class="nav-link" href="reportComment.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Review Comment Reports
                            </a>

                            

                            <!--Missing code placed in test.html sec 1.0-->
                            <div class="sb-sidenav-menu-heading">Maintenance</div>
                            <a class="nav-link" href="match.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Match Paper and Reviewers
                            </a>

                            <a class="nav-link" href="maintainAuthor.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Author
                            </a>

                            <a class="nav-link" href="maintainReviewer.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Reviewer
                            </a>

                            <a class="nav-link" href="maintainReview.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Reviews
                            </a>

                            <a class="nav-link" href="maintainPaper.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Papers
                            </a>

                        </div>


                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin 
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Review Comment Report</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"></li>
                        </ol>
                        <hr>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">

                            </div>
                            <div class="col-xl-3 col-md-6">

                            </div>
                            <div class="col-xl-3 col-md-6">

                            </div>
                            <div class="col-xl-3 col-md-6">

                            </div>
                        </div>
                        <div class="row">

                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Reviewer Comments
                            </div>
                            <!--table canvas-->
                            <div class="card-table">
 <?php
   
    if( $conn ) {
    //++++++++++++++++++++++++++

    $query = "SELECT * FROM Review, Paper, Reviewer WHERE Review.PaperID=Paper.PaperID AND Review.ReviewerID=Reviewer.ReviewerID";
    $stmt = sqlsrv_query($conn, $query);


    echo "<table border=1>
     <thead>
        <tr>
            <th>First Name</th>
            <th>Middle Initial</th>
            <th>Last Name</th>
            <th>Email Address</th>

            <th>Filename</th>
            <th>Title</th>

            <th>Content Comments</th>
            <th>Written Document Comments</th>
            <th>Potential For Oral Presentation Comments</th>
            <th>Overall Rating Comments</th>
        </tr>
     </thead>";
       echo "<tbody>";

           while($row = sqlsrv_fetch_object($stmt))
            {
                echo "<tr><td>" . $row->FirstName
                . "</td><td>" . $row->MiddleInitial
                . "</td><td>" . $row->LastName
                . "</td><td>" . $row->EmailAddress

                . "</td><td>" . $row->Filename
                . "</td><td>" . $row->Title

                . "</td><td>" . $row->ContentComments
                . "</td><td>" . $row->WrittenDocumentComments
                . "</td><td>" . $row->PotentialForOralPresentationComments
                . "</td><td>" . $row->OverallRatingComments

                . "</td></tr>";
            }

       echo "</tbody>";

    echo "</table>";


    //++++++++++++++++++++++++++


    if( $stmt === false){
        die( print_r( sqlsrv_errors(), true));
    }

        sqlsrv_close($conn);
    }
    else{
    echo "fail";
    die( print_r(sqlsrv_errors(), true));
    }


 ?>
                            </div>
                        </div>





                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; www.safe.com 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>


        <!--
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
        -->
</body>
</html>