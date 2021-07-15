
<?php
//starting a session
session_start();

$serverName = "TommyXia";
$connectionInfo = array( "Database"=>"CPMS", "UID"=>"tester", "PWD"=>"tester");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

//session id
$EmailAddress = $_SESSION['EmailAddress'];
$Password = $_SESSION['Password'];
//
$FirstName = $_POST['FirstName'];
$MiddleInitial = $_POST['MiddleInitial'];
$LastName = $_POST['LastName'];
$Affiliation = $_POST['Affiliation'];
$Department = $_POST['Department'];
$Address = $_POST['Address'];
$City = $_POST['City'];
$State = $_POST['State'];
$ZipCode = $_POST['ZipCode'];
$PhoneNumber = $_POST['PhoneNumber'];

//
if( $conn ) {
 
        $stmt = "SELECT * FROM Author WHERE EmailAddress='{$EmailAddress}' AND Password='{$Password}'";
        $result = sqlsrv_query($conn, $stmt);
        
        //checking if the result was made
        if($result === false){
            die( print_r( sqlsrv_errors(), true));
        }
    
        //checking if there is one row found
        if(sqlsrv_has_rows($result) != 1){
            echo "Error::Update Fail!";
        }else{
                
            $query = "UPDATE Author 
                      SET FirstName=(?), MiddleInitial=(?), LastName=(?), Affiliation=(?), Department=(?), Address=(?)
                      , City=(?), State=(?), ZipCode=(?), PhoneNumber=(?)
                      WHERE EmailAddress='{$EmailAddress}' AND Password='{$Password}'";
                      // VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            $params = array($FirstName, $MiddleInitial, $LastName, $Affiliation, $Department, $Address, $City, $State, $ZipCode, $PhoneNumber);
            $stmt = sqlsrv_query( $conn, $query, $params);
            
            //checking if statement failed
            if( $stmt === false){   
            die( print_r( sqlsrv_errors(), true));
            }

                //to create sessions
                // while($row = sqlsrv_fetch_array($result)){
                    //   $_SESSION['EmailAddress'] = $row['EmailAddress'];
                    //  $_SESSION['Password'] = $row['Password'];
                //}
                
                //redirecting user to their page
                header("Location: homeAuthor.php");


        }


    sqlsrv_close($conn);
}else{
    echo "fail";
    die( print_r(sqlsrv_errors(), true));
}

?>
