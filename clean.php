<?php

include_once("config.php");
$con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);

$sql = "UPDATE " . DB_SITEMANAGER_NAME . ".sm_prodotti SET
        data_acquisto = '2014-06-12',
        ref_mail = 'viviana.boni@hotmail.it',
        ftp_host = 'ftp.stefanomartellotti.it',
        ftp_username = '5398111@aruba.it',
        ftp_pwd = '4gb14t5zn5',
        db = 'Sql764240_1',
        dbusername = 'Sql764240',
        dbpwd = '3j4540js67',
        hostdb = '62.149.150.216',
        domain = 'it',
        domainName = 'stefanomartellotti',
        status = '4',
        upd = '" . date("Y-m-d H:i:s") . "'
    WHERE sm_prodotti.nome ='';";
$result = mysql_query($sql, $con);

if (!$result) {
    echo "Database query failed: " . mysql_error(). '<br />';
} else {
    echo "update sitemanager entry of site: " . $site1. '<br />';
}

$sql = "UPDATE " . DB_SITEMANAGER_NAME . ".sm_prodotti SET
        data_acquisto = '2014-06-26',
        ref_mail = 'viviana.boni@hotmail.it',
        ftp_host = 'ftp.tgbcassociati.',
        ftp_username = '5463301@aruba.it',
        ftp_pwd = 'l6ot100d15',
        db = 'Sql767525_1',
        dbusername = 'Sql767525',
        dbpwd = 'tw07uz3m45',
        hostdb = '62.149.150.209',
        domain = 'it',
        domainName = 'tgbcassociati',
        status = '4',
        upd = '" . date("Y-m-d H:i:s") . "'
    WHERE sm_prodotti.id =" . $id . ";";
$result = mysql_query($sql, $con);

if (!$result) {
    echo "Database query failed: " . mysql_error(). '<br />';
} else {
    echo "update sitemanager entry of site: " . $site2;
}

mysql_close($con);
?>
