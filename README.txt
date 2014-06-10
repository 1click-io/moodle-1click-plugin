PREINSTALLATION PROCUEDURE
==========================
	Go to website https://1click.io/webdash/#/signup Do Signup 

After creating a account Sign In : go to :- https://1click.io/dailydashboard/profile/

Copy the Email and Api key field.

* Now open the config.php file in moodle root directory  
for eg in xampp htdocs/moodle/config.php
* Open the config.php file in admin mode or root mode.
* now add two more lines after 
 <<<< $CFG->prefix = '_mdl'; >>>
 add these two lines
$CFG->email = 'your email address';       
$CGF->apikey = 'your api key'


QUICK INSTALL
=============

There are two installation methods that are available. Follow one of these, then log into your Moodle site as an administrator and visit the notifications page to complete the install.

==================== MOST RECOMMENDED METHOD - Git ====================

If you do not have git installed, please see the below link. Please note, it is not necessary to set up the SSH Keys. This is only needed if you are going to create a repository of your own on github.com.

Information on installing git - http://help.github.com/set-up-git-redirect/

Once you have git installed, simply visit the Moodle mod directory and clone https://github.com/dip-kush/oneclick.git, remember to rename the folder to click if you do not specify this in the clone command


Eg. Linux command line would be as follow -

git clone https://github.com/dip-kush/oneclick.git

git 
==================== Download the certificate module. ====================

Visit https://github.com/dip-kush/oneclick.git and download the zip, uncompress this zip and extract the folder.Rename the folder as one click The folder will have a name oneclick. Place this folder in your mod folder in your Moodle directory.

The reason this is not the recommended method is due to the fact you have to over-write the contents of this folder to apply any future updates to the certificate module. In the above method there is a simple command to update the files.
