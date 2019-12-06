# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

## Folder Structure And Information

app/Http/Controllers - Handles requests and responses. Most of the backend code is here.  
app/Policies - This is the gatekeeper of the application. This is how we restrict users from accessing parts they shouldn't have access to  
app/Console/Kernel.php (Unused) - Contains automatic functions of the application such as email notification if participant data is about to expire. I decided to remove this in favor of Mailchimp. We send a yearly reminder through Mailchimp to update participants. By using Mailchimp, we are able to get valuable statistics on user participation.  

resources/views/*** - Contains all of the html files used by Controllers to generate the page.  
routes/web.php - Contains all the web routes of the web application  

storage/app/participants/*** - This is where the participant images are stored. This is a private location and the server must decode the image request for a participant's image to be shown on pages.  

These are the current email features.  
	1. User receives an email confirmation when he/she submits a participant's application  
	2. A admin sends a flyer of a missing person to a select group of emails (Usually schools or a watch commander)    
	3. An admin creates an account for someone  
	4. When a user registers, send a welcome email  
	5. Password Reset  
	6. Guest/user uses the contact form  

## Quick Setup (Local) (https://laravel.com/docs/5.5/installation)

	Skill Requirements
	* Ability to setup a server on the cloud and perform installations, modifications, and upgrades of MySQL, PHP, Apache/NGINX HTTP Server.
	* Ability to install and manage an MySQL database
	* Ability to install and manage an Apache/NGINX HTTP Server
	* Ability to install and manage DNS domains and certificates
	* Ability to install/manage a email server or use another email mailing service 
	* Experience with LAMP stack is a big plus
	* Understanding in Object Oriented Programming (OOP) with PHP and HTML/CSS 
	* Javascript knowledge is a plus

	1. Clone the directory (https://github.com/SantaClarita/Special-Needs-Registry.git)
	2. Navigate to project folder and run "composer install"
	3. Make directory "storage" and "bootstrap/cache" writable by the web server
	4. change .env.example to .env
	5. "php artisan key:generate" 
	6. Fill .env file with database credentials (tested with MySQL)
	7. "php artisan migrate --seed"
		- This will create a database with some test data in database.sqlite for local testing

	Login
	email: admin@example.com 
	password: password 

	The emails will be sent to the storage/log/laravel.log unless you use another driver

## Notes
This project and framework follows the MVC design pattern. You should read the laravel documentation to understand fundamentals. All database interaction is done through Eloquent ORM

I tried to handle cases where bad data would be spit out due to the previous version of the Special Needs Registry.

Participants and users are soft deleted when a participant is deleted by an admin. You can restore the participant/user if needed. Tweaks can be made to the source code to change this behavior.

## Server Setup Requirements For Automatic Email Reminders
If you want to setup the automatic reminders for outdated participants.

https://laravel.com/docs/5.2/scheduling
You will need to add "* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1" to your list of cronjobs. As I said earlier, I opted out to use this in favor of Mailchimp. The code for the automatic email reminders are at app/Http/Kernel.php

## Credit
Christopher Hernandez

## Copyright
Copyright (c) 2018 City of Santa Clarita
See [LICENSE](https://github.com/santaclarita/Special-Needs-Registry/blob/master/LICENSE.md) for details.
