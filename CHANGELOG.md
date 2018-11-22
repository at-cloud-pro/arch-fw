#ArchFW Changelog

All notable changes to this project will be written here.

## [Unreleased]

###Changed
- Autoloading config files
- Installation wizard

## [2.6.0] - 24-11-2018
###Added
- Completely rebuilt Config mechanism.
- Partially rebuilt Router mechanism.
- Added new custom Exceptions.
- Now config array data are filled by ConfigFactory.
###Changed
- Now access to friendly addresses like `http://localhost/this/is/friendly/address` is served by 
`ArchFW\Controller\Router::getAllURI();` and `ArchFW\Controller\Router::getNthURI();` instead of `ROUTER` constant.
- Now access to configuration files is served by 
`ArchFW\Controller\Config::get();` and `ArchFW\Controller\Config::get();` instead of `CONFIG` constant.
- Rewritten `ArchFW\Controller\Router` class to be and `Renderable` object factory.
- Framework load time shortened by 22% using PHP7 syntaxes.

###Removed
- `ROUTER` superglobal constant that kept all router friendly path data. Use `ArchFW\Controller\Router::getAllURI();` 
and 
`ArchFW\Controller\Router::getNthURI();` instead.
- `CONFIG` superglobal constant that kept all application config. Use `ArchFW\Controller\Config::get()` and 
`ArchFW\Controller\Config::set()` instead.

## [2.5.1] - 18-11-2018
###Added
- Added `redirectOnNoMatch` function to routing config
###Removed
Removed ArchAPI tools which has been always marked as `BETA - do not use`. New version of this tools will be given 
sooner or later.

## [2.5.0] - 18-11-2018
Initial version of the software