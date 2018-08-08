# ArchFW - modern boilerplate for innovative applications
ArchFW is a short form of ArchFramework. We - archi_tektur team - developed this software as a solution for common PHP applications problems, such as securing session, cute error throwing and routing. Software is still growing, so we are expanding it's capabilities: API serving, using APIs and many many more!
![GitHub Logo](https://archi-tektur.pl/img/gh/wizytowka-r.png)
Format: ![Alt Text](url)

## Requirements
Application to be runned requires few composer components, PHP Interpreter above 7.0.0 version with preinstalled PDO library. Database is not required, but it definitely will help in development. Framework requires basic knowledge of PHP, variables, arrays, object-oriented programming. It's dedicated by developers for developers, it's not like WordPress - that every person can easily install. But we are sure that installation of our framework is siply easy.
## Instruction
Here, in short we will introduce you to our framework. We are still trying to KISS (Keep it simple, stupid!), so we hope that this README will be best source of knowledge, that we will make you understand main rules that every ArchFW developer has to keep.
### Download
First things first. You will have to download our framework from this repo (please always use master branch, only there is the newest, stable version of our software). Place downloaded folder somewhere on your hard disk. Enter the folder - you will see `/public` catalogue, with index.php and some files and folders. Set your server root to this folder.
### Instalation
Second, you may know Composer - it's PHP packet manager. Well, our application boilerplate use some common PHP Libraries, PHPMailer for example, so we'll use Composer to download them and automagically couple them to your new shiny app. Now, run Command Prompt or Terminal over the main framework folder (not `/public`!). Execute this commands in prompt:
```sh
$ composer install
```
Congratulations, this step should create `/vendor` path in your main application folder. 

### Configuration
Now grab config.php file that is located in main app catalogue, and edit it. It's PHP array, containing most values that you may want to change in framework. Pay attention to comments over there, don't delete any records, follow the instructions in file header. File has few sections:

|Name|type|Value|
|:-------------:|:-------------:|:----- |
|__`dev`__|[__boolean__]|Contains information if framework is running whith developer mode. It will show all errors while developing, which might be really helpful.|
|__`metaConfig`__|[__array__]|Holds basic information about webpage, it's common element for all pages - don't worry, you can change it manually later for selected pages.|
|__`stylesheets`__|[__array__]|Has information about all CSS stylesheets over project. All CSS used here will be added to all pages using this framework, so use it wisely!. Every single stylesheet should has suitable array, example is commented in code.|
|__`DBConfig`__|[__array__]|ArchFW supports awesomely Databases! Actually, we're using Medoo library for connecting and executing SQL queries so you are extremely safe against SQL Injections and many more!. Here you need to specify yours database details.|
|__`MailerConfig`__|[__array__]|Enter here credintials to your mail account and few more details to have a possibility to send mails via application.|
|__`twigConfig`__|[__array__]|As far as you are going to use ArchFW in our (best) way, you should leave it as it is. Here you can specify where application will be looking for wrappers and TWIG templates. What wrapper and TWIG file is we'll tell you under _Development_. |
|__`appRouter`__|[__array__]|Here magic happens - details of routing in this app will be providen in 'Development with ArchFW' section of this document |
|__`pathToErrorPages`__|[__string__]|Obviously - the path where application will look for errorpages. For example, if __404__ error happens, `404.html` file will be loaded.|
|__`APIrunning`__|[__bolean__]||
|__`APIrouter`__|[__array__]||
|__`APIwrappers`__|[__string__]||

If everything is correctly builded you may run tests right now.
### Fail checklist

## Development with ArchFw
Okey, we've passed long way via technical details - now in short about ArchFW architecture. 
ArchFW is developed with MVC-W scheme - extended, safer version of MVC. It stands for Model - View - Controller - Wrapper. Index file runs an application, built-in router chooses wrapper.. yes, wrapper.
### Role of wrappers
Wrappper is non-object-oriented script written in PHP language. It has to download all data required on page, and return it as TWIG variables. Every page in ArchFW App has it's own wrapper. Wrapper files for normal pages are located by default in `/assets/wrappers` catalog. When it comes to API - it's recommended to return JSON responses, so if you are programming an API script (about this - later), wrapper will be located in `/assets/api` catalog. Each wrapper has to return some values. If you will omit the return command - an error will be raised. In case you don't want to return any data - just create file such this:
```php
<?php
return [];
```

### API or HTML page?
Our framework provides best-ever router, the application you will build can return informations basically in two ways: JSON and normal HTML page. You will use JSON every time when you will project API. You will use HTML when you will want to build old-style server-side rendered page. Simple!
### Practise - HTML
We're working here with TWIG templates engine. Below, in links section you will have link to TWIG documentation, where is perfectly shown what TWIG is, and why it's even better way than normal PHP markups. 
But first things first. You want to create something simple. A simple webpage that will return server date and time, it will be located at `localhost/date`. At the beginning open `config.cfg` file which is located in main framework folder. In section __`appRouter`__ you will add query like this: `'/date' => 'date',`, so finally this part will looks like this:
```php
'appRouter' =>
    [
        '/' => 'index',
        '/date' => 'date',
    ],
```
And DO NOT miss names __`appRouter`__ and __`APIrouter`__ - it's really big difference. By putting this record to the config file, you've told the application that it has to look for __wrapper__ file in `/assets/wrappers` and __twig__ file in `/assets/templates`. 
Now, go to `/assets/templates` and create new file - `date.twig`. Markup of this file will look like this:
```twig
{% include "common/header.twig" %}
<h1>Server time checker</h1>
<p>Actual server time is: {{actualDate}} </p>
{% include "common/header.twig" %}
```
Paste it to this file. First and last line is _includes_. You don't need to bother what it is, but it's making whole document HTML'ly correct. Space between this lines is your HTML `<body></body>` tag. This weird `{{variable_name}}` syntax is TWIG variable.
__Remember!__ DO NOT put anything above first line, and nothing after last line. 
Now, wrapper time. Go to `/assets/wrappers` and create `date.php` file. Copy below code to this file.
```php
<?php
$date = date("Y-m-d H:i:s"); // MySQL DATATIME format
return [ 'actualDate' => $date ];
```
OK, so let's check what else you have to do to make this webpage to run - oh, it's nothing! Go to your browser, launch `localhost/date` and enjoy first ever ArchFW you have just written ;) If actual date hasn't shown, make sure you have already configured ArchFW for your server and you have the same value in `{{actualDate}}` and in PHP array you return. Now should work ;)
### Practise - API
OK, you have built simplest web page, so now let's serve an JSON REST API via ArchFW. Go to `config.php` file, right to the __`APIrouter`__ section. Paste to this array this: `'/date' => 'date',`, so this part of config should looks like this:
```php
    'APIrouter' =>
    [
        '/test' => 'test',
        '/date' => 'date'
    ],
```
Now, you have shown to the app that whenever someone will try to launch `localhost/api/date` it will load the `date.php` file from `/assets/api`. So let's go there and create simplest API file. Paste below code or write it your way - you may know how to do this. You have to return an array, it will be auto-magically transformed to JSON and printed, then the script will be done.
```php
<?php
if($_SERVER['REQUEST_METHOD'] === 'GET'){ 
    // this `if` is because of REST API style - we ask for data, so we use GET method
    return ['actualDate' => date("Y-m-d H:i:s")];
} else new Error(405, "Method not Allowed", Error::JSON);
```
And.. yes, it's all you need to create this API! Run Postman or any other program designed for API testing - and try with `localhost/api/date`. See how simple in nature development ArchFW is?
Perhaps you may ask for this line:
```php
new Error(405, "Method not Allowed", Error::JSON);
```
You will find this and other shared function in shared elements reference below.

### Practise - creating controllers and all around OOP
Okey, as far as simple status APIs or static pages might be running chasing it's logic only in __wrapper__ files, as soon you will want to develop more advanced task with your App. It's absolutely not a problem in ArchFW! 
You have to learn - `/src` catalogue holds whole logic. Any advanced algorithms, classes, whole OOP stands there. Wrappers are only scripts thats creating new objects located in `/src`. In this Practise we will create simple login page. Ready? Let's go! 

MORE DOCUMENTATION SOON

## Shared resources reference





















