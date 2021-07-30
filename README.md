# WP Multitenant Overview

_Version 1.1.7_

A multi tenant application is an architectural concept in which a single instance of a piece of software is configured to serve multiple customers, often times called tenants. In a multi tenant WordPress environment, each tenant would share the same core configuration, themes, plugins, and more, while keeping its data and uploads as a separate entity.

This project intends to offer anyone the ability to run a small handful, or hundreds of individual WordPress installations using one core set of configuration files, making maintenance and updates a breeze.

For WP Multi Tenant to function it should sit at the same level (or higher) then the domain paths. It would look similar to the following.

```
/path_to_server
    |__ domain.com
    |__ example.com
    |__ demo.com
    |__ wp-multitenant
```

# Step 1: Multitenant Setup

The following are the steps to setup the wp-multitenant repo.

### Clone Repo

- Clone repo into multitenant `/path_to_server/wp-multitenant`

**Note:** You can not limited to using `wp-multitenant` in the path. Set that to whatever you want but be sure to change it in the `.env` file as shown in the next section.

### Env Vars

- Duplicate `/config/env.example` and name it `.env`
- Env vars that need updating are as follows:

| Env Variable    | Description                                                  |
| :-------------- | :------------------------------------------------------------|
| DB_USER         | Set databse username                                         |
| DB_PASSWORD     | Set database password                                        |
| DB_HOST         | Set database host (may not be required, localhost is common) |
| ENV_CURRENT_ENV | Set development environment                                  |
| ENV_BASE_SERVER | Set base server path (`/path_to_server`)                     |
| WP_ROOT_PATH    | Path to cloned repo `wp-multitenant`                         |

**Note:** If you cloned the repo into anything other than `wp-multitenant` change the reference in the `WP_ROOT_PATH`

### Composer Install

- Duplicate `composer.example.json` and named it `composer.json`
- Open terminal and from `/path_to_server/wp-multitenant` run `composer install`

**Note:** Additional information about working with composer can be found in the `technical docs` (coming soon)

# Step 2: Installing WordPress

This repo includes a simple installation script that will build the folder and folder structure and the create necessary symlinks.

### Install Script

- Duplicate `/scripts/install.example.sh` and name it `install.sh`
- Copy `/scripts/install.sh` to the root of the domain folder (ie: `/path_to_server/example.com`)
- Edit the copied `install.sh` file and change `path_to_multitenant` on lines 8, 10 and 12 to reflect your paths on various server setups
- From the domain folder run `bash install.sh local`

**Note:** when running the installer you are required to use `local`, `dev` or `prod`

# Multisite

If you choose yes to setting up multisite there are a couple of manual items to update:

- Edit your .env file on the server, look for `ENV_MULTISITE="false"` and change this to `ENV_MULTISITE="true"`
- Vist the admin of your site, under `Options` go to `Network Setup` and follow the instructions there.
- Once the network is setup, edit the `site-config.php` of your install and uncomment the constants that are labeled for multisite (lines 44-49)

----------------

# Additional Information

## Using Composer

Composer is a dependency manager for PHP and is used in wp-multitenant to manage versions of WordPress, themes, plugins, and more.

- `composer install` - install dependencies specified in the `composer.lock` file. If no lock file is found one will be created
- `composer update` - updated dependencies using versions specified in the `composer.json` file and generate a new lock file based

