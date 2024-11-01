=== Plugin Name ===
Contributors: fotan
Donate link: http://www.fotan.net/custom-wordpress-plugins
Tags: backup,archive,whole site,downloadable backup,downloadable archive
Requires at least: 3.0
Tested up to: 2.1
Stable tag: 1.1

Simple backup utility to create archive of whole WordPress installation plus database.

== Description ==

This is my first plugin.  Pretty simple really.  I needed something that would allow one of my clients to create an archive of their whole WP site and database, then download it so it didn't take up a bunch of space on my server.

A few things to keep in mind.  I wrote this for my server.  Your mileage may vary.  I'm running a LAMP server with all latest stable releases (PHP 5.3+, MySQL 5+, Apache 2+) and gzip installed.  That may or may not be important.  I'm no server guy.  All I know for certain is it works with that configuration.  I suspect that it will run on most any LAMP setup, but I can't guarantee it.

One nice thing…  The file that is created is named with the site title, date and time of creation and the WP version it's running.  If there's a server crash, or your web guy dies, you know exactly what you have to do to get back up and running quickly.

== Installation ==

Installation should be pretty simple, I guess.  Just upload it to the plugins folder, or use the automatic installed, then enable it.



== Frequently Asked Questions ==



== Screenshots ==

1. Plugin creates a "Total Backup" link at the bottom of the left side of Dashboard.
2. When you hit the link (in screenshot 1) you get this page.  By the time you see it, the archive has been created.  Just hit the download link and it should go to your browser's download manager.  Once you have it on your local computer, hit the delete button and it is deleted from the server.

== Changelog ==
= 1.1 =
* Fixed a couple file naming problems. Should fix the "404 error on delete and actually delete the archive from the server now.
= 1.0 =
* Initial Release.




