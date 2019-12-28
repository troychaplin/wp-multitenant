# WP Multi Tenant

_Version 1.1.2_

A multi tenant application is an architectural concept in which a single instance of a piece of software is configured to serve multiple customers, often times called tenants. In a multi tenant WordPress environment, each tenant would share the same core configuration, themes, plugins, and more, while keeping its data and uploads as a separate entity.

This project intends to offer anyone the ability to run a small handful, or hundreds of individual WordPress installations using one core set of configuration files, making maintenance and updates a breeze.

---

# Getting Started

The following guide will walk your through setting up a WordPress multitenant environment using Local by Flywheel, but these instructions can be easily changed and adapted to function on just about any other local development setup, or a dev, staging or production server.

For making changes to fit your development or production environment, the most important things to note is that all sites are installed in the document root, while the contents of this repo and all associated files that you may add will sit at the same level as the document root.

Using a local by flywheel environment as an example:

-   Document Root: `{{flywheel-install-folder}}/app/public`
-   Multitenant App: `{{flywheel-install-folder}}/app/wordpress`

---

# Local by Flywheel Configuration

The setup docs will be split up into two sections. First we'll cover setting up the flywheel environment and configuring the multitenant application. Then we'll take a look at setting up a new WordPress installation, which is comprised of several steps.

## Setting Up the Environment

Create a new local site in flywheel. You may call it whatever you want, and give it whatever domain you want. Make a note of the domain name, and the local folder you assign to the site, this will be referred to as `{{flywheel-install-folder}}` from this point forward.

You are required to use a minimum of PHP 7.0.3, but I would recommend using the lastest version that Flywheel offers. You can choose either nginx or apache, both will work fine. If you choose nginx, you won't need an htaccess file, which will be noted again later in this doc.

Once the flywheel environment creation is done, open a new terminal window, and use the following series of commands to create a clean public folder (this is the document root where all the site install will live), clone the `wp-multitenant` repo, and create your `composer.json` and `.env` files, and as a final step, run composer to build your WordPress app and assets structure.

```
cd {{flywheel-install-folder}}/app/
rm -rf public
mkdir public
git clone git@github.com:troychaplin79/wp-multitenant.git wordpress
cd wordpress
cp composer.example.json composer.json
cp config/.env.example config/.env
cp scripts/install.example.sh scripts/install.sh
composer update
```

Once the composer update has finished, navigate to the `config` folder and edit the `.env` to change `ENV_CURRENT_DOMAIN` to the domain you provided when setting up you.

### Other Composer Commands

-   `composer update --no-interaction --prefer-dist` - clean update using gitattribute files and not creating git tracked folders
-   `composer install --no-interaction --prefer-dist` - uses lock file for faster updated based on the same "update" command
-   `COMPOSER=composer.dev.json composer update --no-interaction --prefer-dist`

## Installing a Site

This package comes with a shell script that provides a quick and easy way to install top level (eg: .ca/site) or second level (eg: .ca/site/secondary) sites.

**Note:** this scipt currently only allows for top and second level site installations, it **does not** handle installations at the document root. This will be address in a future release, but in the meantime, the old instructions for all levels of site installs can be found in the INSTALL.md file. Multisite configuration instructions can also be found in this doc.

To install a new site, SSH into the root of the file server and run the following command. Information about the available variables can be found below.

```
cp ../wordpress/scripts/install.sh ./
bash install.sh environment parentpath childpath
```

- `environment` - use: local, dev, or prod
- `parentpath` - top level site install folder
- `childpath` - second level site install folder (optional)

---

## Server Overview

At the server level, all the individual site install would exist at the htdocs level, or whatever your server document root is. WordPress is kept a level higher, sitting just outside the htdocs, which makes it and any of it's plugins or themes inaccessible.

Symlinks are denoted with `==>`

