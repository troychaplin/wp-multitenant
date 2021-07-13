# Installing a Site

There are several things that we need to do to complete a WordPress installation.

### Database

Each site install requires it's own database. Creating one in Local by Flywheel is easy:

-   Select your site in the flywheel interface
-   Go to the database tab and click the `SEQUEL PRO` button
-   Use the drop down menu in the upper left corner and select `Add Database` and give it a name.
-   Make note of the name, as you will need it later

### Example Files

Each site needs three files:

-   `index.php`
-   `site-config.php`
-   `wp-config.php`

A copy of these files can be found in `wordpress/_install-files`. You'll be required to copy these files into your new installation, which will be referenced in the `Create a Site` section below.

### Create a Site

For the following instructions we'll create a demo site in a folder named `demo`.

**Note**: you can also install a site in the document root by skipping the folder creation step, and following the rest of the instructions.

-   Create a new folder called `demo` in `{{flywheel-install-folder}}/app/public`
-   Copy the three `_site_example` files into the `demo` folder
-   Edit the `site-config.php` file that you copied into the `demo` folder

### Editing the site-config.php File

There are a couple of items that will need to be updated for each site that you install. All changes exist in the `site-config.php` file, no changes are required in the other two files that were copied into the `demo` folder.

The changes are as follows:

-   `define( 'DB_NAME', 'db_name' );` - change the `db_name` constant to the name of the database you created
-   `define( 'WP_INSTALL_FOLDER', '' );` - add the install folder constant, see below for more info

Whule you can create any folder structure you want, but the three most common setups are as follows:

-   For root / subdomain installs: `define( 'WP_INSTALL_FOLDER', '' );`
-   For top level installs: `define( 'WP_INSTALL_FOLDER', 'demo' );`
-   For subsite installs: `define( 'WP_INSTALL_FOLDER', 'demo/subsite' );`

### .htaccess Options

If your environment requires an htaccess file, you must choose which type you want to use. The htaccess type will be used in the symlink section below. The htaccess types currently available are as follows:

-   `.htaccess-standard` - The basic for standard installs
-   `.htaccess-multisite` for all multisite installs

### Symlinks

To create symlinks you will need to SSH into your flywheel environment. To do this, right click on the local site in flywheel and click `Open site SSH`. From here, navigate to your `demo` installation folder (`cd app/public/demo`).

The following line will create a symlink from your `demo` site, pointing to the standard htaccess file. If you wish to use a different htaccess file, update the reference to `.htaccess-standard`. **Note:** if your flywheel environment uses nginx, you do not need to symlink to an htaccess file.

```
ln -s /app/wordpress/config/.htaccess-standard ./.htaccess
```

Once the htaccess symlink is created, we need to create additional symlinks:

```
mkdir wp-content
mkdir wp-content/uploads
ln -s /app/wordpress/config/.htaccess-standard ./.htaccess
ln -s /app/wordpress/config/wp-env.php ./wp-env.php
ln -s /app/wordpress/app/stable ./wp
ln -s /app/wordpress/assets/drop-ins/advanced-cache.php ./wp-content/advanced-cache.php
ln -s /app/wordpress/assets/drop-ins/object-cache.php ./wp-content/object-cache.php
ln -s /app/wordpress/assets/mu-plugins ./wp-content/mu-plugins
ln -s /app/wordpress/assets/plugins ./wp-content/plugins
ln -s /app/wordpress/assets/themes ./wp-content/themes
```

---

# Multisite Installs

To setup a multisite, follow the instructions as above to install your site. Once complete, follow these steps.

-   Edit your .env file on the server, look for `ENV_MULTISITE="false"` and change this to `ENV_MULTISITE="true"`
-   Revise your symlink to `.htaccess-standard` and ensure it is pointing to `.htaccess-multisite`
-   Vist the admin of your site, under "Options" go to "Network Setup" and follow the instructions there.
-   Once the network is setup, edit the `site-config.php` of your install and uncomment the constants that are labeled for multisite