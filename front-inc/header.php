<?php

include "admin/db/DB.php";
// include "admin/inc/functions.php";


$db = new DB();

$site = $db->getSiteSettings();
if (isset($_GET['newsletter'])) {
    $newsletter_response = $db->newsletter($_GET['newsletter']);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?= $site->site_name ?? "Demo Site"; ?></title>
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet">
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <?= html_entity_decode($site->header_code, ENT_QUOTES) ?? ''; ?>
</head>

<body>
    <?php include 'nav.php' ?>