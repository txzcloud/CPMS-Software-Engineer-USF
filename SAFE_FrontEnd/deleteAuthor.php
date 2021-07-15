
<?php
//starting a session
session_start();

$serverName = "TommyXia";
$connectionInfo = array( "Database"=>"CPMS", "UID"=>"tester", "PWD"=>"tester");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

//

$Author = $_POST['Author'];

//
if( $conn ) {
 
    //checking if html form is empty
    if(empty($_POST['Author'])){
        echo "Please input the targeted id to perform deletion.";
    }else
    {

        $stmt = "SELECT * FROM Author WHERE AuthorID='{$Author}'";
        $result = sqlsrv_query($conn, $stmt);
                   
        //checking if the result was made
        if($result === false){
            die( print_r( sqlsrv_errors(), true));
        }
    
        //checking if there is one row found
        if(sqlsrv_has_rows($result) != 1){
            echo "Targeted record does not exist!";
        }else{

            $query = "DELETE FROM Author WHERE AuthorID='{$Author}'";
            $qresult = sqlsrv_query($conn, $query);

            echo "Author record with id: " . $Author . " has been deleted successfully";
      
            }
               
        //redirecting user to their page
        header("Location: maintainAuthor.php");


    }   
    
      
        
    sqlsrv_close($conn);
}else{
    echo "fail";
    die( print_r(sqlsrv_errors(), true));
}

?>
