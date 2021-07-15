
<?php
//starting a session
session_start();

$serverName = "TommyXia";
$connectionInfo = array( "Database"=>"CPMS", "UID"=>"tester", "PWD"=>"tester");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

//

$Reviewer = $_POST['Reviewer'];

//
if( $conn ) {
 
    //checking if html form is empty
    if(empty($_POST['Reviewer'])){
        echo "Please input the targeted id to perform deletion.";
    }else
    {

        $stmt = "SELECT * FROM Reviewer WHERE ReviewerID='{$Reviewer}'";
        $result = sqlsrv_query($conn, $stmt);
                   
        //checking if the result was made
        if($result === false){
            die( print_r( sqlsrv_errors(), true));
        }
    
        //checking if there is one row found
        if(sqlsrv_has_rows($result) != 1){
            echo "Targeted record does not exist!";
        }else{
            $query = "DELETE FROM Reviewer WHERE ReviewerID='{$Reviewer}'";
            $qresult = sqlsrv_query($conn, $query);

            echo "Reviewer record with id: " . $Reviewer . " has been deleted successfully";
      
            }
               
        //redirecting user to their page
        header("Location: maintainReviewer.php");


    }   
    
      
        
    sqlsrv_close($conn);
}else{
    echo "fail";
    die( print_r(sqlsrv_errors(), true));
}

?>
