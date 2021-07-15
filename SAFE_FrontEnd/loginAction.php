
<?php
//starting a session
session_start();

$serverName = "TommyXia";
$connectionInfo = array( "Database"=>"CPMS", "UID"=>"tester", "PWD"=>"tester");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$EmailAddress = $_POST['EmailAddress'];
$Password = $_POST['Password'];
$Answer = $_POST['accType'];
//
if( $conn ) {
 

    //checking if html form is empty
    if(empty($_POST['EmailAddress']) || empty($_POST['Password']) || $Answer == null){
        echo "All fields are required.";
    }else{


        if($Answer == "admin"){
            
            $stmt = "SELECT * FROM Admin WHERE EmailAddress='{$EmailAddress}' AND Password='{$Password}'";
            $result = sqlsrv_query($conn, $stmt);
        
            //checking if the result was made
            if($result === false){
                die( print_r( sqlsrv_errors(), true));
            }
    
            //checking if there is one row found
            if(sqlsrv_has_rows($result) != 1){
                echo "Invalid Email address or Password!";
            }else{
                
                //to create sessions
                while($row = sqlsrv_fetch_array($result)){
                    $_SESSION['EmailAddress'] = $row['EmailAddress'];
                    $_SESSION['Password'] = $row['Password'];
                    $_SESSION['AdminID'] = $row['AdminID'];
                }
                //passing along the session info
                echo '<br /><a href="homeAdmin.php"></a>';
       

                //redirecting user to their page
                header("Location: homeAdmin.html");


            }

         }else if($Answer == "author"){
            $stmt = "SELECT * FROM Author WHERE EmailAddress='{$EmailAddress}' AND Password='{$Password}'";
            $result = sqlsrv_query($conn, $stmt);
            
            /*
            if( sqlsrv_fetch( $result) === false){
            die( print_r( sqlsrv_errors(), true));                    
            }*/

            

            //checking if the result was made
            if($result === false){
                die( print_r( sqlsrv_errors(), true));
            }
    
            //checking if there is one row found
            if(sqlsrv_has_rows($result) != 1){
                echo "Invalid Email address or Password!";
            }else{
                $AuthorID = sqlsrv_get_field($result, 0);
                //to create sessions
                while($row = sqlsrv_fetch_array($result)){
                    $_SESSION['EmailAddress'] = $row['EmailAddress'];
                    $_SESSION['Password'] = $row['Password'];
                    $_SESSION['AuthorID'] = $row['AuthorID'];
                }
                
                //passing along the session info
                echo '<br /><a href="settingAuthor.php"></a>';
                echo '<br /><a href="submitAuthor.php"></a>';
                echo '<br /><a href="homeAuthor.php"></a>';
                //redirecting user to their page
                header("Location: homeAuthor.php");


            }
    
         }
        
         else if($Answer == "reviewer"){
             $stmt = "SELECT * FROM Reviewer WHERE EmailAddress='{$EmailAddress}' AND Password='{$Password}'";
            $result = sqlsrv_query($conn, $stmt);
        
            //checking if the result was made
            if($result === false){
                die( print_r( sqlsrv_errors(), true));
            }
    
            //checking if there is one row found
            if(sqlsrv_has_rows($result) != 1){
                echo "Invalid Email address or Password!";
            }else{
                
                //to create sessions
                while($row = sqlsrv_fetch_array($result)){
                    $_SESSION['EmailAddress'] = $row['EmailAddress'];
                    $_SESSION['Password'] = $row['Password'];
                    $_SESSION['ReviewerID'] = $row['ReviewerID'];
                }
                //passing along the session info
                echo '<br /><a href="settingReviewer.php"></a>';
                echo '<br /><a href="submitReviewer.php"></a>';
                echo '<br /><a href="homeReviewer.php"></a>';
                //redirecting user to their page
                header("Location: homeReviewer.html");
            }   
         }
    }
    sqlsrv_close($conn);
}else{
    echo "fail";
    die( print_r(sqlsrv_errors(), true));
}

?>
