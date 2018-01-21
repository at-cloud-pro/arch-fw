<!DOCTYPE html>
<?php
    include_once 'credits.php';
    $pageDetails = controller_settings::getPageDetails();
 ?>
<html lang="<?php echo $pageDetails['pageLanguage']; ?>">
<head>
    <meta charset="<?php echo $pageDetails['pageEncoding']; ?>">
    <title><?php echo $pageDetails['pageTitle']; ?></title>
    <link rel="icon"
      type="image/png"
      href="http://www.via.placeholder.com/32x32">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="<?php echo $pageDetails['pageDescription']; ?>">
      <meta name="keywords" content="<?php echo $pageDetails['pageKeywords']; ?>">
      <meta name="author" content="<?php echo $pageDetails['pageAuthor']; ?>">
    <?php include_once 'css.php'; ?>
</head>
<body>
