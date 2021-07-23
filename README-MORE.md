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

## WordPress Constants

All global WordPress constants can be found in `/wordpress/config/wp-constants.php`

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

----------------

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