```
htdocs
   |__ site-install
   |  |__ .htaccess ==> {server-path}/wordpress/config/.htaccess-standard
   |  |__ index.php
   |  |__ site-config.php
   |  |__ wp ==> {server-path}/wordpress/app/stable
   |  |__ wp-env.php ==> {server-path}/wordpress/config/wp-env.php
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

---

# Environment Variables and Constants

There are several environment variables and constants used throughout the multitenant application. The following is a list of what vars and constants exist, and what they do.

## Environment Variables

All environment variables can be found in `/wordpress/config/.env`

| Env Variable       | Description                              |
| :----------------- | :--------------------------------------- |
| DB_USER            | Set the databse username                 |
| DB_PASSWORD        | Set the database password                |
| DB_HOST            | Set the database host                    |
| ENV_CURRENT_ENV    | Set development environment              |
| ENV_CURRENT_DOMAIN | Set domain name                          |
| ENV_MULTISITE      | Enables multisite for server             |
| ENV_BASE_SERVER    | Set base server path                     |
| ENV_PUBLICPATH     | Add public path to `ENV_BASE_SERVER`     |
| WP_ROOT_PATH       | Path to gitclone of `wp-multitenant`     |
| WP_STABLE_PATH     | Path to stable version of wp             |
| WP_ASSETS_PATH     | Path to wp themes and plugins            |
| WP_CONFIG_PATH     | Path to multi tenant configuration files |

## WordPress Constants

All global WordPress constants can be found in `/wordpress/config/wp-constants.php`

| WordPress Constants        | Description                           |
| :------------------------- | :------------------------------------ |
| DB_USER                    | Gets `DB_USER` from .env file         |
| DB_PASSWORD                | Gets `DB_PASSWORD` from .env file     |
| DB_HOST                    | Gets `DB_HOST` from .env file         |
| DB_CHARSET                 | Default from `wp-constants.php`       |
| DB_COLLATE                 | Default from `wp-config`              |
| WP_INSTALL_DIR             | Sets path to the current installation |
| WP_INSTALL_URL             | Sets URL to the current installation  |
| WP_HOME                    | Sets URL in wp_options                |
| WP_SITEURL                 | Sets URL in wp_options                |
| WP_CONTENT_DIR             | Sets path for wp-content folder       |
| WP_CONTENT_URL             | Sets URL for wp-content folder        |
| WP_PLUGIN_DIR              | Sets path for plugins folder          |
| WP_PLUGIN_URL              | Sets URL for plugins folder           |
| WPMU_PLUGIN_DIR            | Sets path for mu-plugins folder       |
| WPMU_PLUGIN_URL            | Sets URL for mu-plugins folder        |
| WP_DEBUG                   | Sets debug options                    |
| WP_DEBUG_LOG               | Sets option to create debug log       |
| WP_DEBUG_DISPLAY           | Sets option to display debug errors   |
| WP_CACHE                   | Enables or disabled cache             |
| WP_CACHE_KEY_SALT          | Creates a unique cache key per site   |
| WP_REDIS_DISABLED          | Enables or disables redis             |
| WP_REDIS_SELECTIVE_FLUSH   | Allows individual site flushes        |
| WP_REDIS_MAXTTL            | Max TTL for redis                     |
| FORCE_SSL_ADMIN            | Force HTTPS on admin                  |
| FORCE_SSL_LOGIN            | Force HTTPS on login                  |
| AUTOMATIC_UPDATER_DISABLED | Disable auto-update                   |
| DISALLOW_FILE_EDIT         | Disable theme and plugin file edits   |
| AUTOSAVE_INTERVAL          | Sets the time for auto-save           |
| WP_POST_REVISIONS          | Sets maxiumum post revisions          |
| EMPTY_TRASH_DAYS           | Empty trash after X days              |
| ADMIN_COOKIE_PATH          | Sets admin cookie URL path            |
| COOKIE_DOMAIN              | Sets domain for cookies               |
| COOKIEPATH                 | Sets general cookie path              |
| SITECOOKIEPATH             | Sets specific site cookie             |

## Site Install Constants

All site specific constants can be found in `site-config.php` for each individual site installation.

| PHP Constants        | Description                              |
| :------------------- | :--------------------------------------- |
| DB_NAME              | Sets the database name                   |
| WP_INSTALL_FOLDER    | Sets the folder structure to the install |
| WP_ALLOW_MULTISITE   | Allow Multiste (Multisite Only)          |
| MULTISITE            | Enable Multisite (Multisite Only)        |
| SUBDOMAIN_INSTALL    | Use Subdomains (Multisite Only)          |
| DOMAIN_CURRENT_SITE  | Domain (Multisite Only)                  |
| PATH_CURRENT_SITE    | Path to current (Multisite Only)         |
| SITE_ID_CURRENT_SITE | Site ID (Multisite Only)                 |
| BLOG_ID_CURRENT_SITE | Blog ID (Multisite Only)                 |

---

## Credits and Thanks

Thanks to Mark Jaquith for the [base setup concept](https://gist.github.com/markjaquith/6225805) that helped bring this entire idea to life.
