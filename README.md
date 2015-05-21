# wp-nginx

Clone this repo.

CD to the project directory and open the puphpet/config.yaml file in your favorite text editor or IDE.

Search for ```project.dev``` and replace with your project's development domain, *for example*, ```awesomeproject.dev```.

Save the file.

Edit your [hosts file](http://en.wikipedia.org/wiki/Hosts_\(file\)).

Add :  

```
192.168.56.101    awesomeproject.dev    www.awesomeproject.dev    docs.awesomeproject.dev  
```

Save the file.

CD back to the project root.

Run :  

```
$ vagrant up
```

Have a cup of coffee while Vagrant downloads the necessary files.

When the machine has finished booting, you should be able to visit [http://awesomeproject.dev](http://awesomeproject.dev) in your browser.

On initial visit, the [famous 5 minute WordPress install](https://codex.wordpress.org/Installing_WordPress#Finishing_installation) screen should be presented to you.

Fill out the form to complete the installation process.

You should now have a fully functional [WordPress](https://wordpress.org/) installation running in [Vagrant](https://www.vagrantup.com/).

Visting [http://awesomeproject.dev:1080/](http://awesomeproject.dev:1080/) should bring you to the [Mailcatcher](http://mailcatcher.me/) server. From Mailcatcher you can view and debug emails being sent by WordPress on your guest machine.

Visiting [http://docs.awesomeproject.dev/](http://docs.awesomeproject.dev/) should bring you to a barebones MDwiki installation.

## Command Line Work

It is strongly suggested that command line actions, such as composer install, composer update, wp-cli commands, etc., be performed ***in*** the Guest VM.

Performing command line actions from the Host could have unexpected consequences.

Refer to the [Vagrant SSH documentation](http://docs.vagrantup.com/v2/cli/ssh.html).

## Composer

The composer.json file sits in the root of the project.
Edit / modify this file to suit your project's needs.

## Structural Details

This Vagrant box was built with [Puphpet.com](https://puphpet.com/), with some additions/modifications to make it more WP friendly. To read more about Puphpet's features, [visit their website](https://puphpet.com/#help).

Points of interest in the Vagrant box outlined below :  

```
├── .editorconfig
├── .gitattributes
├── .gitignore
├── README.md (this file)
├── bin (where Composer installs binaries for use in the Guest machine)
├── composer.json (the Composer installer that adds WP / Plugins / Themes into the web root)
├── docs (barebones MDwiki installation)
├── html (web root)
│   ├── index.php
│   ├── wp (WordPress Core)
│   ├── wp-cli.yml (WP-CLI config providing path to core)
│   ├── wp-config.php (The WP Config file)
│   └── wp-content
│       ├── mu-plugins
│       ├── plugins
│       ├── themes
│       └── uploads
├── puphpet (files generated by puphpet, required by Vagrant for spin up)
│   ├── config.yaml (The Puphpet config)
│   ├── files
│   │   ├── exec-once
│   │   │   ├── 01-delete-index-html.sh (custom script to delete the default index.html file from web root)
│   │   │   ├── 02-wordpress-config-copy.sh (custom script to copy wp-config-dist to wp-config in proper location)
│   │   │   ├── 03-composer-install.sh (custom script to kick off Composer installation)
│   │   │   ├── 04-phpcs-config-set.sh (custom script to add WordPress Coding Standards to phpcs in the Guest)
│   │   │   └── empty
│   │   └── startup-always-unprivileged
│   │       ├── 01-echo-wordpress-ascii-art.sh (Extra WordPress Goodness)
│   │       └── empty
│   └── vagrant
│       └── Vagrantfile-local (slightly modified from original for Win support)
├── vendor
│   └── wp-coding-standards (WordPress coding standards, accessible by phpcs in host, can be added to PhpStorm)
│       └── wpcs
├── wp-cli.yml (WP-CLI config providing path to core)
└── wp-config-dist.php (WP-Config Distribution file)
```
