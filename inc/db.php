<?

require(__DIR__ . "/../classes/database.php");



$DB_HOST = "localhost";
$DB_NAME = "db_ct07";
$DB_USER = "ad_db_ct07";
$DB_PASS = "123dbct07123";



$db = new Database($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS);
return $db->getConn();