There are several [options](https://getcomposer.org/doc/03-cli.md) that can be used while running composer commands. 

- `--prefer-dist` - update dependencies without being git tracked and without interactive questions
- `--no-interaction` - do not ask any interactive question

It is possible to use several different composer files, like the following example:

- `COMPOSER=composer.dev.json composer update`

Resources for composer:

- [Composer documentation](https://getcomposer.org/)
- [Working with repos](https://getcomposer.org/doc/05-repositories.md)
- [Handling private repos](https://getcomposer.org/doc/articles/handling-private-packages.md)
- [WordPress packagist](https://wpackagist.org/)

## Server Overview

On the server each domain would typically have their own folder. The WordPress Multi Tenant Repo would live at the same level as each domain folder allowing it to be access by any domain or subfolder inside a domain.

In the example below `domain-one.com` shows how a main domain would look once fully configured while `domain-two.com` provides an example of how one or more subfolders can be used for site installations.

Symlinks are denoted with `==>`

```
domain-one.com
    |__ .htaccess ==> {server-path}/wp-multitenant/config/.htaccess-standard
    |__ index.php
    |__ site-config.php
    |__ wp ==> {server-path}/wp-multitenant/app/stable
    |__ wp-env.php ==> {server-path}/wp-multitenant/config/wp-env.php
    |__ wp-config.php
    |__ wp-content
    |  |__ mu-plugins ==> {server-path}/wp-multitenant/assets/mu-plugins
    |  |__ plugins ==> {server-path}/wp-multitenant/assets/plugins
    |  |__ themes ==> {server-path}/wp-multitenant/assets/themes
    |  |__ uploads


domain-two.com
    |__ site-folder
        |__ .htaccess ==> {server-path}/wp-multitenant/config/.htaccess-standard
        |__ index.php
        |__ site-config.php
        |__ wp ==> {server-path}/wp-multitenant/app/stable
        |__ wp-env.php ==> {server-path}/wp-multitenant/config/wp-env.php
        |__ wp-config.php
        |__ wp-content
        |  |__ mu-plugins ==> {server-path}/wp-multitenant/assets/mu-plugins
        |  |__ plugins ==> {server-path}/wp-multitenant/assets/plugins
        |  |__ themes ==> {server-path}/wp-multitenant/assets/themes
        |  |__ uploads

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
    |  |__ .htaccess-standard
    |  |__ wp-constants.php
    |  |__ wp-env.php
    |  |__ wp-cli.yml
    |__ composer.dev.json
    |__ composer.json
```

## Environment Variables

All environment variables can be found in `/config/.env`

| Env Variable       | Description                              |
| :----------------- | :--------------------------------------- |
| DB_USER            | Set the databse username                 |
| DB_PASSWORD        | Set the database password                |
| DB_HOST            | Set the database host                    |
| ENV_CURRENT_ENV    | Set development environment              |
| ENV_MULTISITE      | Enables multisite for server             |
| ENV_BASE_SERVER    | Set base server path                     |
| WP_ROOT_PATH       | Path to gitclone of `wp-multitenant`     |
| WP_STABLE_PATH     | Path to stable version of wp             |
| WP_ASSETS_PATH     | Path to wp themes and plugins            |
| WP_CONFIG_PATH     | Path to multi tenant configuration files |

## WordPress Constants

All global WordPress constants can be found in `/wp-multitenant/config/wp-constants.php`

**Note:** ** denotes items to not change this if in doubt

| WordPress Constants        | Description                           |
| :------------------------- | :------------------------------------ |
| DB_USER                    | Gets `DB_USER` from .env file         |
| DB_PASSWORD                | Gets `DB_PASSWORD` from .env file     |
| DB_HOST                    | Gets `DB_HOST` from .env file         |
| DB_CHARSET                 | Sets the database charset             |
| DB_COLLATE                 | Sets the database collate type        |
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
| CURRENT_DOMAIN       | Sets the folder structure to the install |
| WP_ALLOW_MULTISITE   | Allow Multiste (Multisite Only)          |
| MULTISITE            | Enable Multisite (Multisite Only)        |
| SUBDOMAIN_INSTALL    | Use Subdomains (Multisite Only)          |
| DOMAIN_CURRENT_SITE  | Domain (Multisite Only)                  |
| PATH_CURRENT_SITE    | Path to current (Multisite Only)         |
| SITE_ID_CURRENT_SITE | Site ID (Multisite Only)                 |
| BLOG_ID_CURRENT_SITE | Blog ID (Multisite Only)                 |

----------------

# Credit

Thanks to Mark Jaquith for the [base setup concept](https://gist.github.com/markjaquith/6225805) that helped bring this entire idea to life.