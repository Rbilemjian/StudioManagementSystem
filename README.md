Note Regarding Frontend/Backend Tests
-------------------------------------

Dependency for frontend tests (laravel dusk) installed through composer (laravel’s package management system) fine on my local machine, but hung and never completed installation on my remote server. Therefore, the version of the app that is in the remote server is the “beforedusk” branch (Only difference is no frontend testing code or package included). The newest version of the “master” branch in the repository has all of the frontend tests, and the code can be seen there. Tests unfortunately cannot be run in the production environment, but I have included some videos of execution of the tests on my local machine:

	Unit Tests: https://www.youtube.com/watch?v=aDsu2l91eM0&feature=youtu.be

	Frontend Tests: https://www.youtube.com/watch?v=yblsxzkNDY8&feature=youtu.be

Additions to go Above a B
-------------------------

Deployment Script

-Can be found in the root directory of the GitHub repository, with the filename "install.bash"

-Written for use with a DigitalOcean droplet with the image option named "Ubuntu LEMP on 18.04"

-Script should be placed in the bin directory

-Before running the script, the following commands should be executed from the bin directory:

	chmod 755 install.bash

	sed -i -e 's/\r$//' install.bash

The script can then be executed from the root directory by executing the command:

	/bin/install.bash

Video of deployment script being executed on a droplet through ssh and deploying site with no prior modification to the VM other than the steps before execution mentioned above:

	https://www.youtube.com/watch?v=RMEHeFFM61U&feature=youtu.be



Unit Tests

Can be found in the directory "tests/Unit"


Controller Tests contained in PHP files:

	AuthControllerTest.php

    CommentControllerTest.php

    PaymentControllerTest.php


Service Tests contained in PHP files:

	CommentServiceTest.php

	PaymentServiceTest.php



Front-end Tests

Can be found in the directory "tests/Browser" in PHP file:

	FrontEndTest.php
