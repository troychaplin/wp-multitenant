# WP Multi Tenant

This project is in development. Do not use this for anything more than a dev environment. Proper docs and a full release will be done at a later date.

## Getting Started

There are two key files that need to be modified to suit your environment.

The final files are not git tracked, so duplicate the following files and remove the `example` naming convention:

-   `composer.example.json` will be renamed to `composer.json`
-   `/app/.env.example` will be renamed to `/app/.env`

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
ln -s /app/wordpress/app/stable ./wp
ln -s /app/wordpress/assets/mu-plugins ./wp-content/mu-plugins
ln -s /app/wordpress/assets/plugins ./wp-content/plugins
ln -s /app/wordpress/assets/themes ./wp-content/themes
```

## Server Overview

At the server level, all the individual site install would exist at the htdocs level, or whatever your servers document root is. WordPress is kept a level higher, sitting just outside the htdocs, which makes it and any of it's plugins or themes inaccessible

```
htdocs
   |__ site-one
   |  |__ uploads
   |  |__ wp ==> /server-path/wordpress/app/stable
   |  |__ .htaccess ==> /server-path/wordpress/app/.htaccess
   |  |__ index.php
   |  |__ wp-config.php
   |  |__ subsite
   |  |  |__ uploads
   |  |  |__ wp ==> /server-path/wordpress/app/stable
   |  |  |__ .htaccess ==> /server-path/wordpress/app/.htaccess
   |  |  |__ index.php
   |  |  |__ wp-config.php
   |__ site-two
   |  |__ uploads
   |  |__ index.php
   |  |__ wp ==> /server-path/wordpress/app/stable
   |  |__ .htaccess ==> /server-path/wordpress/app/.htaccess
   |  |__ wp-config.php
wordpress
   |__ app
   |  |__ 4.9.10
   |  |__ 5.1.1
   |  |__ stable ==> /server-path/wordpress/app/5.1.1
   |  |__ .htaccess
   |  |__ wp-config.php
   |__ assets
   |  |__ mu-plugins
   |  |__ plugins
   |  |__ themes
   |__ config
   |  |__ constants.php
   |__ composer.json
```

## Credits and Thanks

Thanks to Mark Jaquith for the [base setup concept](https://gist.github.com/markjaquith/6225805)
