
Deployment Script
-----------------
-Can be found in the root directory of this GitHub repository, with the filename "install.bash"
-Written for use with a DigitalOcean droplet with the image option named "Ubuntu LEMP on 18.04"
-Script should be placed in the bin directory and be executed from the root directory

-Before running the script, the following commands should be executed from the bin directory:
    -"chmod 755 install.bash"
    -"sed -i -e 's/\r$//' install.bash"


Unit Tests
----------
-Can be found in the directory "tests/Unit"

-Controller Tests contained in PHP files:
    -AuthControllerTest.php
    -CommentControllerTest.php
    -PaymentControllerTest.php

-Service Tests contained in PHP files:
    -CommentServiceTest.php
    -PaymentServiceTest.php


Front-end Tests
---------------
-Can be found in the directory "tests/"



-Tests can be executed in the Droplet using the following commands:
    -"cd /var/www/comp586/vendor/bin"
    -"phpunit ../../tests"
