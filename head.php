<?php

  // prevent script from getting called directly
  if (!defined("URLAUBE")) { die(""); }

?>
<!DOCTYPE html>
<html lang="<?= html(value(Themes::class, LANGUAGE)) ?>">
  <head>
    <meta charset="<?= html(value(Themes::class, CHARSET)) ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<?php
  if (null !== value(Themes::class, AUTHOR)) {
?>
    <meta name="author" content="<?= html(value(Themes::class, AUTHOR)) ?>">
<?php
  }
?>
    <meta name="description" content="<?= html(value(Themes::class, DESCRIPTION)) ?>">
    <meta name="keywords" content="<?= html(value(Themes::class, KEYWORDS)) ?>">

<?php
  if (null !== value(Themes::class, CANONICAL)) {
?>
    <link rel="canonical" href="<?= html(value(Themes::class, CANONICAL)) ?>">
<?php
  }
  if (null !== value(Themes::class, FAVICON)) {
?>
    <link rel="icon" type="<?= html(mime_content_type(uri2path(value(Themes::class, FAVICON)))) ?>" href="<?= html(value(Themes::class, FAVICON)) ?>">
<?php
  }
?>

    <title><?= html(value(Themes::class, TITLE)) ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= html(path2uri(__DIR__."/css/bootstrap.min.css")) ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= html(static::getUriCss(new Content())) ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="<?= html(path2uri(__DIR__."/js/html5shiv.min.js")) ?>"></script>
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
<?php
  $logourl = value(Themes::class, "logo_url");
  if (null !== $logourl) {
    // try to clean up the URI if possible
    $uri = parse_url($logourl);
    if (is_array($uri)) {
      // check if this is only a path and a fragment
      if ((2 === count($uri)) &&
          array_key_exists("path", $uri) &&
          array_key_exists("fragment", $uri)) {
        // check if this is the current URI
        if (0 === strcmp($uri["path"], value(Main::class, URI))) {
          $logourl = "#".$uri["fragment"];
        }
      }
    }

    // check if this is the current page
    $uri = parse_url($logourl);
    if (is_array($uri)) {
      // check if this is only a path
      if ((1 === count($uri)) &&
          array_key_exists("path", $uri)) {
        if (0 === strcmp($uri["path"], value(Main::class, URI))) {
          // just use the default
          $logourl = null;
        }
      }
    }
  }

  if (null === $logourl) {
    $logourl = "#page-top";
  }
?>
          <a class="navbar-brand page-scroll" href="<?= html($logourl) ?>">
<?php
  if (null !== value(Themes::class, LOGO)) {
?>
            <img src="<?= html(value(Themes::class, LOGO)) ?>" alt="<?= html(value(Themes::class, SITENAME)) ?>">
<?php
  } else {
?>
            <?= html(value(Themes::class, SITENAME).NL) ?>
<?php
  }
?>
          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
            <!-- Hidden li included to remove active class from first menu link when scrolled up past first section section -->
            <li class="hidden">
              <a class="page-scroll" href="#page-top"></a>
            </li>
<?php
  $menu = value(Themes::class, MENU);

  // generate the menu from the content
  if (null === $menu) {
    // generate the menu from the content
    $counter = 0;
    foreach (value(Main::class, CONTENT) as $content_item) {
      // increment section counter
      $counter++;

      $title = value($content_item, TITLE);
      $id    = StartBootstrapScrollingNav::cleanString(value($content_item, "section"));
      if (null === $id) {
        $id = StartBootstrapScrollingNav::cleanString($title);
      }
      if (null === $id) {
        $id = "section-$counter";
      }

      // initialize the menu array
      if (null === $menu) {
        $menu = [];
      }

      // set the menu item
      $menu[] = [TITLE => $title, URI => "#$id"];
    }
  }

  // iterate through the menu entries to generate the link bar
  if (is_array($menu)) {
    foreach ($menu as $menu_item) {
      if (is_array($menu_item)) {
        if (isset($menu_item[TITLE]) && isset($menu_item[URI])) {
          // try to clean up the URI if possible
          $uri = parse_url($menu_item[URI]);
          if (is_array($uri)) {
            // check if this is only a path and a fragment
            if ((2 === count($uri)) &&
                array_key_exists("path", $uri) &&
                array_key_exists("fragment", $uri)) {
              // check if this is the current URI
              if (0 === strcmp($uri["path"], value(Main::class, URI))) {
                $menu_item[URI] = "#".$uri["fragment"];
              }
            }
          }

          // check if this is the active menu item
          $aclass = "";
          $uri    = parse_url($menu_item[URI]);
          if (is_array($uri)) {
            // check if this is only a path
            if ((1 === count($uri)) &&
                array_key_exists("path", $uri)) {
              if (0 === strcmp($uri["path"], value(Main::class, URI))) {
                $aclass = " active-item";
              }
            }
          }

?>
            <li>
              <a class="page-scroll<?= $aclass ?>" href="<?= html($menu_item[URI]) ?>" title="<?= html($menu_item[TITLE]) ?>"><?= html($menu_item[TITLE]) ?></a>
            </li>
<?php
        }
      }
    }
  }
?>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container -->
    </nav>
