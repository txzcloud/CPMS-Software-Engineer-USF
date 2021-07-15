<?php

$serverName = "TommyXia";
$connectionInfo = array( "Database"=>"CPMS", "UID"=>"tester", "PWD"=>"tester");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$EmailAddress = $_POST['EmailAddress'];
$Password = $_POST['Password'];
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

//AND Password='{$Password}'
if($conn){
    echo "successfully submitted";

    $stmt = "SELECT * FROM Author WHERE EmailAddress='{$EmailAddress}'";
    $result = sqlsrv_query($conn, $stmt);

    //check if search is made
    if($result === false){
        die( print_r( sqlsrv_errors(), true));
    }

    //check if email is existed in the database
    if(sqlsrv_has_rows($result) == 1){
        //if there is one record, tell user email address already taken
        echo "This Email Address is already registered! Please Login into your account.";
    }else{    
        
        //to add user to database
        $query = "INSERT Into Author (FirstName
                , MiddleInitial
                , LastName
                , Affiliation  
                , Department
                , Address
                , City
                , State
                , ZipCode
                , PhoneNumber
                , EmailAddress
                , Password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $params = array($FirstName, $MiddleInitial, $LastName, $Affiliation, $Department, $Address, $City, $State, $ZipCode, $PhoneNumber, $EmailAddress, $Password);
        $stmt = sqlsrv_query( $conn, $query, $params);

        //checking if statement failed
        if( $stmt === false){   
        die( print_r( sqlsrv_errors(), true));
        }

        //redirect the user to login their accounts that was just created
        header("Location: login.html");

        /*
        while($row = sqlsrv_fetch_array($result)){
            $_SESSION['EmailAddress'] = $row['EmailAddress'];
            $_SESSION['Password'] = $row['Password'];
        }
                
        //redirecting user to their page
        header("Location: index.html");
        **/

    }
    sqlsrv_close($conn);

}
else{
    echo "fail";
    die( print_r(sqlsrv_errors(), true));
}

?>
