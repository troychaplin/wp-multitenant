# WP Multitenant Overview

_Version 1.1.2_

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

Notes:

- You can are not limited to using `wp-multitenant` in the path, change it in the `.env` file as shown in the next section.

### Env Vars

- Duplicate `/config/env.example` and name it `.env`
- Env vars that need updating are as follows:

| Env Variable    | Description                                                   |
| :-------------- | :------------------------------------------------------------ |
| DB_USER         | Set databse username                                          |
| DB_PASSWORD     | Set database password                                         |
| DB_HOST         | Set database host (may not be required, localhost is common)  |
| ENV_CURRENT_ENV | Set development environment                                   |
| ENV_BASE_SERVER | Set base server path (excludes `wp-multitenant` clone folder) |
| WP_ROOT_PATH    | Path to gitclone of `wp-multitenant`                          |

Notes:

- `ENV_BASE_SERVER` - Change to the path on your server where this repo exists (this excludes the repo name itself, ie: `wordpress`)
- `WP_ROOT_PATH` - If you changed the `wordpress` name when cloning the repo change its reference here 

### Composer Install

- Duplicate `composer.example.json` and named it `composer.json`
- Update the file to include any plugins and/or themes you wish
- Open terminal and from `/path_to_server/wordpress` run `composer install`

Notes:

- Additional information about working with composer can be found in the `technical docs` (coming soon)

# Step 2: Installing WordPress

AddIntro

### Install Script

- Duplicate `/scripts/install.example.sh` and name it `install.sh`
- Copy `/scripts/install.sh` to the root of the domain folder (ie: `/path_to_server/example.com`)
- From the domain folder run `bash install.sh local`

**Note:** when running the installer you are required to use `local`, `dev` or `prod`

### Update Site Config

In the domain folder you'll see a file named `site-config.php`, edit the following:

- `DB_NAME` - the name of the database for this installation of WordPress
- `CURRENT_DOMAIN` - the domain name for this installation

----------------

