# StartBootstrap-Scrolling-Nav theme
The StartBootstrap-Scrolling-Nav theme is a single-page theme for [Urlaub.be](https://github.com/urlaube/base) that is based on the [Scrolling-Nav theme](https://github.com/BlackrockDigital/startbootstrap-scrolling-nav/tree/v3.3.7) created by [Start Bootstrap](https://startbootstrap.com/).

## Installation
Place the folder containing the theme into your themes directory located at `./user/themes/`.
Finally, add the following line to your configuration file located at `./user/config/config.php` to select the theme:
```
Config::THEMENAME("startbootstrap-scrolling-nav");
```

## Configuration
To configure the theme you can change the corresponding settings in your configuration file located at `./user/config/config.php`.

### Colors
You can set the following values to change the color scheme of the theme:
```
Config::THEME("dark_color",  "#666");
Config::THEME("light_color", "#ccc");
```

### Logo image file
You can set the following value to choose an image file as a logo:
```
Config::THEME(LOGO, null);
```

### Copyright text
You can set the following values to change the copyright text in the footer area. You can either choose auto-escaped text by setting `COPYRIGHT` or you can choose HTML by setting `"COPYRIGHT_HTML"`:
```
Config::THEME(COPYRIGHT, "Copyright &copy; ".Main::SITENAME()." ".date("Y"));
```
```
Config::THEME("COPYRIGHT_HTML", null);
```

### Canonical URL
You can overwrite the auto-generated canonical URL:
```
Config::THEME(CANONICAL, Main::URI());
```

### Charset
You can overwrite the auto-generated charset:
```
Config::THEME(CHARSET, strtolower(Main::CHARSET()));
```

### Description
You can overwrite the auto-generated description:
```
Config::THEME(DESCRIPTION, static::getDefaultDescription());
```

### Keywords
You can overwrite the auto-generated keywords:
```
Config::THEME(KEYWORDS, static::getDefaultKeywords());
```

### Language
You can overwrite the auto-generated language:
```
Config::THEME(LANGUAGE, static::getDefaultLanguage());
```

### Title
You can overwrite the auto-generated title:
```
Config::THEME(TITLE, static::getDefaultTitle());
```

