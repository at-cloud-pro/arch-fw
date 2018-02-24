<!DOCTYPE html>
<?php
require_once 'credits.html';

$AppController = new Controller_Application();
$pageDetails = $AppController->getPageDetails();

if (isset($_SESSION['pageTitle']) AND ($_SESSION['pageTitle']!= null)) {
    $pageDetails['pageTitle'] = $_SESSION['pageTitle'];
}

?>
<html lang="<?php echo $pageDetails['pageLanguage']; ?>">
<head>
    <meta charset="<?php echo $pageDetails['pageEncoding']; ?>">
    <title><?php echo $pageDetails['pageTitle']; ?></title>
    <link rel="icon"
      type="image/png"
      href="https://www.via.placeholder.com/32x32">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="<?php echo $pageDetails['pageDescription']; ?>">
      <meta name="keywords" content="<?php echo $pageDetails['pageKeywords']; ?>">
      <meta name="author" content="<?php echo $pageDetails['pageAuthor']; ?>">
<?php require_once 'css.php'; ?>
</head>
<body>
