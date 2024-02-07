<?php
// Insert Data to SQLServer

$serverName ="MSI"; //(servername\instanceName)

// Since UID and PWD are not specified in the $connectionInfo array, // The connection will be attempted using Windows Authentication.

$connectionInfo = array("Database"=>"DB_SUWEGER","CharacterSet"=>"UTF-8");

$conn_sr = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn_sr ) { //echo 
echo "Connection established. <br />"; }
else{ echo "Connection could not be established. <br />"; 
die( print_r( sqlsrv_errors(), true)); }


$id                 = $_SESSION["id_produk"];
$nama_produk        = $_REQUEST['nama_produk'];
$idukuran           = $_REQUEST["id_ukuran"];
$harga              = $_REQUEST['harga'];

unset($_SESSION['id_produk']);
          
        $sql = "INSERT INTO TB_PRODUK VALUES ('$id','$nama_produk','$harga','$idukuran', '', 0)";
        if(sqlsrv_query($conn_sr, $sql)){
            echo "<h3>data stored in a database successfully." 
                . " Please browse your localhost php my admin" 
                . " to view the updated data</h3>"; 
         echo "<p><a href='index.php' target='_blank'>Home</a></p>";
        } else{
            echo "ERROR: Hush! Sorry $sql. " 
                . print_r(sqlsrv_errors(), true);
        }
          
        // Close connection
        sqlsrv_close($conn_sr);