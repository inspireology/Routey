What is Routing and Why do We Do it?
Written for PHP 7

A router maps a web URL to particular codepaths in your codebase. In legacy web development a typical directory structure is 

images/
javascript/
library/
userpage.php
login.php
gallery.php

A page like login.php would contain authentication code and presentation code.
A problem of working this way is that if at any time we need to log in from another page we have to either duplicate the code from login.php. 

Thinking more intelligently about our code, we move the authentication code for the login page out of login.php to somewhere in the library/ folder. The login.php now only really contains presentation code.

This pattern is everywhere. The removal of logic from these \*.php end points results in a file that is mostly presentational data.

[

 ????????????????????
REST...

]

The problem at hand is mapping which code is run and which presentations are called with which URL.


