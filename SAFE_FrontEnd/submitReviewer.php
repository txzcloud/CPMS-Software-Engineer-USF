
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
        <title>Author</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">





        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="homeAdmin.html">CPMS</a>
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
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="settingReviewer.html" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="settingReviewer.html">Account Settings</a></li>
            
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
                          

                            <!--Missing code placed in test.html sec 1.0-->
                            <div class="sb-sidenav-menu-heading">Interface</div>

                            <a class="nav-link" href="homeReviewer.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Home
                            </a>

                            <a class="nav-link" href="submitReviewer.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Review Paper
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
                        <h1 class="mt-4">Reviewers Record</h1>
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
                                Reviewers
                            </div>


                            <!--table canvas-->
                            <div class="card-table">

                                <form action="updateReviews.php" method="post">
                                    <div>
                                        <table>
                                          
                                        <tr>
                                            <td>Download File</td>
                                            <td>
                                                <?php
                                                 // Array containing sample image file names
                                                $images = array("test2.jpg");
    
                                                // Loop through array to create image gallery
                                                foreach($images as $image){
                                                    echo '<div class="img-box">';
                                                        echo '<img src="C:/xampp/htdocs/phpCon/FrontEnd/SAFE_FrontEnd/database/PaperUpload/' . $image . '" width="200" alt="' .  pathinfo($image, PATHINFO_FILENAME) .'">';
                                                        echo '<p><a href="download.php?file=' . urlencode($image) . '">Download</a></p>';
                                                    echo '</div>';
                                                }
                                                ?>


                                            </td>
                                        </tr>


                                        <tr>
                                            <td>Appropriateness Of Topic</td>
                                            <td><select id="AppropriatenessOfTopic" name="AppropriatenessOfTopic">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                </select></td>
                                        </tr>

                                        <tr>
                                            <td>Timeliness Of Topic</td>
                                            <td><select id="TimelinessOfTopic" name="TimelinessOfTopic">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                </select></td>
                                        </tr>

                                        <tr>
                                            <td>Supportive Evidence</td>
                                            <td><select id="SupportiveEvidence" name="SupportiveEvidence">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                </select></td>
                                        </tr>

                                        <tr>
                                            <td>Technical Quality</td>
                                            <td><select id="TechnicalQuality" name="TechnicalQuality">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                </select></td>
                                        </tr>

                                        <tr>
                                            <td>Scope Of Coverage</td>
                                            <td><select id="ScopeOfCoverage" name="ScopeOfCoverage">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                </select></td>
                                        </tr>

                                        <tr>
                                            <td>Citation Of Previous Work</td>
                                            <td><select id="CitationOfPreviousWork" name="CitationOfPreviousWork">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                </select></td>
                                        </tr>

                                        <tr>
                                            <td>Originality</td>
                                            <td><select id="Originality" name="Originality">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                </select></td>
                                        </tr>

                                        <tr>
                                            <td>Organization Of Paper</td>
                                            <td><select id="OrganizationOfPaper" name="OrganizationOfPaper">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                </select></td>
                                        </tr>

                                        <tr>
                                            <td>Clarity Of Main Message</td>
                                            <td><select id="ClarityOfMainMessage" name="ClarityOfMainMessage">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                </select></td>
                                        </tr>

                                        <tr>
                                            <td>Mechanics</td>
                                            <td><select id="Mechanics" name="Mechanics">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                </select></td>
                                        </tr>

                                        <tr>
                                            <td>Suitability For Presentation</td>
                                            <td><select id="SuitabilityForPresentation" name="SuitabilityForPresentation">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                </select></td>
                                        </tr>

                                        <tr>
                                            <td>Potential Interest In Topic</td>
                                            <td><select id="PotentialInterestInTopic" name="PotentialInterestInTopic">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                </select></td>
                                        </tr>

                                        <tr>
                                            <td>Comfort Level Topic</td>
                                            <td><select id="ComfortLevelTopic" name="ComfortLevelTopic">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                </select></td>
                                        </tr>

                                        <tr>
                                            <td>Comfort Level Acceptability</td>
                                            <td><select name="ComfortLevelAcceptability" id="ComfortLevelAcceptability">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                </select></td>
                                        </tr>

                                        <tr>
                                            <td>Calculate overall score</td>
                                            <td><input id="Score" type="button" value="Score" name="Score" onclick="add_number()"/></td>
                                        </tr>

                                        <tr>
                                            <td>Overall Score</td>
                                            <td><input id="OverallRating" type="text" name="OverallRating"/></td>
                                        </tr>

                                        <tr>
                                            <td>Content Comments</td>
                                            <td><textarea name="ContentComments" id="ContentComments" rows="4" cols="40"></textarea></td>
                                        </tr>

                                        <tr>
                                            <td>Written Document Comments</td>
                                            <td><textarea name="WrittenDocumentComments" id="WrittenDocumentComments" rows="4" cols="40"></textarea></td>
                                        </tr>

                                        <tr>
                                            <td>Potential for Oral Presentation Comments</td>
                                            <td><textarea name="PotentialForOralPresentationComments" id="PotentialForOralPresentationComments" rows="4" cols="40"></textarea></td>
                                        </tr>

                                        <tr>
                                            <td>Overall Score Comments</td>
                                            <td><textarea name="OverallRatingComments" id="OverallRatingComments" rows="4" cols="40"></textarea></td>
                                        </tr>


                                    </table>
                                    <br>
                                    <input id="Submit1" type="submit" value="submit" name="submit"/>
                                        </div>
                                </form>

                            </div>
                            <script src="calculateOverallScore.js"></script>
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