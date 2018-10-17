<?php

  // prevent script from getting called directly
  if (!defined("URLAUBE")) { die(""); }

?>
    <!-- Empty Section so that no menu entry is active when scrolling to the top -->
    <section id="empty" class="empty-section">
    </section>
<?php
  // iterate through the content entries
  $even = false;
  foreach (value(Main::class, CONTENT) as $content_item) {
    // chose alternating CSS class
    if ($even) {
      $class = "even-section";
    } else {
      $class = "uneven-section";
    }
    $even = (!$even);

    $content = value($content_item, CONTENT).NL;
    $title   = value($content_item, TITLE);
    $id      = StartBootstrapScrollingNav::cleanString($title);
?>
    <!-- <?= html($title); ?> Section -->
    <section id="<?= html($id) ?>" class="<?= html($class) ?>">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h1><?= html($title) ?></h1>
<?= $content ?>
          </div>
        </div>
      </div>
    </section>
<?php
  }
?>
