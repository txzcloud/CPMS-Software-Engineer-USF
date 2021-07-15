
<?php
//starting a session
session_start();
//session id
$EmailAddress = $_SESSION['EmailAddress'];
$Password = $_SESSION['Password'];
$AuthorID = $_SESSION['AuthorID'];

$serverName = "TommyXia";
$connectionInfo = array( "Database"=>"CPMS", "UID"=>"tester", "PWD"=>"tester");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Author Submission Form</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="homeAuthor.php">CPMS</a>
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
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="settingAuthor.html" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Account Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!--Left Side Nav Buttons-->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <!--
                            <div class="sb-sidenav-menu-heading">Home</div>
                            <a class="nav-link" href="authorInfo.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Personal Information
                            </a>
                            -->

                            <!--Missing code placed in test.html sec 1.0-->
                            <div class="sb-sidenav-menu-heading">Interface</div>

                            <a class="nav-link" href="homeAuthor.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Home
                            </a>

                            <a class="nav-link" href="submitAuthor.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Submit Paper
                            </a>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Author
                         <a class="nav-link" href="login.html"> 
                        Logout                           
                        </a>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Home</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Paper Score</li>
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
                                Paper Review Score
                            </div>
                            <!--table canvas-->
                            <div class="card-body">
                              


<?php
//
if( $conn ) {
        //look into looping this for multiple papers for the same authors

        $verify = "SELECT PaperID, Title FROM Paper WHERE AuthorID='{$AuthorID}'";
        $rverify = sqlsrv_query($conn, $verify);
       
        //checking if the result was made
        if($rverify === false){
            die( print_r( sqlsrv_errors(), true));
        }
        
        if( sqlsrv_fetch( $rverify) === false){
            die( print_r( sqlsrv_errors(), true));                    
        }else{
            $PaperID = sqlsrv_get_field( $rverify, 0);                        
            $Title = sqlsrv_get_field( $rverify, 1);  
        }

     
       

        //getting the reviews based on the paperid corresponding to author
        $query = "SELECT * FROM Review WHERE PaperID='{$PaperID}'";
        $stmt = sqlsrv_query($conn, $query);
        

        echo "<table>";
        echo "<th>Paper Title</th>";
        echo "<th>Originality</th>";
        echo "<th>Content Comments</th>";
        echo "<th>Overall Rating</th>";
        echo "<th>Overall Rating Comments</th>";
        echo "<th>Complete</th>";

            
        while($row = sqlsrv_fetch_object($stmt)){
            echo "<tr><td>$Title</td>" ;
            echo "<td>" . $row->Originality . "</td><td>" . $row->ContentComments 
                            . "</td><td>" . $row->OverallRating . "</td><td>" . $row->OverallRatingComments
                            . "</td><td>" . $row->Complete . "</td></tr>";
        //echo "<tr><td>" . $row->PaperID . "</td><td>" . $row->PaperID . "</td></tr>";
        
        }
        
        echo "</table>";

   
    if( $rverify === false){
        die( print_r( sqlsrv_errors(), true));
    }
    if( $stmt === false){
        die( print_r( sqlsrv_errors(), true));
    }


    sqlsrv_close($conn);
}else{
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

 
    </body>
</html>

















































