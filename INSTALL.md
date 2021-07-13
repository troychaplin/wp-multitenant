# WP Multitenant & Installation

## Multitenant Setup

AddDesc

- Clone repo into multitenant ***App Path***

#### Composer Install

AddDesc

- Duplicate `composer.example.json` and named it `composer.json`
- Open terminal and go to ***App Path*** and run `composer install`

#### Env Vars

AddDesc

- Duplicate `/config/env.example` and name it `.env`

TODO: add notes about items to change

## Site Installations

AddDesc

- Copy `/scripts/install.sh` to the root of the domain folder
- From the domain root run `bash install.sh`


ln -s /Users/troychaplin/Sites/wp-multitenant/config/.htaccess-standard ./.htaccess