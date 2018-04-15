# Framework
Hello, welcome at my masterpiece framework site. Here in short I will show you why my framework is so good, why it simplifies PHP programming and how to use it.

# Files and Folders

As far as you probably know, big project has a lots of files that are really easy for being messed up. My framework force using folder style file sorting, which is the best way to keep your project nice and clear, even if files count is enourmous.

## Using already created folders

In framework main folder there is some standard folders already created! By default you should have this folder tree:

 - code
	 - controller
	 - model
	 - scripts
	 - tools
	 - model
	 - visual
		 - partial
		 - errorcodes
 - css
 - docs
 - img

Each of this folders has it's own, already assigned function.

### code
Here stays all files that are comparable with word "content". Here stays all PHP logic, PHP view management, errorcodes screens and view parts. Inside this folder we have an index file that basing on `$_SERVER["REQUEST_URI"]` is launching correct view template from each folder. More about exact work method will be described later.
#### controller
Here on the other hand stands all controllers. Controller is an indepedent class, with indepedent methods category, eg. Article controller that makes all actions around article to be seen. Controller in fact connects datas from Model with View. Even simpler said - Controller asks Model for data, then is making on them calculations or whatever and then serves it's for proper View template straightly to be rendered.
#### model
Model in MVC is data. Exactly - model functions role is to bring raw data from eg. database, files, stacks on every controller request. In my framework you have one model file done yet - `database.php`. But his role will be explained further.
#### scripts
Here is empty folder, where you will put all front-end based scripts (JS most likely...). You can put here all scripts from entire project, if there's a lot of them better put it in separate folders for making it less messy.
#### tools
Here's next empty folder. As far as you know programmers role is to bring for client best looking, best working solutions. But in this folder will be placed simpliest backend or frontend scripts NOT used by users, but by programmers such as you, eg. manual database uploader, and many many more. You can paste here also some undeveloped classes and tools.
#### visual
An frontends programmers mecca. Here stands all visual and view-related files. Still - content related not CSS or image files. For not messing it around, here is some folders also created. If an app is simple and it has'nt so much view files you can save all that files straightly here - but when it becomes bigger and bigger searching it will be much much more complicated. And you are using this framework for making the work easier, not harder - don't you? So if there's messing up - categorize files in your own way and create new folder then.
##### errorcodes
Here are simple errorcode pages. By default there's raw HTML files with simple errorcode, but there's really nothing blocking you against changing it to some masterpiece error screens - however a good app should really rarely use files from this folder.
##### partial
Well, full HTML file is long. And recurrent. So, I've thought that dividing it into few other files and just linking them will be a good idea. I don't think you will have to create here some new files - but who knows?
### css 
Well, obviously - here you will be holding your CSS files. By default there is 4 CSS files: 3 are common depending on screen width, and the last one - Animate.css from [here.](https://daneden.github.io/animate.css/)
### docs
Empty on default, here you can hold all your PDF, DOCX and many more documents. PDF are so funny and nice in web, because all browsers are in possibility to show them easily, and creating an PDF is much much faster than developing full page-style with HTML and CSS. Perfect for conditions, rules, and many many more.
### img
Who can imagine a website without any graphics? Oh, most of a people can't. Here you will be holding your images, I recommend to hold them in separate folders based on where-are-they-used, so don't be lazy and create some cozy folders for them!
### sql
When you are using database, don't be a prick and let the user lauch your app with your app - really nessesary when putting your project on github for example. Another usage is backups - but do not forget to disable access by browsers then...

And this is all folders here.
## Files
Every file has it's home - you were invited to them and you have seen all by now. Let's now take a look for inhibitants. 
My framework comes with a lot of basic functions such as default Database class, User management class, Cookie setter, config file reader and so on.  We will be going alphabethically from A to Z by folders also from A to Z.
### .htaccess 
Base file for Apache server configuration. In my framework it has defautly on Cache set to one month and deflate function that is shorting app loading time by compressing the files.
### config.php
### index.php
### LICENSE.txt
### code/index.php
### controller/application.php
### controller/users.php
### model/database.php
### visual/index.php
## Using framework

further....

## Working method
On next update...
## Usage exaples
Soon...
## Q&A
Also soon...
## Reported bugs
None at this moment :p
