<?php

  /**
    This is the StartBootstrap-Scrolling-Nav theme.

    This file contains the theme class of the StartBootstrap-Scrolling-Nav theme.

    @package urlaube\startbootstrap-scrolling-nav
    @version 0.1a8
    @author  Yahe <hello@yahe.sh>
    @since   0.1a0
  */

  // ===== DO NOT EDIT HERE =====

  // prevent script from getting called directly
  if (!defined("URLAUBE")) { die(""); }

  if (!class_exists("StartBootstrapScrollingNav")) {
    class StartBootstrapScrollingNav extends Base implements Handler, Plugin, Theme {

      // INTERFACE FUNCTIONS

      public static function getContent($info) {
        $result = null;

        if (is_array($info)) {
          $name = null;
          if (isset($info[NAME]) && is_string($info[NAME])) {
            $name = $info[NAME];
          }

          // get folder path
          $path = trail(USER_CONTENT_PATH.
                        implode(DS, array_filter(explode(US, $name))),
                        DS);

          // load content from the folder path
          $result = File::loadContentDir($path, false,
                                         function ($content) {
                                           $result = null;

                                           // check that $content is not hidden
                                           if (!ishidden($content)) {
                                             $result = $content;
                                           }

                                           return $result;
                                         },
                                         false);

          // set pagination information
          Main::PAGEMAX(1);
          Main::PAGEMIN(1);
          Main::PAGENUMBER(1);
        }

        return $result;
      }

      public static function getUri($info) {
        $result = Main::ROOTURI();

        if (is_array($info)) {
          if (isset($info[NAME]) && is_string($info[NAME])) {
            $result .= $info[NAME];
          }
        }

        return $result;
      }

      public static function parseUri($uri) {
        $result = null;

        if (1 === preg_match("@^\/([0-9A-Za-z\_\-\/]*)$@",
                             $uri, $matches)) {
          $result = array();

          // get the requested content name
          if (2 <= count($matches)) {
            $result[NAME] = $matches[1];
          }
        }

        return $result;
      }

      // HELPER FUNCTIONS

      protected static function configureCSS() {
        Themes::preset("dark_color",  "#666");
        Themes::preset("light_color", "#ccc");
      }

      protected static function configureTheme() {
        // static
        Themes::preset(FAVICON,    null);
        Themes::preset(LOGO, null);

        // individual static
        Themes::preset("COPYRIGHT_HTML", null);

        // derived
        Themes::preset(AUTHOR,      static::getDefaultAuthor());
        Themes::preset(CANONICAL,   static::getDefaultCanonical());
        Themes::preset(CHARSET,     static::getDefaultCharset());
        Themes::preset(COPYRIGHT,   static::getDefaultCopyright());
        Themes::preset(DESCRIPTION, static::getDefaultDescription());
        Themes::preset(KEYWORDS,    static::getDefaultKeywords());
        Themes::preset(LANGUAGE,    static::getDefaultLanguage());
        Themes::preset(TITLE,       static::getDefaultTitle());
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

      protected static function getDefaultAuthor() {
        $result = null;

        // try to retrieve the first author
        foreach (Main::CONTENT() as $content_item) {
          if ($content_item->isset(AUTHOR)) {
            $result = value($content_item, AUTHOR);
            break;
          }
        }

        return $result;
      }

      protected static function getDefaultCanonical() {
        return Main::URI();
      }

      protected static function getDefaultCharset() {
        return strtolower(Main::CHARSET());
      }

      protected static function getDefaultCopyright() {
        return "Copyright &copy;".SP.Main::SITENAME().SP.date("Y");
      }

      protected static function getDefaultDescription() {
        $result = null;

        // get the first entry of the content entries
        if (0 < count(Main::CONTENT())) {
          if (Main::CONTENT()[0]->isset(CONTENT)) {
            // remove all HTML tags and replace line breaks with spaces
            $result = substr(strtr(strip_tags(value(Main::CONTENT()[0], CONTENT)),
                                   array("\r\n" => SP, "\n" => SP, "\r" => SP)),
                             0, 300);
          }
        }

        return $result;
      }

      protected static function getDefaultKeywords() {
        $result = null;

        // retrieve all words from the titles
        $words = array();
        foreach (Main::CONTENT() as $content_item) {
          if ($content_item->isset(TITLE)) {
            $words = array_merge($words, explode(SP, value($content_item, TITLE)));
          }
        }

        // filter all words that do not fit the scheme
        for ($index = count($words)-1; $index >= 0; $index--) {
          if (1 !== preg_match("@^[0-9A-Za-z\-]+$@", $words[$index])) {
            unset($words[$index]);
          }
        }

        $result = implode(",".SP, $words);

        return $result;
      }

      protected static function getDefaultLanguage() {
        $result = strtolower(Translate::LANGUAGE());

        // only take the first part if the language is of the form "ab_xy"
        if (1 === preg_match("@^([a-z]+)\_[a-z]+$@", $result, $matches)) {
          if (2 === count($matches)) {
            $result = $matches[1];
          }
        }

        return $result;
      }

      protected static function getDefaultTitle() {
        return Main::SITESLOGAN().SP."|".SP.Main::SITENAME();
      }

      // SOURCECODE HELPER FUNCTION

      public static function cleanString($string) {
        return preg_replace('@[^0-9a-z]@', '', strtolower($string));
      }

      // RUNTIME FUNCTIONS

      public static function css() {
        // preset CSS file configuration
        static::configureCSS();

        // generate the CSS file output
        static::doCSS();

        return true;
      }

      public static function handler() {
        $result = false;

        $info = static::parseUri(Main::RELATIVEURI());
        if (null !== $info) {
          $content = static::getContent($info);
          if (null !== $content) {
            // set the content to be processed by the theme
            Main::CONTENT($content);
            Main::PAGEINFO($info);

            // transfer the handling to the Themes class 
            Themes::run();

            // we handled this page
            $result = true;
          }
        }

        return $result;
      }

      public static function plugin($argument) {
        // disable unsupported handlers
        Handlers::set(DEACTIVATE_ARCHIVE ,    true);
        Handlers::set(DEACTIVATE_AUTHOR,      true);
        Handlers::set(DEACTIVATE_CATEGORY,    true);
        Handlers::set(DEACTIVATE_FEED,        true);
        Handlers::set(DEACTIVATE_HOME,        true);
        Handlers::set(DEACTIVATE_PAGE,        true);
        Handlers::set(DEACTIVATE_SEARCH,      true);
        Handlers::set(DEACTIVATE_SITEMAP_XML, true);

        return null;
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
    Handlers::register("StartBootstrapScrollingNav", "css",
                       "@^\/startbootstrap\-scrolling\-nav\.css$@",
                       [GET], BEFORE_ADDSLASH);

    Handlers::register("StartBootstrapScrollingNav", "handler",
                       "@^\/([0-9A-Za-z\_\-\/]*)$@",
                       [GET], USER);

    // register plugin
    Plugins::register("StartBootstrapScrollingNav", "plugin", BEFORE_HANDLER);

    // register theme
    Themes::register("StartBootstrapScrollingNav", "theme", "startbootstrap-scrolling-nav");
  }

