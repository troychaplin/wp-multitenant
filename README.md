# WP Multitenant Overview

_Version 1.1.2_

A multi tenant application is an architectural concept in which a single instance of a piece of software is configured to serve multiple customers, often times called tenants. In a multi tenant WordPress environment, each tenant would share the same core configuration, themes, plugins, and more, while keeping its data and uploads as a separate entity.

This project intends to offer anyone the ability to run a small handful, or hundreds of individual WordPress installations using one core set of configuration files, making maintenance and updates a breeze.

## 1. Server Overview

This repo is intended to live outside of where your domain exists. Typically a server might have a structure similar to this:

- `/path_to_server/example.com`
- `/path_to_server/sample.org`
- `/path_to_server/demo.ca`

The wp-multitenant repo is designed to live at:

- `/path_to_server/wordpress`

## 2. Multitenant Setup

AddDesc

### Clone Repo

- Clone repo into multitenant `/path_to_server/wordpress`

**Note:** you can are not limited to using `wordpress` in the path name, but be sure to also change it in the `.env` file as per the instructions below.

### Composer Install

AddDesc

- Duplicate `composer.example.json` and named it `composer.json`
- Update the file to include any plugins and/or themes you wish
- Open terminal and from `/path_to_server/wordpress` run `composer install`

### Env Vars

AddDesc

- Duplicate `/config/env.example` and name it `.env`

Items to change:

- `DB_USER` / `DB_PASSWORD` - Match these with your database credentials
- `DB_HOST` - This might not be required, localhost is commonly used
- `ENV_CURRENT_ENV` - Change to the environment you are configuring, this package currently supports `local`, `dev` and `prod`
- `ENV_BASE_SERVER` - Change to the path on your server where this repo exists (this excludes the repo name itself, ie: `wordpress`)
- `WP_ROOT_PATH` - If you changed the `wordpress` name when cloning the repo change its reference here 

## 3. Installing WordPress

AddDesc

### Install Script

AddDesc

- Duplicate `/scripts/install.example.sh` and name it `install.sh`
- Copy `/scripts/install.sh` to the root of the domain folder (ie: `/path_to_server/example.com`)
- From the domain folder run `bash install.sh local`

**Note:** when running the installer you are required to use `local`, `dev` or `prod`

### Update Site Config

In the domain folder you'll see a file named `site-config.php`, edit the following:

- `DB_NAME` - the name of the database for this installation of WordPress
- `CURRENT_DOMAIN` - the domain name for this installation

----------------

