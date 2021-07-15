<?php
    
    //connection to database
    $serverName = "TommyXia";
    $connectionInfo = array( "Database"=>"CPMS", "UID"=>"tester", "PWD"=>"tester");
    $conn = sqlsrv_connect( $serverName, $connectionInfo) or die("Failed to connect!");


    //select a database to work with
    $query = "SELECT EmailAddress, Password";
    $query .= "FROM Author";

    //preps and execute query
    $result = sqlsrv_query($conn, $query);

    $numRows = sqlsrv_num_rows( $result);
    echo "<h1>".$numRows." Row".($numRows == 1 ? "" : "s")."Returned </h1>";

    //display the results

    while($row = sqlsrv_fetch_array( $results)){
        echo "<li>".$row['EmailAddress'].$row['Password']."</li>";

    }


    sqlsrv_free_stmt( $results);





?>





