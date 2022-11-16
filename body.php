<?php

  // prevent script from getting called directly
  if (!defined("URLAUBE")) { die(""); }

?>
    <!-- Empty Section so that no menu entry is active when scrolling to the top -->
    <section id="empty" class="empty-section">
    </section>
<?php
  // iterate through the content entries
  $counter = 0;
  $even    = false;
  foreach (value(Main::class, CONTENT) as $content_item) {
    // increment section counter
    $counter++;

    // choose alternating CSS class
    if ($even) {
      $class = "even-section";
    } else {
      $class = "uneven-section";
    }
    $even = (!$even);

    $content = value($content_item, CONTENT).NL;
    $title   = value($content_item, TITLE);
    $id      = StartBootstrapScrollingNav::cleanString($title);
    if (null === $id) {
      $id = "section-$counter";
    }
?>
    <!-- <?= html($title) ?> Section -->
    <section id="<?= html($id) ?>" class="<?= html($class) ?>">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
<?php
    if (null !== $title) {
?>
            <h1><?= html($title) ?></h1>
<?php
    }
?>
<?= $content ?>
          </div>
        </div>
      </div>
    </section>
<?php
  }
?>
