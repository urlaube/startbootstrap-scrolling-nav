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
}

.navbar-brand>img {
  height : 25px;
}

.navbar-default {
  background   : <?= html(Themes::get("dark_color")) ?>;
  border-color : <?= html(Themes::get("dark_color")) ?>;
}

.navbar-default .navbar-brand,
.navbar-default .navbar-nav>li>a {
  color : #eeeeee;
}

.navbar-default .navbar-brand:focus,
.navbar-default .navbar-brand:hover,
.navbar-default .navbar-nav>li>a:focus,
.navbar-default .navbar-nav>li>a:hover {
  color : #bbb;
}

.navbar-default .navbar-nav>.active>a,
.navbar-default .navbar-nav>.active>a:focus,
.navbar-default .navbar-nav>.active>a:hover {
  background : <?= html(Themes::get("light_color")) ?>;
  color      : #111111;
}

section h1 {
  text-align : center;
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

section p {
  display : block;
}

.empty-section {
  background     : #ffffff;
  padding-bottom : 50px;
  padding-top    : 50px;
}

.even-section {
  background     : <?= html(Themes::get("light_color")) ?>;
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
  background     : <?= html(Themes::get("dark_color")) ?>;
  color          : #eeeeee;
  padding-bottom : 50px;
  padding-top    : 50px;
  text-align     : center;
}

.hidden-border {
  border-color : transparent;
  box-shadow   : none;
}

.hidden-border div.panel-body {
  padding : 0;
}

.uneven-section {
  background     : #ffffff;
  padding-bottom : 75px;
  padding-top    : 75px;
}
