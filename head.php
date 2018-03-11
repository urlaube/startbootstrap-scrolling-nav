<?php

  // prevent script from getting called directly
  if (!defined("URLAUBE")) { die(""); }

?>
<!DOCTYPE html>
<html lang="<?= html(Themes::get(LANGUAGE)) ?>">
  <head>
    <meta charset="<?= html(Themes::get(CHARSET)) ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<?php
  if (Themes::isset(AUTHOR)) {
?>
    <meta name="author" content="<?= html(Themes::get(AUTHOR)) ?>">
<?php
  }
?>
    <meta name="description" content="<?= html(Themes::get(DESCRIPTION)) ?>">
    <meta name="keywords" content="<?= html(Themes::get(KEYWORDS)) ?>">

    <link rel="canonical" href="<?= html(Themes::get(CANONICAL)) ?>">
<?php
  if (Themes::isset(FAVICON)) {
?>
    <link rel="shortcut icon" type="image/x-icon" href="<?= html(Themes::get(FAVICON)) ?>">
<?php
  }
?>

    <title><?= html(Themes::get(TITLE)) ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= html(path2uri(__DIR__."/css/bootstrap.min.css")) ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= html(Main::ROOTURI()."startbootstrap-scrolling-nav.css") ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="<?= html(path2uri(__DIR__."/js/html5shiv.js")) ?>"></script>
      <script src="<?= html(path2uri(__DIR__."/js/respond.min.js")) ?>"></script>
    <![endif]-->
  </head>

  <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header page-scroll">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand page-scroll" href="#page-top"><?= StartBootstrapScrollingNav::getLogo() ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
            <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
            <li class="hidden">
              <a class="page-scroll" href="#page-top"></a>
            </li>
<?php
  // iterate through the content entries to generate the link bar
  foreach (Main::CONTENT() as $content_key => $content_item) {
    $title = StartBootstrapScrollingNav::get($content_key, TITLE);
    $id    = StartBootstrapScrollingNav::cleanString($title);
?>
            <li>
              <a class="page-scroll" href="#<?= html($id) ?>"><?= html($title) ?></a>
            </li>
<?php
  }
?>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container -->
    </nav>
