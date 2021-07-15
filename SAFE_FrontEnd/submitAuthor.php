
<?php

//todo:
//find out how to update database of existing record associated with the updater
//use this combination to find author ID
//$EmailAddress = $_POST['EmailAddress'];
//$Password = $_POST['Password'];


//++++++++
//starting a session
session_start();
//session id
$EmailAddress = $_SESSION['EmailAddress'];
$Password = $_SESSION['Password'];
$AuthorID = $_SESSION['AuthorID'];
//

$serverName = "TommyXia";
$connectionInfo = array( "Database"=>"CPMS", "UID"=>"tester", "PWD"=>"tester");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
//++++++++



//topics here
$AoA = (isset($_POST['AoA']) == 'AnalysisOfAlgorithm' ? '1' : '0');
$Applications = (isset($_POST['Applications']) == 'Applications' ? '1' : '0');
$Architecture = (isset($_POST['Architecture']) == '1' ? '1' : '0');
$AI = (isset($_POST['AI']) == '1' ? '1' : '0');
$CE = (isset($_POST['CE']) == '1' ? '1' : '0');
$Curriculum = (isset($_POST['Curriculum']) == '1' ? '1' : '0');
$DS = (isset($_POST['CS']) == '1' ? '1' : '0');
$DB = (isset($_POST['DB']) == '1' ? '1' : '0');
$DL = (isset($_POST['DL']) == '1' ? '1' : '0');
$DistS = (isset($_POST['DistS']) == '1' ? '1' : '0');
$ESI = (isset($_POST['ESI']) == '1' ? '1' : '0');
$FYC = (isset($_POST['FYC']) == '1' ? '1' : '0');
$GI = (isset($_POST['GI']) == '1' ? '1' : '0');
$GW = (isset($_POST['GW']) == '1' ? '1' : '0');
$GIP = (isset($_POST['GIP']) == '1' ? '1' : '0');
$HCI = (isset($_POST['HCI']) == '1' ? '1' : '0');
$LE = (isset($_POST['LE']) == '1' ? '1' : '0');
$Literacy = (isset($_POST['Literacy']) == '1' ? '1' : '0');
$MIC = (isset($_POST['MIC']) == '1' ? '1' : '0');
$MM = (isset($_POST['MM']) == '1' ? '1' : '0');
$NDC = (isset($_POST['NDC']) == '1' ? '1' : '0');
$NMC = (isset($_POST['NMC']) == '1' ? '1' : '0');
$OOI = (isset($_POST['OOI']) == '1' ? '1' : '0');
$OS = (isset($_POST['OS']) == '1' ? '1' : '0');
$PP = (isset($_POST['PP']) == '1' ? '1' : '0');
$Pedagogy = (isset($_POST['Pedagogy']) == '1' ? '1' : '0');
$PL = (isset($_POST['PL']) == '1' ? '1' : '0');
$Research = (isset($_POST['Research']) == '1' ? '1' : '0');
$Security = (isset($_POST['Security']) == '1' ? '1' : '0');
$SE = (isset($_POST['SE']) == '1' ? '1' : '0');
$SAD = (isset($_POST['SAD']) == '1' ? '1' : '0');
$UTC = (isset($_POST['UTC']) == '1' ? '1' : '0');
$WIP = (isset($_POST['WIP']) == '1' ? '1' : '0');
$Other = (isset($_POST['Other']) == '1' ? '1' : '0');

//other information
$Title = $_POST['title'];
$Certification = $_POST['certification'];
$OD = $_POST['OtherDescription'];
$NTR = $_POST['NTR'];

//file related information
$file = $_FILES['file'];
$name = $_FILES['file']['name'];
$tmpName = $_FILES['file']['tmp_name'];
$temp = explode(".", $name);
$newfilename = round(microtime(true)) . '.' . end($temp);
$path = 'C:/xampp/htdocs/phpCon/FrontEnd/SAFE_FrontEnd/database/PaperUpload/' .$newfilename;

if( $conn ) {
      
    //uploading file to source code folder
    if(move_uploaded_file($_FILES['file']['tmp_name'], $path )){
        echo "success";
    }
    else{
        echo "fail";
    }
   
    //query for inserting all data in this form into database
    $query = "INSERT INTO Paper (AuthorID, FilenameOriginal, Filename, Title, Certification, NotesToReviewers ,AnalysisOfAlgorithms, Applications, Architecture
              , ArtificialIntelligence, ComputerEngineering, Curriculum, DataStructures, Databases
              , DistanceLearning, DistributedSystems, EthicalSocietalIssues, FirstYearComputing, GenderIssues
              , GrantWriting, GraphicsImageProcessing, HumanComputerInteraction, LaboratoryEnvironments, Literacy
              , MathematicsInComputing, Multimedia, NetworkingDataCommunications, NonMajorCourses, ObjectOrientedIssues
              , OperatingSystems, ParallelsProcessing, Pedagogy, ProgrammingLanguages, Research
              , Security, SoftwareEngineering, SystemsAnalysisAndDesign, UsingTechnologyInTheClassroom, WebAndInternetProgramming
              , Other, OtherDescription ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    //$result = sqlsrv_query($conn, $stmt);
    $params = array($AuthorID, $name, $newfilename, $Title, $Certification, $NTR,$AoA, $Applications, $Architecture
                    , $AI, $CE, $Curriculum, $DS, $DB
                    , $DL, $DistS, $ESI, $FYC, $GI
                    , $GW, $GIP, $HCI, $LE, $Literacy
                    , $MIC, $MM, $NDC, $NMC, $OOI
                    , $OS, $PP, $Pedagogy, $PL, $Research
                    , $Security, $SE, $SAD, $UTC, $WIP
                    , $Other, $OD);

    $stmt = sqlsrv_query($conn, $query, $params);

    //checking if the result was made
    if($stmt === false){
        die( print_r( sqlsrv_errors(), true));
    }

    //redirecting user to their page
    header("Location: submitAuthor.html");
    sqlsrv_close($conn);
}else{
    echo "fail";
    die( print_r(sqlsrv_errors(), true));
}

?>


