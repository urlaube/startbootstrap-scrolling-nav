<?php

  // prevent script from getting called directly
  if (!defined("URLAUBE")) { die(""); }

  // this will be a stylesheet
  header("Content-type: text/css");

?>
/*
 * StartBootstrap-Scrolling-Nav Theme based on:
 *
 * Start Bootstrap - Scrolling Nav (https://github.com/BlackrockDigital/startbootstrap-scrolling-nav/tree/v3.3.7)
 * Copyright (c) 2013-2016 Blackrock Digital LLC.
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-scrolling-nav/blob/v3.3.7/LICENSE)
*/

body {
  height : 100%;
  width  : 100%;
}

html {
  height : 100%;
  width  : 100%;
}

@media(min-width:767px) {
  .navbar {
    padding: 20px 0;
    -webkit-transition: background .5s ease-in-out,padding .5s ease-in-out;
    -moz-transition: background .5s ease-in-out,padding .5s ease-in-out;
    transition: background .5s ease-in-out,padding .5s ease-in-out;
  }

  .top-nav-collapse {
    padding: 0;
  }

  .navbar-brand>img {
    height             : 60px;
    margin             : -20px 0;
    -webkit-transition : height .5s ease-in-out,margin .5s ease-in-out;
    -moz-transition    : height .5s ease-in-out,margin .5s ease-in-out;
    transition         : height .5s ease-in-out,margin .5s ease-in-out;
  }

  .top-nav-collapse .navbar-brand>img {
    height             : 40px;
    margin             : -10px 0;
    -webkit-transition : height .5s ease-in-out,margin .5s ease-in-out;
    -moz-transition    : height .5s ease-in-out,margin .5s ease-in-out;
    transition         : height .5s ease-in-out,margin .5s ease-in-out;
  }

  .navbar-nav>li>a {
    margin             : -20px 0;
    padding            : 35px 10px;
    -webkit-transition : padding .5s ease-in-out,margin .5s ease-in-out;
    -moz-transition    : padding .5s ease-in-out,margin .5s ease-in-out;
    transition         : padding .5s ease-in-out,margin .5s ease-in-out;
  }

  .top-nav-collapse .navbar-nav>li>a {
    margin             : 0px 0;
    padding            : 15px 10px;
    -webkit-transition : padding .5s ease-in-out,margin .5s ease-in-out;
    -moz-transition    : padding .5s ease-in-out,margin .5s ease-in-out;
    transition         : padding .5s ease-in-out,margin .5s ease-in-out;
  }
}

@media(max-width:766px) {
  .navbar-brand>img {
    height : 40px;
    margin : -10px 0;
  }

  .navbar-nav>li>a {
    margin  : 0px 0;
    padding : 0px 10px;
  }
}

.navbar-default {
  background   : <?= html(value(Themes::class, "dark_color")) ?>;
  border-color : <?= html(value(Themes::class, "dark_color")) ?>;
}

.navbar-default .navbar-brand:before,
.navbar-default .navbar-nav>li>a:before {
    content     : attr(title);
    display     : block;
    font-weight : bold;
    height      : 0;
    overflow    : hidden;
    visibility  : hidden;
}

.navbar-default .navbar-brand,
.navbar-default .navbar-brand:focus,
.navbar-default .navbar-nav>li>a,
.navbar-default .navbar-nav>li>a:focus {
  color       : #fff;
  font-weight : normal;
}

.navbar-default .navbar-brand:hover,
.navbar-default .navbar-nav>li>a:hover {
  color       : #fff;
  font-weight : bold;
}

.navbar-default .navbar-nav>.active>a,
.navbar-default .navbar-nav>.active>a:focus {
  background  : <?= html(value(Themes::class, "light_color")) ?>;
  color       : #333;
  font-weight : normal;
}

.navbar-default .navbar-nav>.active>a:hover {
  background  : <?= html(value(Themes::class, "light_color")) ?>;
  color       : #333;
  font-weight : bold;
}

section h1 {
  text-align : center;
}

section h1 a,
section h2 a,
section h3 a,
section h4 a,
section h5 a {
  color : #333;
}

section h1 a:focus,
section h1 a:hover,
section h2 a:focus,
section h2 a:hover,
section h3 a:focus,
section h3 a:hover,
section h4 a:focus,
section h4 a:hover,
section h5 a:focus,
section h5 a:hover {
  color : <?= html(value(Themes::class, "dark_color")) ?>;
}

section img {
  margin : 0 10px 0 10px;
}

section li,
section ol,
section ul {
  margin : 10px 0 10px 0;
}

section div.panel,
section h1,
section h2,
section h3,
section h4,
section h5,
section p,
section pre,
section ol,
section ul {
  overflow-wrap : break-word;
}

section pre code {
  white-space : pre;
}

section p,
section ol,
section ul {
  display    : block;
  font-size  : 18px;
  text-align : justify;
}

a {
  color : <?= html(value(Themes::class, "dark_color")) ?>;
}

a:focus,
a:hover {
  color : #333;
}

.empty-section {
  background     : #fff;
  padding-bottom : 50px;
  padding-top    : 50px;
}

.even-section {
  background     : <?= html(value(Themes::class, "light_color")) ?>;
  padding-bottom : 75px;
  padding-top    : 75px;
}

.float-left {
  float : left;
}

.float-right {
  float : right;
}

.footer-section {
  background     : <?= html(value(Themes::class, "dark_color")) ?> !important;
  color          : #eee !important;
  padding-bottom : 50px !important;
  padding-top    : 50px !important;
}

.footer-section p {
  font-size  : 14px !important;
  text-align : center !important;
}

.footer-section p a {
  color : #337ab7 !important;
}

.hidden-border {
  border-color : transparent;
  box-shadow   : none;
}

.hidden-border div.panel-body {
  padding : 0;
}

.uneven-section {
  background     : #fff;
  padding-bottom : 75px;
  padding-top    : 75px;
}
