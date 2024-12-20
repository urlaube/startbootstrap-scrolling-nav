# Changelog

## 0.7a4 (19.12.2024)
### Feature
* improve default title tag generation

## 0.7a3 (28.04.2024)
### Bugfixes
* prevent PRE overflows

## 0.7a2 (08.03.2024)
### Feature
* stick the footer to the bottom of the viewport

## 0.7a1 (29.02.2024)
### Features
* improve FAVICON support
* update dependencies

## 0.7a0 (06.01.2024)
### Features
* support the recommended `CSS` configuration instead of `"custom_css"`

### Bugfixes
* use the correct `SEARCH` constant instead of `SearchHandler::SEARCH`

## 0.6a0 (03.01.2024)
### Features
* sections can now be given a specific section #fragment by setting the `Section:` value in the content file
* the theme now supports multiple pages by creating sub-folders with content files
* the active menu item is now highlighted if a custom menu is configured and the item URI does not contain a #fragment
* support hyphenated section names
* the target URL of the URL can now be overwritten

## 0.5a0 (30.12.2023)
### Features
* support overwriting the menu through the `MENU` configuration value

## 0.4a1 (29.12.2023)
### Bugfixes
* fix translation bug

## 0.4a0 (29.12.2023)
### Features
* support custom CSS through the `"custom_css"` configuration value

## 0.3a0 (16.11.2022)
### Bugfixes
* fix notices introduced with PHP 8.0
* better handle empty title field
* slightly improve CSS

## 0.2a0 (24.08.2021)
### Bugfixes
* pagination now has correct colours

### Features
* updated dependencies
* improved colour scheme

## 0.1a16 (03.11.2019)
### Features
* updated dependencies

## 0.1a15 (29.09.2019)
### Features
* updated theme to be compatible with Urlaube 0.1a12

## 0.1a14 (03.11.2018)
### Features
* updated theme to be compatible with Urlaube 0.1a10

## 0.1a13 (25.10.2018)
### Features
* updated theme to be compatible with Urlaube 0.1a8

### Bugfixes
* improved default title
* only execute handlers when the theme is active
* modified the handler so that redirect which correct the URI still retain the query string
* do not set a canonical URI on error

## 0.1a12 (19.10.2018)
### Features
* zoom in/out of the menu logo when the menu bar is expanded/collapse

### Bugfixes
* fixed line breaks and trailing whitspace
* clicking on the logo now scrolls to the top of the page instead of reloading it
* headline in list now has same font-weight as on single page

## 0.1a11 (17.10.2018)
### Bugfixes
* only execute the `FILTER_HANDLERS` plugin when this is the active theme
* improve how code blocks look like
* changed `array()` to `[]` shortcodes

## 0.1a10 (17.10.2018)
### Features
* updated theme to be compatible with Urlaube 0.1a7

## 0.1a9 (12.09.2018)
### Features
* optimized look of the theme

## 0.1a8 (15.07.2018)
### Features
* rewrote to use the new `value()` function of the Urlaube core

## 0.1a7 (02.06.2018)
### Features
* prevent instantiation

## 0.1a6 (27.05.2019)
### Features
* introduced support for feed URIs
* removed unnecessary methods

## 0.1a5 (26.05.2018)
### Features
* updated code to match current alpha state of Urlaube core

## 0.1a4 (21.05.2018)
### Features
* updated code to match current alpha-state of Urlaube core
* added CHANGELOG file
* added README file

## 0.1a3 (11.05.2018)
### Features
* use USER_CONTENT_PATH instead of custom handler variable
* more comments
### Security
* fixed html() calls
* added escaping 

## 01.a2 (08.05.2018)
### Bugfixes
* fixed issues with COPYRIGHT_HTML

## 0.1a1 (08.05.2018)
### Features
* allow HTML copyright footer

## 0.1a0 (11.03.2018)
### Features
* initial version
