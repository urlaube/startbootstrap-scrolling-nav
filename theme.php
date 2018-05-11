<?php

  /**
    This is the StartBootstrap-Scrolling-Nav theme.

    This file contains the theme class of the StartBootstrap-Scrolling-Nav theme.

    @package urlaube\startbootstrap-scrolling-nav
    @version 0.1a2
    @author  Yahe <hello@yahe.sh>
    @since   0.1a0
  */

  // ===== DO NOT EDIT HERE =====

  // prevent script from getting called directly
  if (!defined("URLAUBE")) { die(""); }

  if (!class_exists("StartBootstrapScrollingNav")) {
    class StartBootstrapScrollingNav {

      // HELPER FUNCTIONS

      protected static function configureCSS() {
        Themes::preset("dark_color",  "#666");
        Themes::preset("light_color", "#ccc");
      }

      protected static function configureHandler() {
        Handlers::preset(FILE_EXT, ".md");
      }

      protected static function configureTheme() {
        // static
        Themes::preset(HEADING, null);
        Themes::preset(LOGO,    null);
        Themes::preset(NAME,    "Your Website");

        // individual static
	Themes::preset("COPYRIGHT_HTML", null);

        // derived
        Themes::preset(CANONICAL,   Main::URI());
        Themes::preset(CHARSET,     strtolower(Main::CHARSET()));
        Themes::preset(COPYRIGHT,   "Copyright &copy; ".Themes::get(NAME)." ".date("Y"));
        Themes::preset(DESCRIPTION, static::getDescription());
        Themes::preset(KEYWORDS,    static::getKeywords());
        Themes::preset(LANGUAGE,    static::getLanguage());
        Themes::preset(TITLE,       static::getTitle());
      }

      protected static function doBody() {
        // call the before-body plugins
        Plugins::run(BEFORE_BODY);

        require_once(__DIR__.DS."body.php");

        // call the after-body plugins
        Plugins::run(AFTER_BODY);
      }

      protected static function doCSS() {
        require_once(__DIR__.DS."startbootstrap-scrolling-nav.css.php");
      }

      protected static function doFooter() {
        // call the before-footer plugins
        Plugins::run(BEFORE_FOOTER);

        require_once(__DIR__.DS."footer.php");

        // call the after-footer plugins
        Plugins::run(AFTER_FOOTER);
      }

      protected static function doHead() {
        // call the before-head plugins
        Plugins::run(BEFORE_HEAD);

        require_once(__DIR__.DS."head.php");

        // call the after-head plugins
        Plugins::run(AFTER_HEAD);
      }

      protected static function getDescription() {
        $result = null;

        // get the first entry of the content entries
        if (0 < count(Main::CONTENT())) {
          if (Main::CONTENT()[0]->isset(CONTENT)) {
            // remove all HTML tags and replace line breaks with spaces
            $result = substr(strtr(strip_tags(Main::CONTENT()[0]->get(CONTENT)),
                                   array("\r\n" => " ", "\n" => " ", "\r" => " ")),
                             0, 300);
          }
        }

        return $result;
      }

      protected static function getKeywords() {
        $result = null;

        // retrieve all words from the titles
        $words = array();
        foreach (Main::CONTENT() as $content_item) {
          if ($content_item->isset(TITLE)) {
            $words = array_merge($words, explode(" ", $content_item->get(TITLE)));
          }
        }

        // filter all words that do not fit the scheme
        for ($index = count($words)-1; $index >= 0; $index--) {
          if (1 !== preg_match("@^[0-9A-Za-z\-]+$@", $words[$index])) {
            unset($words[$index]);
          }
        }

        $result = implode(", ", $words);

        return $result;
      }

      protected static function getLanguage() {
        $result = Translations::LANGUAGE();

        if (1 === preg_match("@^([A-Za-z]+)\_[A-Za-z]+$@", $result, $matches)) {
          if (2 === count($matches)) {
            $result = $matches[1];
          }
        }
        $result = strtolower($result);

        return $result;
      }

      public static function getLogo() {
        // retrieve site logo title
        $result = html(Themes::get(NAME), false);

        // use an image as logo
        if (null !== Themes::get(LOGO)) {
          $result = "<img src=\"".Themes::get(LOGO)."\" alt=\"".$result."\">";
        }

        return $result;
      }

      protected static function getTitle() {
        $result = Themes::get(NAME);

        if (!empty(Themes::get(HEADING))) {
          $result = Themes::get(HEADING)." | ".$result;
        }

        return $result;
      }

      // SOURCECODE HELPER FUNCTION

      public static function cleanString($string) {
        return preg_replace('@[^0-9a-z]@', '', strtolower($string));
      }

      public static function get($key, $name) {
        $result = null;

        if (array_key_exists($key, Main::CONTENT())) {
          if (Main::CONTENT()[$key]->isset($name)) {
            $result = Main::CONTENT()[$key]->get($name);
          }
        }

        return $result;
      }

      public static function isset($key, $name) {
        $result = false;

        if (array_key_exists($key, Main::CONTENT())) {
          $result = Main::CONTENT()[$key]->isset($name);
        }

        return $result;
      }

      // RUNTIME FUNCTIONS

      public static function css() {
        static::configureCSS();
        static::doCSS();

        return true;
      }

      public static function handler() {
        // force handling of redirects
        $result = RedirectsHandler::handle();

        // force handling of static files
        if (!$result) {
          $result = StaticsHandler::handle();
        }

        // handle theme URIs
        if (!$result) {
          // preset handler configuration
          static::configureHandler();

          // deactivate other content handlers
          Handlers::set(DEACTIVATE_ARCHIVES,   true);
          Handlers::set(DEACTIVATE_CATEGORIES, true);
          Handlers::set(DEACTIVATE_FEEDS,      true);
          Handlers::set(DEACTIVATE_HOME,       true);
          Handlers::set(DEACTIVATE_PAGES,      true);
          Handlers::set(DEACTIVATE_REDIRECTS,  true);
          Handlers::set(DEACTIVATE_STATICS,    true);

          // get folder path
          $path = trail(USER_CONTENT_PATH.
                        implode(DS, array_filter(explode(US, Main::RELATIVEURI()))),
                        DS);

          // load content from the folder path
          $content = Files::loadContentDir($path,
                                           USER_CONTENT_PATH,
                                           Handlers::get(FILE_EXT));

          // call theme if we found content to display
          $result = (null !== $content);
          if ($result) {
            // set the content to be processed by the theme
            Main::CONTENT($content);

            // transfer the handling to the Themes class
            Themes::run();
          }
        }

        return $result;
      }

      public static function theme() {
        $result = false;

        // we don't handle empty content
        if (null !== Main::CONTENT()) {
          // make sure that we only handle arrays
          if (Main::CONTENT() instanceof Content) {
            Main::CONTENT(array(Main::CONTENT()));
          }

          // preset theme configuration
          static::configureTheme();

          // generate the output
          static::doHead();
          static::doBody();
          static::doFooter();

          $result = true;
        }

        return $result;
      }

    }

    // register handlers
    Handlers::register("StartBootstrapScrollingNav", "css",     "@^\/startbootstrap\-scrolling\-nav\.css$@");
    Handlers::register("StartBootstrapScrollingNav", "handler", "@^([0-9A-Za-z\_\-\/]*)$@");

    // register theme
    Themes::register("StartBootstrapScrollingNav", "theme", "startbootstrap-scrolling-nav");
  }

