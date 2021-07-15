
<?php
//starting a session
session_start();
//session id

$EmailAddress = $_SESSION['EmailAddress'];
$Password = $_SESSION['Password'];
$ReviewerID = $_SESSION['ReviewerID'];

$serverName = "TommyXia";
$connectionInfo = array( "Database"=>"CPMS", "UID"=>"tester", "PWD"=>"tester");
$conn = sqlsrv_connect( $serverName, $connectionInfo);


$AppropriatenessOfTopic = $_POST['AppropriatenessOfTopic'];
$TimelinessOfTopic = $_POST['TimelinessOfTopic'];
$SupportiveEvidence = $_POST['SupportiveEvidence'];
$TechnicalQuality = $_POST['TechnicalQuality'];
$ScopeOfCoverage = $_POST['ScopeOfCoverage'];
$CitationOfPreviousWork = $_POST['CitationOfPreviousWork'];
$Originality = $_POST['Originality'];
$OrganizationOfPaper = $_POST['OrganizationOfPaper'];
$ClarityOfMainMessage = $_POST['ClarityOfMainMessage'];
$Mechanics = $_POST['Mechanics'];
$SuitabilityForPresentation = $_POST['SuitabilityForPresentation'];
$PotentialInterestInTopic = $_POST['PotentialInterestInTopic'];
$ComfortLevelTopic = $_POST['ComfortLevelTopic'];
$ComfortLevelAcceptability = $_POST['ComfortLevelAcceptability'];
$OverallRating = $_POST['OverallRating'];
$ContentComments = $_POST['ContentComments'];
$WrittenDocumentComments = $_POST['WrittenDocumentComments'];
$PotentialForOralPresentationComments = $_POST['PotentialForOralPresentationComments'];
$OverallRatingComments = $_POST['OverallRatingComments'];
$Complete = 1;

if( $conn ) {
    echo "successfully submitted";


    $query = "INSERT into Review (ReviewerID, AppropriatenessOfTopic, TimelinessOfTopic, SupportiveEvidence, TechnicalQuality, ScopeOfCoverage
, CitationOfPreviousWork, Originality, OrganizationOfPaper, ClarityOfMainMessage, Mechanics, SuitabilityForPresentation
, PotentialInterestInTopic, ComfortLevelTopic, ComfortLevelAcceptability, OverallRating, ContentComments, WrittenDocumentComments, PotentialForOralPresentationComments, OverallRatingComments
, Complete) Values(?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $params = array($ReviewerID, $AppropriatenessOfTopic, $TimelinessOfTopic, $SupportiveEvidence, $TechnicalQuality, $ScopeOfCoverage, $CitationOfPreviousWork, $Originality, $OrganizationOfPaper, $ClarityOfMainMessage
        , $Mechanics, $SuitabilityForPresentation, $PotentialInterestInTopic, $ComfortLevelTopic, $ComfortLevelAcceptability, $OverallRating, $ContentComments, $WrittenDocumentComments, $PotentialForOralPresentationComments, $OverallRatingComments, $Complete);

    $stmt = sqlsrv_query( $conn, $query, $params);

    //$result = odbc_exec($conn, $query);
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
