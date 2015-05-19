# wp-nginx
Testing

Assuming you already have the necessary tools in place, you could…  

```
git clone thisproject
cd thisproject/
git flow init
git branch --set-upstream-to=origin/develop develop
git pull
git st
vagrant up
vagrant ssh
cd /var/www/
composer update
# visit http://nginx-project.dev in your browser
```

*(Note : there is a composer install hook in the guest vm. It does successfully install wp and plugins on first vagrant up, but it appears to have difficulty installing phpdoc, phpmd, phpcs, phpunit, wpcs, and wp-cli successfully)*

## Project Philosophy:

Vagrant / Puppet will be used as a local development environment. The Vagrant box for this project was configured to use Nginx.

All publicly available, installable PHP packages (read: core, plugin, theme) are managed with [Composer](https://getcomposer.org/ "Dependency Manager for PHP"). Use [Composer](https://getcomposer.org/ "Dependency Manager for PHP") to [require](https://getcomposer.org/doc/01-basic-usage.md#the-require-key "Composer require documentation"), [install](https://getcomposer.org/doc/03-cli.md#install "Composer install documentation"), and [update](https://getcomposer.org/doc/03-cli.md#update "Composer update documentation") any and all publicly available plugins, themes, and [WordPress](https://wordpress.org/ "The home of WordPress") Core itself *(or any available [Composer package](https://packagist.org/ "The Composer Packagist repo") for that matter).* Nearly every [plugin](https://wordpress.org/plugins/ "WordPress.org plugin directory") and [theme](https://wordpress.org/themes/ "WordPress.org theme directory") available from [WordPress.org](https://wordpress.org/ "The home of WordPress") has been packaged and can be downloaded from [WordPress Packagist](http://wpackagist.org/ "A mirror of the WordPress plugin and theme directories as a Composer repository"). Add the required plugins and themes to your composer.json using wpackagist-plugin or wpackagist-theme as the “vendor,” and the [plugin](http://plugins.svn.wordpress.org/ "WordPress Official plugin SVN repo") or [theme](http://themes.svn.wordpress.org/ "WordPress Official theme SVN repo") slug for the “package” in the format of ```"vendor/package" : "version"```. For example, [Advanced Custom Fields](http://wordpress.org/plugins/advanced-custom-fields/) would be added to composer.json in the format of ```"wpackagist-plugin/advanced-custom-fields" : "4.4.1"```.

### __Publicly available plugins/themes, and uploads, are *not* stored in the repo!__

Any plugin or theme or package that is "publicly available" via a [Composer](https://getcomposer.org/ "Dependency Manager for PHP") package, __*should not*__ be stored in the repo.
[Composer](https://getcomposer.org/ "Dependency Manager for PHP") can manage those publicly available packages for us, where versioning can be controlled via the composer.json file.

Uploads, which are user uploaded images and binary files *should not* be stored in the repo.
Storing, uploading, and downloading a 1+ GB repo is ridiculous. Uploads are content, they are something that can be zipped up and deployed via scp or sftp or some other method. And remember, Version Control ≠ Backups.

### __Custom or premium code, plugins and themes *should* be stored in the repo!__

Any custom (built by our team) or premium (purchased) theme or plugin __*should*__ be stored in the repo.
By default our gitignore will basically ignore nearly everything in the plugins, themes, and uploads folders.
Therefore custom and premium code needs to be __*WHITELISTED*__ in the .gitignore. Remember that, it's important.

### Coding Standards

[PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) (also known by it's command line name of phpcs) will be used to reinforce consistent code style.

[WordPress Coding Standards](http://codex.wordpress.org/WordPress_Coding_Standards) will be followed as closely as possible. [WordPress Coding Standards PHPCS rules](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards) will be used in code inspections to ensure that coding standards of WordPress-Extra to WordPress-VIP levels are followed.

The WordPress Coding Standards are installed in this project via Composer.  
[See WordPress Installation Preparation](#WordPress-Installation-Preparation) later in this document for more information regarding Composer spin-up.

The WordPress Coding Standards can be accessed from your Host machine (local) at  
(your/path/to/project/)vendor/wp-coding-standards/wpcs

The WordPress Coding Standards can be accessed from your Guest machine (Vagrant) at  
/var/www/vendor/wp-coding-standards/wpcs

The WordPress Coding Standards installed are  
WordPress — all of the sniffs in the project.  
WordPress-Core — sniffs that seek to implement the WordPress core coding standards and go no further.  
WordPress-Extra — WordPress-Core plus extra best practices sniffs, which are not part of core coding standards and could be controversial.  
WordPress-VIP — WordPress-Core plus sniffs that seek to implement the WordPress VIP coding requirements.

For more information on implementing WordPress Coding Standards with PHPCS, refer to the [project page on GitHub.](http://codex.wordpress.org/WordPress_Coding_Standards)  
For more information regarding PhpStorm's PHPCS integrations, refer to [PHP Code Sniffer in PhpStorm](https://confluence.jetbrains.com/display/PhpStorm/PHP+Code+Sniffer+in+PhpStorm), and [Using PHP Code Sniffer Tool](https://www.jetbrains.com/phpstorm/help/using-php-code-sniffer-tool.html).  
For more information on implementing WordPress Coding Standards in PhpStorm, refer to [Rarst's writeup on WordPress development in PhpStorm.](http://www.rarst.net/wordpress/in-phpstorm/)  

## Project Setup:

### Version Control Preparation

1. Ensure you have installed [Gitflow](https://github.com/nvie/gitflow/wiki/Installation).
1. Clone this project: `git clone thisproject`
1. Move to the project directory: `cd thisproject`
1. Initialize gitflow: `git flow init`
1. Set local develop branch to track remote: `git branch --set-upstream-to=origin/develop develop`
1. Ensure you have latest code changes: `git pull`
1. Ensure your local branch is not dirty: `git st`

You should now be on a clean develop branch with nothing to commit, and your local develop branch should be tracking the remote develop branch.

### Local Development Server Environment Preparation

1. Ensure you have installed [VirtualBox 4.3.x](https://www.virtualbox.org/wiki/Downloads).
    * Note: This step *is required*.
    * VirtualBox is a virtualization software package. The application allows a Host machine to run guest operating systems, each within its own virtual environment.
1. Ensure you have installed [Vagrant 1.6.x](http://www.vagrantup.com/downloads.html).
    * Note: This step *is required*.
    * Vagrant is software for creating and configuring virtual development environments. It can be described as a wrapper around virtualization software such as VirtualBox.
1. Install the [vagrant-bindfs](https://github.com/gael-ian/vagrant-bindfs) Vagrant plugin:
    `vagrant plugin install vagrant-bindfs`.
    * Note: This step *is required*.
    * vagrant-bindfs automates bindfs mounts in the guest system. This allows you to change owner, group and permissions on files and work around NFS share permissions issues.
1. Install the [vagrant-vbguest](https://github.com/dotless-de/vagrant-vbguest) Vagrant plugin:
    `vagrant plugin install vagrant-vbguest`.
    * Note: This step *is not required*.
    * vagrant-vbguest automates installation of the host's VirtualBox Guest Additions on the guest system.
1. Install the [vagrant-hostsupdater](https://github.com/cogitatio/vagrant-hostsupdater) Vagrant plugin:
    `vagrant plugin install vagrant-hostsupdater`.
    * Note: This step *is not required*.
    * vagrant-hostsupdater automates the addition of the guest system’s domain to your host system’s `/etc/hosts` file.
    * If you choose not to install vagrant-hostsupdater, you will need to manually add an entry to your host system’s `/etc/hosts` file: `192.168.56.101  nginx-project.dev`.
1. Initialize the Vagrant environment `vagrant up`
    * The initial `vagrant up` will take some time as your machine downloads the required vagrant box files, then installs the required packages in the guest.
    * When prompted, enter your administrator credentials.

Upon success, you will have a guest Linux environment running Ubuntu 14, NGINX 1.8.0, PHP 5.6.8, and MySQL 5.6.22. This will act as your local dev server for the project. MAMP/WAMP/XAMP/ETC not required, and discouraged.

### WordPress Installation Preparation

1. Ensure you have installed [Composer](https://getcomposer.org/download/).
    * Note: This step *is required*.
    * Composer is a dependency manager for PHP that provides a standard format for managing dependencies and required libraries.
1. Ensure you have installed [WP-CLI](http://wp-cli.org/).
    * Note: This step *is not required*.
    * WP-CLI is a set of command-line tools for managing WordPress installations.
1. Install the [WordPress](https://wordpress.org/ "The home of WordPress") stack via Composer: `composer install --dev` (if composer install failed to run on vagrant up) or `composer update` (if composer install successfully ran on vagrant up).
    * Composer will connect to Packagist and WPackagist repositories and download the required libraries, plugins, and WordPress Core.

#### WordPress Database Install

Until we have DB dump/import hooks ready, manual installation of the WordPress database will be required. This can be accomplished with WP-CLI inside the dev guest server environment, or by visiting the dev site in the browser.

```
# Log in to the Vagrant box

$ vagrant ssh

# Go to the webroot

$ cd /var/www/html

# Copy wp-config-dist

$ cp wp-config-dist.php wp-config.php

# update wp-config.php settings if necessary

# Install the MySQL tables for WordPress

$ wp core install --url='http://nginx-project.dev' --title='PROJECT TITLE' --admin_user='SomeAdminName' --admin_password='SomeSuperSecretPasswordThatIHaventDecidedOn' --admin_email='me@example.com'

```

Upon success, you may visit your dev site at [http://nginx-project.dev/](http://nginx-project.dev/), and you may log into the WordPress dashboard at [http://nginx-project.dev/wp/wp-login.php](http://nginx-project.dev/wp/wp-login.php).

#### Installation Structure

Only specific areas of interest in the installation structure are noted here.

```
├── composer.json      (Composer package manifest)
├── composer.lock      (lock file to sync package versions across team)
├── bin                (Binaries installed by Composer, such as PHPCS)
├── html               (Apache web root)
│   ├── wp             (WordPress Core)
│   ├── wp-config.php  (WP Config File)
│   └── wp-content     (WP Content dir, holds themes, plugins, uploads)
│       └── debug.log  (WP Debug Logging)
├── puphpet
│   └── config.yaml    (For VM Package Configuration https://puphpet.com/)
├── vendor             (Composer autoload libraries)
│   ├── composer
│   │   └── installers (Enables Composer to install WP plugins and themes)
│   └── johnpbloch
│       └── wordpress-core-installer (install WP Core to specified dir)
└── wp-cli.yml         (WP-CLI config for project)

```

The installation structure puts WordPress into it's own directory, "wp," which resides in the webroot.

The "wp-content" directory, which resides in the webroot, is where plugins, themes, and uploads are stored.

The "vendor" directory located in the project root is managed by Composer, and stores libraries for the project. These libraries may include installer scripts, deployment scripts, or other libraries that are dependencies of the project. You should not need to modify the vendor directory, that is part of Composer's job.

#### Production Plugins Included

Production plugins have not been finalized yet.  
Plugins listed here are the current, initial thoughts on which plugins to use for production.  
Expect this list to change during the course of development.

List of plugins and links to plugin home / docs

#### Development Plugins Included

This list of dev plugins will change when requirements are finalized, at which point it will become clearer what types of dev plugins will be most useful for development and debugging.

List of plugins and links to plugin home / docs

#### MU Plugins

This installation comes with 2 MU Plugins.

Register Theme Directory registers the core/wp-content/themes directory as an ADDITIONAL theme directory. This prevents the white screen of death that often occurs when spinning up a brand spankin’ new WP site with VCS friendly structure. Completely stolen from [WordPress Core Lead Dev Mark Jaquith’s](https://github.com/markjaquith) [WordPress Skeleton project](https://github.com/markjaquith/WordPress-Skeleton). This plugin won't cause any problems if deployed to production, but isn't necessary on production.

Jetpack Development Mode defines the JETPACK_DEV_DEBUG constant. This puts the Jetpack plugin into development mode, and enables all features that do not require a connection to WPCOM. Completely stolen from [Voce Platforms](https://github.com/voceconnect/jetpack_development_mode). This plugin should not be deployed to production, so plan accordingly.

## Theme Development

The theme will be coded to meet WordPress Extra to WordPress VIP coding standards.

The theme will be based on _s from Automattic.

The theme will use jQuery JS where necessary.

The theme will use Sass preprocessor to compile CSS.

The theme will be developed to [WPTRT guidelines](https://make.wordpress.org/themes/handbook/guidelines/). 

The theme will be periodically checked with [Theme Check](https://make.wordpress.org/themes/handbook/guidelines/theme-check/) during development to ensure that major theme requirements and recommendations are met. 

Standard [WordPress Theme Unit Test Data](https://codex.wordpress.org/Theme_Unit_Test) will be used during the course of development to ensure that the theme displays properly and handles content edge cases gracefully.

### Sass Watch
To allow Sass to watch .scsss files for edits and compile automagically, cd to the theme directory and run :  
```sass --watch sass/style.scss:style.css```

### PhpStorm Sass File Watcher
To allow PhpStorm to watch .scsss files for edits and compile automagically, go Preferences → Tools → File Watchers  
Add a new SCSS File Watcher, with the following Arguments :  
```--no-cache --update $FileName$:../$FileNameWithoutExtension$.css```
(you may need to exclude directories of other themes/plugins in the project settings)

### Chrome .scss Live Editing
To enable Chrome's sourcemap support, refer to the following articles :  
[http://thesassway.com/intermediate/using-source-maps-with-sass](http://thesassway.com/intermediate/using-source-maps-with-sass)  
[https://developer.chrome.com/devtools/docs/workspaces](https://developer.chrome.com/devtools/docs/workspaces)  
This can allow you to make live edits to the source scss files directly in Chrome Inspector, and see the results reloaded in Chrome.

## Connecting to Dev Database

The preferred way to connect to the dev database is using [MySQL Workbench](https://dev.mysql.com/downloads/workbench/).

Download and install [MySQL Workbench](https://dev.mysql.com/downloads/workbench/) for your platform (MySQL Workbench is available for NIX, Mac, and Win platforms).

Create a connection using "Standard TCP/IP over SSH," the SSH Hostname is "nginx-project.dev:22", the SSH Username is "vagrant", do not enter an SSH password, the SSH Key File to use is located at (/path/to/your/project/)puphpet/files/dot/ssh/id_rsa. The MySQL Hostname is "localhost", the MySQL Server Port is "3306", the MySQL Username is "root", the password is "123".

The SSH Key File is generated after your initial $ vagrant up.

## Issue Tracking

Link to issue tracker

## Known Issues

None at this time.

## Roadmap

Build hook for db import on vagrant up.

Potentially build hook for db export on vagrant halt.

Explore deployment tool options (Capistrano? Vagrant deploy?).

Scaffold a starter theme with sassified _s.

Finalize decisions on plugins.

Future enhancements?

## Deployment Notes

Upon deployment, be sure to change the values in wp-config.php to match the production environment.
Values that should be adjusted include :  

* WP_HOME
* DB_NAME
* DB_USER
* DB_PASSWORD
* DB_HOST
* $table_prefix
* AUTH_KEY
* SECURE_AUTH_KEY
* LOGGED_IN_KEY
* NONCE_KEY
* AUTH_SALT
* SECURE_AUTH_SALT
* LOGGED_IN_SALT
* NONCE_SALT

DO NOT use the same db creds, salts and keys on production as in dev.  
They absolutely must be unique.

1. Delete all non-essential user accounts.  
1. Ensure all remaining accounts have good usernames (not admin) and strong passwords.  
1. Follow the Hardening WordPress guide.  

## Team Members

Lead Dev: 
ETC.....

### References:
