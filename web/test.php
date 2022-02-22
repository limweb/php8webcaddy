<<<<<<< HEAD
	<?php
=======
<?php
>>>>>>> 36ba6f0704883a393c36e39de2c6062c102b66a2
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
<<<<<<< HEAD
    
        
?>
=======

?>
>>>>>>> 36ba6f0704883a393c36e39de2c6062c102b66a2
