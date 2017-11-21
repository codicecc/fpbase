# FPbase

## My FuelPHP Base

### Quick Start

* Download the zip file
* Uncompress file
* From console, run: `oil refine migrate::current`
* From console, creating admin user, run: `oil console`
* `Auth::create_user('admin', 'password', 'phil@example.com', 100);`
* Access in admin area

### Changelog 1705261137

* Composer Update
* Change Route default admin
* Add Project name in login page
* Integrate custom menu:
	* Array in config file
	* Create an Helper to generate HTML Menu
* Change links to buttons

### First Commit My FuelPHP Base version 1703111411

### User management
FuelPHP _Boilerplate_ with user management based on _SimpleAuth_.

Every _Role_ belong to own _Group_ __with same name__. For every _Role_ there are some _Permissions_.

The _Groups_ are:
* Banned
* Generic
* AdminAreaAccess
* Subscriber
* Editor
* Manager
* Admin

### Multilanguage settings

User language value is stored in key "lang" of _profile_fields_ user field 

### Send Email

Email2 class, send2 method It is used for Recovery Password 

### Recovery Password 

# FuelPHP

* Version: 1.8
* [Website](http://fuelphp.com/)
* [Release Documentation](http://docs.fuelphp.com)
* [Release API browser](http://api.fuelphp.com)
* [Development branch Documentation](http://dev-docs.fuelphp.com)
* [Development branch API browser](http://dev-api.fuelphp.com)
* [Support Forum](http://fuelphp.com/forums) for comments, discussion and community support

## Description

FuelPHP is a fast, lightweight PHP 5.3+ framework. In an age where frameworks are a dime a dozen, We believe that FuelPHP will stand out in the crowd.  It will do this by combining all the things you love about the great frameworks out there, while getting rid of the bad.

FuelPHP is fully PHP 7 compatible.

## More information

For more detailed information, see the [development wiki](https://github.com/fuelphp/fuelphp/wiki).

##Development Team

* Harro Verton - Project Manager, Developer ([http://wanwizard.eu/](http://wanwizard.eu/))
* Steve West - Core Developer, ORM
* Márk Sági-Kazár - Developer

### Want to join?

The FuelPHP development team is always looking for new team members, who are willing
to help lift the framework to the next level, and have the commitment to not only
produce awesome code, but also great documentation, and support to our users.

You can not apply for membership. Start by sending in pull-requests, work on outstanding
feature requests or bugs, and become active in the #fuelphp IRC channel. If your skills
are up to scratch, we will notice you, and will ask you to become a team member.

### Alumni

* Frank de Jonge - Developer ([http://frenky.net/](http://frenky.net/))
* Jelmer Schreuder - Developer ([http://jelmerschreuder.nl/](http://jelmerschreuder.nl/))
* Phil Sturgeon - Developer ([http://philsturgeon.co.uk](http://philsturgeon.co.uk))
* Dan Horrigan - Founder, Developer ([http://dhorrigan.com](http://dhorrigan.com))
