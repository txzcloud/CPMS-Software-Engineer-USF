
<?php
//starting a session
session_start();

$serverName = "TommyXia";
$connectionInfo = array( "Database"=>"CPMS", "UID"=>"tester", "PWD"=>"tester");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

//

$Paper = $_POST['Paper'];
$Reviewer = $_POST['Reviewer'];
//
if( $conn ) {
 
    //checking if html form is empty
    if(empty($_POST['Paper']) || empty($_POST['Reviewer'])){
        echo "Please input the targeted ids to perform assignment.";
    }else
    {

        $stmt = "SELECT * FROM Paper WHERE PaperID='{$Paper}'";
        $result = sqlsrv_query($conn, $stmt);
                   
        $stmt2 = "SELECT * FROM Reviewer WHERE ReviewerID='{$Reviewer}'";
        $result2 = sqlsrv_query($conn, $stmt2);

        //checking if the result was made
        if($result === false and $result2 === false){
            die( print_r( sqlsrv_errors(), true));
        }

 
        //checking if there is one row found
        if(sqlsrv_has_rows($result) != 1){
            echo "The provided PaperID do not exist in the record!";
        }elseif(sqlsrv_has_rows($result2) != 1){
            echo "The provided ReviewerID do not exist in the record!";

        }
        else{

            //to add user to database
        $query = "INSERT Into Review (PaperID
                , ReviewerID) VALUES (?, ?)";
        $params = array($Paper, $Reviewer);
        $output = sqlsrv_query( $conn, $query, $params);

        //checking if statement failed
        if( $output === false){   
        die( print_r( sqlsrv_errors(), true));
        }
               
        //redirecting user to their page
        header("Location: match.php");


        }   
    
     }
        
    sqlsrv_close($conn);
} else{
    echo "fail";
    die( print_r(sqlsrv_errors(), true));
}

?>
