<?php

  /**
    This is the StartBootstrap-Scrolling-Nav theme.

    This file contains the theme class of the StartBootstrap-Scrolling-Nav
    theme.

    @package urlaube\startbootstrap-scrolling-nav
    @version 0.2a0
    @author  Yahe <hello@yahe.sh>
    @since   0.1a0
  */

  // ===== DO NOT EDIT HERE =====

  // prevent script from getting called directly
  if (!defined("URLAUBE")) { die(""); }

  class StartBootstrapScrollingNav extends BaseHandler implements Plugin, Theme {

    // CONSTANTS

    const NAME = "name";

    const MANDATORY = null;
    const OPTIONAL  = [self::NAME => null];
    const REGEX     = "~^\/".
                      "(?P<name>[0-9A-Za-z\_\-\/]*)".
                      "$~";

    const REGEXCSS = "~^\/startbootstrap\-scrolling\-nav\.css$~";

    // ABSTRACT FUNCTIONS

    protected static function getResult($metadata, &$cachable) {
      $result = null;

      // only proceed when this is the active theme
      if (0 === strcasecmp(static::class, value(Main::class, THEMENAME))) {
        // this result may be cached
        $cachable = true;

        $name = value($metadata, static::NAME);

        $result = callcontent($name, true, false, null);
      }

      return $result;
    }

    protected static function prepareMetadata($metadata) {
      $metadata->set(static::NAME, trail(lead(value($metadata, static::NAME), US), US));

      return $metadata;
    }

    // overwrite the default behaviour
    public static function getUri($metadata) {
      $result = null;

      // prepare metadata for sanitization
      $metadata = preparecontent($metadata, static::OPTIONAL, static::MANDATORY);
      if ($metadata instanceof Content) {
        // sanitize metadata
        $metadata = preparecontent(static::prepareMetadata($metadata), static::OPTIONAL, static::MANDATORY);
        if ($metadata instanceof Content) {
          // get the base URI
          $result = value(Main::class, ROOTURI);

          // append the mandatory URI parts
          $result .= nolead(value($metadata, static::NAME), US);
        }
      }

      return $result;
    }

    // INTERFACE FUNCTIONS

    public static function getContentCss($metadata, &$pagecount) {
      return null;
    }

    public static function getUriCss($metadata) {
      return value(Main::class, ROOTURI)."startbootstrap-scrolling-nav.css";
    }

    public static function parseUriCss($uri) {
      $result = null;

      $metadata = preparecontent(parseuri($uri, static::REGEXCSS));
      if ($metadata instanceof Content) {
        $result = $metadata;
      }

      return $result;
    }

    // HELPER FUNCTIONS

    protected static function configureCss() {
      Themes::preset("dark_color",  "#666");
      Themes::preset("light_color", "#ccc");
    }

    protected static function configureTheme() {
      // individual theme configuration
      Themes::preset("copyright_html", null);

      // recommended theme configuration
      Themes::preset(AUTHOR,      static::getDefaultAuthor());
      Themes::preset(CANONICAL,   static::getDefaultCanonical());
      Themes::preset(CHARSET,     static::getDefaultCharset());
      Themes::preset(COPYRIGHT,   static::getDefaultCopyright());
      Themes::preset(DESCRIPTION, static::getDefaultDescription());
      Themes::preset(FAVICON,     null);
      Themes::preset(KEYWORDS,    static::getDefaultKeywords());
      Themes::preset(LANGUAGE,    static::getDefaultLanguage());
      Themes::preset(LOGO,        null);
      Themes::preset(MENU,        null);
      Themes::preset(PAGENAME,    static::getDefaultPagename());
      Themes::preset(SITENAME,    t("Deine Webseite", static::class));
      Themes::preset(SITESLOGAN,  t("Dein Slogan", static::class));
      Themes::preset(TIMEFORMAT,  "d.m.Y");
      Themes::preset(TITLE,       static::getDefaultTitle());
    }

    protected static function getDefaultAuthor() {
      $result = null;

      // try to retrieve the first author
      foreach (value(Main::class, CONTENT) as $content_item) {
        if ($content_item->isset(AUTHOR)) {
          $result = value($content_item, AUTHOR);
          break;
        }
      }

      return $result;
    }

    protected static function getDefaultCanonical() {
      $result = null;

      // do not set a canonical URI on error
      if (ErrorHandler::class !== Handlers::getActive()) {
        $result = value(Main::class, URI);
      }

      return $result;
    }

    protected static function getDefaultCharset() {
      return strtolower(value(Main::class, CHARSET));
    }

    protected static function getDefaultCopyright() {
      return "Copyright &copy;".SP.value(Themes::class, SITENAME).SP.date("Y");
    }

    protected static function getDefaultDescription() {
      $result = null;

      // get the first entry of the content entries
      if (0 < count(value(Main::class, CONTENT))) {
        if (value(Main::class, CONTENT)[0]->isset(CONTENT)) {
          // remove all HTML tags and replace line breaks with spaces
          $result = substr(strtr(strip_tags(value(value(Main::class, CONTENT)[0], CONTENT)),
                                 ["\r\n" => SP, "\n" => SP, "\r" => SP]),
                           0, 300);
        }
      }

      return $result;
    }

    protected static function getDefaultKeywords() {
      $result = null;

      // retrieve all words from the titles
      $words = [];
      foreach (value(Main::class, CONTENT) as $content_item) {
        if ($content_item->isset(TITLE)) {
          $words = array_merge($words, explode(SP, value($content_item, TITLE)));
        }
      }

      // filter all words that do not fit the scheme
      for ($index = count($words)-1; $index >= 0; $index--) {
        if (1 !== preg_match("~^[0-9A-Za-z\-]+$~", $words[$index])) {
          unset($words[$index]);
        }
      }

      $result = implode(DP.SP, $words);

      return $result;
    }

    protected static function getDefaultLanguage() {
      $result = strtolower(value(Main::class, LANGUAGE));

      // only take the first part if the language is of the form "ab_xy"
      if (1 === preg_match("~^([a-z]+)\_[a-z]+$~", $result, $matches)) {
        if (2 === count($matches)) {
          $result = $matches[1];
        }
      }

      return $result;
    }

    protected static function getDefaultPagename() {
      $result = null;

      // convert the METADATA to a pagename
      $metadata = value(Main::class, METADATA);
      if ($metadata instanceof Content) {
        switch (Handlers::getActive()) {
          case ArchiveHandler::class:
            if ((null !== value($metadata, ArchiveHandler::DAY)) ||
                (null !== value($metadata, ArchiveHandler::MONTH)) ||
                (null !== value($metadata, ArchiveHandler::YEAR))) {
              $result = t("Archiv", StartBootstrapBlogHome::class).COL.SP;

              $parts = [];
              if (null !== value($metadata, ArchiveHandler::DAY)) {
                $parts[] .= t("Tag", StartBootstrapBlogHome::class).SP.value($metadata, ArchiveHandler::DAY);
              }
              if (null !== value($metadata, ArchiveHandler::MONTH)) {
                $parts[] .= t("Monat", StartBootstrapBlogHome::class).SP.value($metadata, ArchiveHandler::MONTH);
              }
              if (null !== value($metadata, ArchiveHandler::YEAR)) {
                $parts[] .= t("Jahr", StartBootstrapBlogHome::class).SP.value($metadata, ArchiveHandler::YEAR);
              }

              $result .= implode(DP.SP, $parts);
            }
            break;

          case AuthorHandler::class:
            $result = t("Autor", StartBootstrapBlogHome::class).COL.SP.value($metadata, AUTHOR);
            break;

          case CategoryHandler::class:
            $result = t("Kategorie", StartBootstrapBlogHome::class).COL.SP.value($metadata, CATEGORY);
            break;

          case SearchHandler::class:
            $result = t("Suche", StartBootstrapBlogHome::class).COL.SP.strtr(value($metadata, SearchHandler::SEARCH), DOT, SP);
            break;
        }
      }

      return $result;
    }

    protected static function getDefaultTitle() {
      $result = value(Themes::class, SITENAME).SP."-".SP.value(Themes::class, SITESLOGAN);

      if (null !== value(Themes::class, PAGENAME)) {
        $result = value(Themes::class, PAGENAME).SP."|".SP.$result;
      } else {
        // handle errors and pages
        if ((ErrorHandler::class === Handlers::getActive()) ||
            (PageHandler::class === Handlers::getActive())) {
          // get the first entry of the content entries
          if (0 < count(value(Main::class, CONTENT))) {
            if (value(Main::class, CONTENT)[0]->isset(TITLE)) {
              $result = value(value(Main::class, CONTENT)[0], TITLE).SP."|".SP.$result;
            }
          }
        }
      }

      return $result;
    }

    // SOURCECODE HELPER FUNCTION

    public static function cleanString($string) {
      return preg_replace('@[^0-9a-z]@', '', strtolower($string));
    }

    // RUNTIME FUNCTIONS

    public static function css() {
     $result = false;

      // only proceed when this is the active theme
      if (0 === strcasecmp(static::class, value(Main::class, THEMENAME))) {
        $metadata = static::parseUriCss(relativeuri());
        if (null !== $metadata) {
          // check if the URI is correct
          $fixed = static::getUriCss($metadata);
          if (0 !== strcmp(value(Main::class, URI), $fixed)) {
            relocate($fixed.querystring(), false, true);
          } else {
            // preset handler configuration
            static::configureCss();

            // generate the CSS file output
            require_once(__DIR__.DS."startbootstrap-scrolling-nav.css.php");
          }

          // we handled this page
          $result = true;
        }
      }

      return $result;
    }

    public static function plugin($argument) {
      $result = $argument;

      // only proceed when this is the active theme
      if (0 === strcasecmp(static::class, value(Main::class, THEMENAME))) {
        $result = preparecontent($result, null, [Plugins::ENTITY]);
        if (null !== $result) {
          // make sure that we only handle arrays
          if ($result instanceof Content) {
            $result = [$result];
          }

          $unsupported = [ArchiveHandler::class,
                          AuthorHandler::class,
                          CategoryHandler::class,
                          FeedHandler::class,
                          PageHandler::class,
                          SearchHandler::class,
                          SitemapXmlHandler::class];

          // iterate through the handlers and unset unsupported ones
          foreach ($result as $key => $value) {
            if (in_array(value($value, Plugins::ENTITY), $unsupported)) {
              unset($result[$key]);
            }
          }
        }
      }

      return $result;
    }

    public static function theme() {
      $result = false;

      // we do not handle empty content
      $content = preparecontent(value(Main::class, CONTENT));
      if (null !== $content) {
        // make sure that we only handle arrays
        if ($content instanceof Content) {
          Main::set(CONTENT, [$content]);
        }

        // preset theme configuration
        static::configureTheme();

        // generate the head output
        Plugins::run(BEFORE_HEAD);
        require_once(__DIR__.DS."head.php");
        Plugins::run(AFTER_HEAD);

        // generate the body output
        Plugins::run(BEFORE_BODY);
        require_once(__DIR__.DS."body.php");
        Plugins::run(AFTER_BODY);

        // generate the footer output
        Plugins::run(BEFORE_FOOTER);
        require_once(__DIR__.DS."footer.php");
        Plugins::run(AFTER_FOOTER);

        // we handled this page
        $result = true;
      }

      return $result;
    }

  }

  // register handlers
  Handlers::register(StartBootstrapScrollingNav::class, "css", StartBootstrapScrollingNav::REGEXCSS, [GET, POST], ADDSLASH);
  Handlers::register(StartBootstrapScrollingNav::class, "run", StartBootstrapScrollingNav::REGEX,    [GET, POST], USER);

  // register plugin
  Plugins::register(StartBootstrapScrollingNav::class, "plugin", FILTER_HANDLERS);

  // register theme
  Themes::register(StartBootstrapScrollingNav::class, "theme", StartBootstrapScrollingNav::class);

  // register translation
  Translate::register(__DIR__.DS."lang".DS, StartBootstrapScrollingNav::class);
