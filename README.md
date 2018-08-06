# ArchFW - modern boilerplate for innovative applications
ArchFW is a short form of ArchFramework. We - archi_tektur team - developed this software as a solution for common PHP applications problems, such as securing session, cute error throwing and routing. Software is still growing, so we are expanding it's capabilities: API serving, using APIs and many many more!

## Requirements

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
Now grab config.php file that is located in main app catalogue, and edit it. It's PHP array, containing most values that you may want to change in framework. Pay attention to comments over there, don't delete any records, follow the instructions in file header. File has few sections

|Name|type|Value|
|:-------------:|:-------------:|:----- |
|__`dev`__|[__boolean__]|Contains information if framework is running whith developer mode. It will show all errors while developing, which might be really helpful.|
|__`metaConfig`__|[__array__]|Holds basic information about webpage, it's common element for all pages - don't worry, you can change it manually later for selected pages.|
|__`stylesheets`__|[__array__]|Has information about all CSS stylesheets over project. All CSS used here will be added to all pages using this framework, so use it wisely!. Every single stylesheet should has suitable array, example is commented in code.|
|__`DBConfig`__|[__array__]|ArchFW supports awesomely Databases! Actually, we're using Medoo library for connecting and executing SQL queries so you are extremely safe against SQL Injections and many more!. Here you need to specify yours database details.|
|__`MailerConfig`__|[__array__]||
|__`twigConfig`__|[__array__]|As far as you are going to use ArchFW in our (best) way, you should leave it as it is. Here you can specify where application will be looking for wrappers and TWIG templates. What wrapper and TWIG file is we'll tell you under _Development_. |
|__`appRouter`__|[__array__]||
|__`pathToErrorPages`__|[__string__]||
|__`APIrunning`__|[__bolean__]||
|__`APIrouter`__|[__array__]||
|__`APIwrappers`__|[__string__]||



### Fail checklist