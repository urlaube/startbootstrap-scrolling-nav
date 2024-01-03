# StartBootstrap-Scrolling-Nav theme
The StartBootstrap-Scrolling-Nav theme is a single-page theme for [Urlaube](https://github.com/urlaube/urlaube) that is based on the [Scrolling-Nav theme](https://github.com/BlackrockDigital/startbootstrap-scrolling-nav/tree/v3.3.7) created by [Start Bootstrap](https://startbootstrap.com/).

You can create multiple pages by putting one or more content files in sub-folders.

## Installation
Place the folder containing the theme into your themes directory located at `./user/themes/`.

Finally, add the following line to your configuration file located at `./user/config/config.php` to select the theme:
```
Main::set(THEMENAME, StartbootstrapScrollingNav::class);
```

## Configuration
To configure the theme you can change the corresponding settings in your configuration file located at `./user/config/config.php`.

### Colors
You can set the following values to change the color scheme of the theme:
```
Themes::set("dark_color",  "#666");
Themes::set("light_color", "#ccc");
```

### Author name
You can overwrite the auto-generated author header:
```
Themes::set(AUTHOR, $static::getDefaultAuthor());
```

### Canonical URL
You can overwrite the auto-generated canonical URL header:
```
Themes::set(CANONICAL, static::getDefaultCanonical());
```

### Charset
You can overwrite the auto-generated charset header:
```
Themes::set(CHARSET, static::getDefaultCharset());
```

### Copyright text
You can set the following values to change the copyright text in the footer area. You can either choose auto-escaped text by setting `COPYRIGHT` or you can choose HTML by setting `"copyright_html"`:
```
Themes::set(COPYRIGHT, static::getDefaultCopyright());
```
```
Themes::set("copyright_html", null);
```

### Custom CSS
You can set the following value to add custom CSS to your theme:
```
Themes::set("custom_css", "");
```

### Description
You can overwrite the auto-generated description header:
```
Themes::set(DESCRIPTION, static::getDefaultDescription());
```

### Favicon URL
You can set the URL of the favicon:
```
Themes::set(FAVICON, null);
```

### Keywords
You can overwrite the auto-generated keywords header:
```
Themes::set(KEYWORDS, static::getDefaultKeywords());
```

### Language
You can overwrite the auto-generated language header:
```
Themes::set(LANGUAGE, static::getDefaultLanguage());
```

### Logo image file
You can set the URL of an image file that is used as a website logo:
```
Themes::set(LOGO, null);
```

### Menu
You can set the content of the site's menu:
```
Themes::set(MENU, null);
```

The menu content has to be set as an array containing associative arrays for each element:
```
Themes::set(MENU, [[TITLE => "Linktext",   URI => "https://example.com/"],
                   [TITLE => "Linktext 2", URI => "https://example.net/"]]);
```

If this value is not set then the menu will be auto-generated from the content.

### Pagename
You can overwrite the auto-generated page name that is used as an H1 headline:
```
Themes::set(PAGENAME, static::getDefaultPagename());
```

### Sitename
You can overwrite the preset site name that is used a text logo and in the auto-generated title header:
```
Themes::set(SITENAME, t("Deine Webseite", static::class));
```

### Siteslogan
You can overwrite the preset site slogan that is used in the auto-generated title header:
```
Themes::set(SITESLOGAN, t("Dein Slogan", static::class));
```

### Title
You can overwrite the auto-generated title header:
```
Themes::set(TITLE, static::getDefaultTitle());
```

## Usage

The theme creates a single-page layout from the content files in the `./user/content/` folder and auto-generates the menu entries from the titles of the different content files. Each session gets its own #fragment URL from the cleaned-up `Title:` value in the content file. You can overwrite the auto-generated #fragment URL by setting the `Section:` value in the content file.

