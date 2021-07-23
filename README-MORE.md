# WP Multitenant More Info

AddInfo

----------------

## Using Composer

AddInfo

-   `composer update --no-interaction --prefer-dist` - clean update using gitattribute files and not creating git tracked folders
-   `composer install --no-interaction --prefer-dist` - uses lock file for faster updated based on the same "update" command
-   `COMPOSER=composer.dev.json composer update --no-interaction --prefer-dist`

----------------

## Server Overview

On the server each domain would typically have their own folder. The WordPress Multi Tenant Repo would live at the same level as each domain folder allowing it to be access by any domain or subfolder inside a domain.

In the example below `domain-one.com` shows how a main domain would look once fully configured while `domain-two.com` provides an example of how one or more subfolders can be used for site installations.

Symlinks are denoted with `==>`

```
domain-one.com
    |__ .htaccess ==> {server-path}/wordpress/config/.htaccess-standard
    |__ index.php
    |__ site-config.php
    |__ wp ==> {server-path}/wordpress/app/stable
    |__ wp-env.php ==> {server-path}/wordpress/config/wp-env.php
    |__ wp-config.php
    |__ wp-content
    |  |__ mu-plugins ==> {server-path}/wordpress/assets/mu-plugins
    |  |__ plugins ==> {server-path}/wordpress/assets/plugins
    |  |__ themes ==> {server-path}/wordpress/assets/themes
    |  |__ uploads


domain-two.com
    |__ site-folder
        |__ .htaccess ==> {server-path}/wordpress/config/.htaccess-standard
        |__ index.php
        |__ site-config.php
        |__ wp ==> {server-path}/wordpress/app/stable
        |__ wp-env.php ==> {server-path}/wordpress/config/wp-env.php
        |__ wp-config.php
        |__ wp-content
        |  |__ mu-plugins ==> {server-path}/wordpress/assets/mu-plugins
        |  |__ plugins ==> {server-path}/wordpress/assets/plugins
        |  |__ themes ==> {server-path}/wordpress/assets/themes
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
        |__ .htaccess-standard
    |  |__ wp-constants.php
    |  |__ wp-env.php
    |  |__ wp-cli.yml
    |__ composer.dev.json
    |__ composer.json
```

----------------

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

----------------

## Heading

AddInfo

----------------

## Heading

AddInfo

----------------

## Heading

AddInfo

----------------

## Heading

AddInfo

----------------

## Heading

AddInfo

----------------

## Heading

AddInfo

----------------

## Heading

AddInfo

----------------

## Heading

AddInfo

----------------

## Heading

AddInfo

----------------

## Heading

AddInfo

----------------

## Heading

AddInfo

----------------

## Heading

AddInfo