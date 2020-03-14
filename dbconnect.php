<?php
require __DIR__ .'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('DB_SERVER','localhost');
define('DB_USERNAME', getenv('DB_USERNAME'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));
define('DB_NAME', getenv('DB_NAME'));

//define('DB_SERVER','localhost');
//define('DB_USERNAME','root');
//define('DB_PASSWORD','');
//define('DB_NAME', 'aarogya');

$db=mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($db === false){
    die("ERROR: Could not connect.". mysqli_connect_error());
}

?>