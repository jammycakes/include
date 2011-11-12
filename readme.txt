Include for WordPress
=====================
version 1.0

Copyright 2006 James McKay
http://www.jamesmckay.net/

Introduction
============
This plugin allows you to include a file of PHP code in your blog posts
or pages.


Installation
============
Unzip the contents of the archive into your wp-content/plugins directory
and activate in the WordPress dashboard.

It is recommended that you put the plugin into its own directory, rather
than copying the include.php file into the plugin directory itself.
Your directory structure would then look like this:

<home>
\- wp-content
   \- plugins
      \- include
         |- include.php
         \- scripts
            |- myscript1.php  }  These are the scripts that the plugin
            \- myscript2.php  }  will be running.


Configuration
=============
There are no configuration options for this plugin.


Usage
=====
Place any files of code that you wish to include in the plugin's scripts
subfolder.

To include a file of code in your post, use the following syntax:

<!--#include filename-->

where filename is the name of the file and optionally the .php extension,
with no path information. All files are presumed to be within the
scripts folder.

If you wish to pass any arguments to your script, you can do so:

<!--#include filename key1="value1" key2="value2"-->

These will be passed to the script as an associative array in the $args
global variable.

A number of sample scripts are included to help you get started.


Compatibility
=============
Wordpress 1.5, 2.0 and 2.1.


Redistribution
==============
GNU General Public License.


Happy blogging!

James McKay
http://www.jamesmckay.net/

Changelog
=========

2006-12-28:	Initial release