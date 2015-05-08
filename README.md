# Ultimate Plugin Boilerplate

A boilerplate for WordPress plugin developers. 

**This is still extremely beta. Not ready for production.**

## Features

+ Grunt building of SCSS and CoffeeSripts, and also releasing of new versions.
+ Composer dependancy management
+ Cuztom - A helper to make the life of Wordpress developers easier.
+ A ready to use template system

## Requirements

+ PHP 5.3 or later (I'm a bad boy. Closures are being used. You could use change this if you wanted.)

## Installation

Fork or clone this repository.

    git clone https://github.com/tormjens/Ultimate-Plugin-Boilerplate

Install the composer dependencies

    composer install

Install the npm packages

    npm install

### Rename files, functions, classes and constants

As most of the boilerplate is object-oriented you only need to change the name of some constants, class names and function names.

The naming of all these are done with three variants of the plugin name.

+ `ULTIMATE_PLUGIN_` for constants.
+ `ultimate_plugin_` for functions.
+ `Ultimate_Plugin_` for classes.
+ `up_` for global variables.

All those should be renamed recursively in all folders as they will occur several places.

The package name in `package.json` is used for copying when using the `release` task in Grunt, so you should probably change this aswell if you are going to use it.

You should also change the name of the main plugin file `ultimate-plugin.php`  to the same name as you package name in `package.json`
