<?php

  // prevent script from getting called directly
  if (!defined("URLAUBE")) { die(""); }

?>
    <!-- Footer Section -->
    <section id="footer" class="footer-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12"><?= html(Themes::get(COPYRIGHT)) ?></div>
        </div>
      </div>
    </section>

    <!-- jQuery -->
    <script src="<?= html(path2uri(__DIR__."/js/jquery.js")) ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= html(path2uri(__DIR__."/js/bootstrap.min.js")) ?>"></script>

    <!-- Scrolling Nav JavaScript -->
    <script src="<?= html(path2uri(__DIR__."/js/jquery.easing.min.js")) ?>"></script>
    <script src="<?= html(path2uri(__DIR__."/js/scrolling-nav.js")) ?>"></script>
  </body>
</html>
