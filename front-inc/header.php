<?php

if (!defined('header')) {
    exit('You are not authrise to check this page');
}

define('db', true);
include "admin/db/DB.php";
// include "admin/inc/functions.php";


$db = new DB();

$site = $db->getSiteSettings();
if (isset($_GET['newsletter'])) {
    $newsletter_response = $db->newsletter($_GET['newsletter']);
}
$ad = $db->getAds();

$no_ads = '<div class="section-row text-center"><a href="#" style="display: inline-block;margin: auto;"><img class="img-responsive" src="./img/ad-2.jpg" alt=""></a></div>';

$below_header = (isset($ad[0]->below_header)) ? html_entity_decode($ad[0]->below_header, ENT_QUOTES) : $no_ads;
$below_content = (isset($ad[0]->below_content)) ? html_entity_decode($ad[0]->below_content, ENT_QUOTES) : $no_ads;
$sidebar = (isset($ad[0]->sidebar)) ? html_entity_decode($ad[0]->sidebar, ENT_QUOTES) : $no_ads;

//post settings
$post_setting = $db->getPostSettings();

$page = $_GET['page'] ?? 1;
$total_records = count($db->findData('posts'));
$record_per_page = $post_setting->no_of_posts;
$start_from = (($page - 1) * $record_per_page) + 8;
$total_pages = ceil($total_records / $record_per_page);



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
    <?php
    define('nav', true);
    include 'nav.php'

    ?>