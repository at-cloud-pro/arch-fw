# ArchFW
> Tired of using heavy frameworks like Symfony, CodeIgniter and others? Try our new boilerplating framework. It does 
a lot of magic things to make your development only a pleasure.

## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Setup](#setup)
* [Features](#features)
* [Status](#status)
* [Inspiration](#inspiration)
* [Changelog](#changelog)
* [Contact](#contact)

## General info
__ArchFW__ is micro-framework and boilerplate at once. It connects best part of both: half-closed code, enforced 
architecture and unbelievable perfomance.

## Technologies
Project in order to run requires PHP in version __7.2.6__ with __PDO library__. Using framework requires small experience into PHP language. From programmers, for programmers. As simple as it's possible. You will install this project with Composer. If you want to use Sass and 7-1 Pattern you will also need __Node Packet Manager__ (__NPM__).

## Setup

Run required commands in your system shell:
```sh
$ composer install
$ npm install
```
Remember that server root must be set on `/public_html` folder. A version that does not requite changing server root will be released someday, but for safety this method is simly the best.

If all has been successfully set, you will see proper screen entering `http://localhost/` or any domain/IP adress.

## Code Examples
Soon here will be released some code sniffs and tricks

## Features
Framework is going to be perfect, now it does:
* Routering management
* HTML and JSON renderers
* Own logger with file saving
* Extensible exceptions with error logging
* Modern procedural view engine
* Fast OOP MC classes
* Easiest extentible config ever (PHP Array file)
* Medoo database - lightest library included

Still in development and further plans:
* Autoloading config files
* Installation wizard
* 

Have any ideas what this FW should contain? PM me over _kontakt@archi-tektur.pl_

## Status

Framework has stable release __2.6.0__ in `master` branch, in `dev` branch you can find also the newest version - but 
watch out,
 it 
probably WILL NOT be stable. 

New functionalities, bux fixes and code reusages are developed quite often, at least once a two months something is 
changing. Backward compatibility can't be provided on this stage of development, but it will be available soon.


## Inspiration
Well, hard to say - a willing for making something on my own, a hate that exists on many forums on the whole language
 (PHP never been the liked one). Every time I look how much unneeded code is used in Symfony, one atom of my heart 
 dies. It's obvious that Symfony is a giant tool, but most of my projects needs a simple router, renderer and wrapper
  mechanism - so that's why I created this. If you think _is it legit for bigger projects?_ - the answer is - yes! A 
  whole __Digitale Schiene Deutschland__ project were written on this - a huge programme for German Federal Railways.
   And it's code is pretty easy to maintain - that's the fault of overthinked architecture, which might seem weird - 
   but you will love it! So, now go and test my framework :D

## Changelog

For changelog click [here](CHANGELOG.md).

## Contact
Created by [@archi_tektur](https://www.archi-tektur.pl/) with love - feel free to contact me anytime!