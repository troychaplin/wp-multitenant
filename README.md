# WP Multi Tenant

A multi tenant application is an architectural concept in which a single instance of a piece of software is configured to serve multiple customers, often times called tenants. In a multi tenant WordPress environment, each tenant would share the same core configuration, themes, plugins, and more, while keeping its data and uplodas as a separate entity.

This project intends to offer anyone the ability to run a small handful, or hundreds of individual WordPress installations using one core set of configuration files, making maintenance and updates a breeze.

**Note:** This project is in development. Do not use this for anything more than a dev environment. Proper docs and a full release will be done at a later date.

## Getting Started

There are two key files that need to be modified to suit your environment.

The final files are not git tracked, so duplicate the following files and remove the `example` naming convention:

-   `composer.example.json` will be duplicated and renamed to `composer.json`
-   `/config/.env.example` will be duplicated and renamed to `/config/.env`

## Updating with Composer

### Local by Flywheel Environment

Open a new terminal window and navigate to the `/app/wordpress' folder and run:

```
cd {{flywheel-install}}/app/wordpress
composer update
```

## Creating Symlinks

Using `Local by Flywheel` site configuration as an example, the following are a series of symlinks required for both server and individual site installs.

**Document Root**

```
ln -s /app/wordpress/config/wp-cli.yml ./wp-cli.yml
```

**Individual Sites**

```
ln -s /app/wordpress/config/.htaccess-standard ./.htaccess
ln -s /app/wordpress/config/wp-env.php ./wp-env.php
ln -s /app/wordpress/app/stable ./wp
mkdir wp-content
ln -s /app/wordpress/assets/drop-ins/advanced-cache.php ./wp-content/advanced-cache.php
ln -s /app/wordpress/assets/drop-ins/object-cache.php ./wp-content/object-cache.php
ln -s /app/wordpress/assets/mu-plugins ./wp-content/mu-plugins
ln -s /app/wordpress/assets/plugins ./wp-content/plugins
ln -s /app/wordpress/assets/themes ./wp-content/themes
```

## Server Overview

At the server level, all the individual site install would exist at the htdocs level, or whatever your servers document root is. WordPress is kept a level higher, sitting just outside the htdocs, which makes it and any of it's plugins or themes inaccessible

```
htdocs
   |__ site-install
   |  |__ .htaccess ==> {server-path}/wordpress/config/.htaccess-standard
   |  |__ wp-env.php ==> {server-path}/wordpress/config/wp-env.php
   |  |__ index.php
   |  |__ site-config.php
   |  |__ wp -> {server-path}/wordpress/app/stable
   |  |__ wp-config.php
   |  |__ wp-content
   |  |  |__ mu-plugins ==> {server-path}/wordpress/assets/mu-plugins
   |  |  |__ plugins ==> {server-path}/wordpress/assets/plugins
   |  |  |__ themes ==> {server-path}/wordpress/assets/themes
   |  |  |__ uploads

wordpress
   |__ app
   |  |__ stable
   |  |__ wp-config.php
   |__ assets
   |  |__ drop-ins
   |  |__ mu-plugins
   |  |__ plugins
   |  |__ themes
   |__ config
   |  |__ .env
      |__ .htaccess-standard
   |  |__ wp-constants.php
   |  |__ wp-env.php
   |  |__ wp-cli.yml
   |__ composer.dev.json
   |__ composer.json
```

## Credits and Thanks

Thanks to Mark Jaquith for the [base setup concept](https://gist.github.com/markjaquith/6225805)
