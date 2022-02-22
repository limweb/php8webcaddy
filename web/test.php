	<?php
    $serverName = "mssql";
    $connectionOptions = array(
        "Database" => "",
        "Uid" => "sa",
        "PWD" => "K@sem123"
    );
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if($conn){
        echo "Connected!";
    }
    else{
        die(
            print_r(sqlsrv_errors(), true)
        );
    }
    $tsql= "SELECT @@version;";
    $getResults= sqlsrv_query($conn, $tsql);
    if ($getResults == FALSE)
        die(FormatErrors(sqlsrv_errors()));
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
        echo ($row['Id'] . " " . $row['Name'] . " " . $row['Location'] . PHP_EOL);
    }
    
        
?>
