# ArchFW
[![Latest Stable Version](https://poser.pugx.org/archi-tektur/arch-fw/v/stable)](https://packagist.org/packages/archi-tektur/arch-fw)
[![Total Downloads](https://poser.pugx.org/archi-tektur/arch-fw/downloads)](https://packagist.org/packages/archi-tektur/arch-fw)
[![License](https://poser.pugx.org/archi-tektur/arch-fw/license)](https://packagist.org/packages/archi-tektur/arch-fw)
[![Monthly Downloads](https://poser.pugx.org/archi-tektur/arch-fw/d/monthly)](https://packagist.org/packages/archi-tektur/arch-fw)
[![composer.lock](https://poser.pugx.org/archi-tektur/arch-fw/composerlock)](https://packagist.org/packages/archi-tektur/arch-fw)

> Tired of using heavy frameworks like Symfony, Laravel and others for your small project? Try out our new boilerplating framework! It does 
a lot of magic things to make your development only a pleasure. Let me take you on a ride...

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
__ArchFW__ is micro-framework and boilerplate at once. It connects best parts of both: half-closed code, enforced architecture and unbelievable perfomance.

## Technologies
Project in order to run requires at least PHP version __7.2.6__ with __PDO library__. Using framework requires moderate experience into PHP language. By programmers, for programmers. As simple as it's possible. You will install this project with Composer easily. If you want to use SCSS and it's 7-1 Pattern you will also need __Node Packet Manager__ (__NPM__).

## Setup

Run required commands in your system shell:
```sh
$ composer install
$ npm install
```
It may happen that some packages from this project will be outdated, then run:
```sh
$ npm audit fix
```

Remember that server root must be set on `/public_html` folder. A version that does not requite changing server root will be released someday, but for safety this method is simply the best. Keep in mind that keeping your private data and code outside server root is considered to be a best practice.

If all has been successfully set, you will see proper screen entering `http://localhost/` or any domain/IP adress.

## Code Examples
In near future here will be huge section about configuring and using this framework.

## Features
Framework is going to be perfect, now it does:
* Routing management
* HTML and JSON renderers
* Own logger with logging to file
* Extensible exceptions with error logging
* Modern OOP view engine
* Fast OOP MC classes
* Easiest extentible config ever (PHP array file)
* Medoo database - lightest SQL query builder included

Still in development and further plans:
* Autoloading config files
* Installation wizard
* ... here might be your request, don't be aware to PR or Issue this!

Have any ideas what this FW should contain? PM me over _kontakt@archi-tektur.pl_

## Status

Framework has stable release __2.8.0__ in `master` branch, in `dev` branch you can find also the newest version - but watch out, it probably WILL NOT be stable. 

New functionalities, bux fixes and code reusages are developed quite often, at least once a two months something is changing. Backward compatibility can't be provided on this stage of development, but it will be guaranteed soon.


## Inspiration
Well, hard to say - a willing for making something on my own, a hate that exists on many forums on the whole language (PHP never been the liked one). Every time I look how much unneeded code is used in Symfony (mostly in small projects!), one atom of my heart  dies. It's obvious that Symfony is a giant, great tool with awesome tools and prepared workflow, but most of my projects at this time needed only a simple router, basic renderer and wrapper  mechanism - so that's why I created this. If you think _is it accurate for bigger projects?_ - the answer is - yes! A whole __Digitale Schiene Deutschland__ project were written on this - a huge programme for German Federal Railways. And it's code is pretty easy to maintain - that's the fault of overthinked architecture, which might seem weird - but you will love it! So, now go and test my framework!

## Changelog
Newest available version is __[2.8.0]__
For changelog click [here](CHANGELOG.md).

## Contact
Created by [@archi_tektur](https://www.archi-tektur.pl/) with love - feel free to contact me anytime!