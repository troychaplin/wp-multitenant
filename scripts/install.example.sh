# Check for defined environment
if [[ ! $1 ]]; then
    echo "--------------------------------------------------------------------"
    echo "You must specify your environment to continue (local, dev, prod)";
    echo "--------------------------------------------------------------------"
    exit 1;
elif [ "local" = $1 ]; then
  MULTITENANT_PATH=/app/wordpress
  PUBLIC_PATH=/app/public
elif [ "dev" = $1 ]; then
  MULTITENANT_PATH=/path_to_server
  PUBLIC_PATH=/app/public
elif [ "prod" = $1 ]; then
  MULTITENANT_PATH=/path_to_server
  PUBLIC_PATH=/app/public
fi

# Set vars for parent level or second level sites
if [[ ! $3 ]]; then
    FOLDER_PATH=$2
elif [ $3 ]; then
    FOLDER_PATH=$2/$3
fi

echo -e "\n--------------------------------------------------------------------\n"
echo -e "\n--------------------------------------------------------------------\n"
echo -e "Multi Tenant Path: $MULTITENANT_PATH"
echo -e "Install Folder Path: $FOLDER_PATH"
echo -e "\n--------------------------------------------------------------------\n"
echo -e "\n--------------------------------------------------------------------\n"

# Make site directory
mkdir ./$FOLDER_PATH
mkdir ./$FOLDER_PATH/wp-content

echo -e "\n--------------------------------------------------------------------\n"
echo -e "Directory for $FOLDER_PATH has been created"

# Copy install files
cp $MULTITENANT_PATH/_install-files/index.php $PUBLIC_PATH/$FOLDER_PATH
cp $MULTITENANT_PATH/_install-files/wp-config.php $PUBLIC_PATH/$FOLDER_PATH
cp $MULTITENANT_PATH/_install-files/site-config.php $PUBLIC_PATH/$FOLDER_PATH/site-config-tmp.php

# Modifying site-config
if [[ ! $3 ]]; then
    sed \
        -e "s/database_name/$2/g" \
        -e "s/full_site_path/$2/g" \
        ./$2/site-config-tmp.php > ./$2/site-config.php
        rm $PUBLIC_PATH/$2/site-config-tmp.php
elif [ $3 ]; then
    sed \
        -e "s/database_name/$2_$3/g" \
        -e "s/full_site_path/$2\/$3/g" \
        ./$2/$3/site-config-tmp.php > ./$2/$3/site-config.php
        rm $PUBLIC_PATH/$2/$3/site-config-tmp.php
fi

echo -e "\n--------------------------------------------------------------------\n"
echo -e "Install site files have been copied to $FOLDER_PATH"

# Create symlinks
ln -s $MULTITENANT_PATH/config/wp-cli.yml ./$FOLDER_PATH/wp-cli.yml
ln -s $MULTITENANT_PATH/config/.htaccess-standard ./$FOLDER_PATH/.htaccess
ln -s $MULTITENANT_PATH/app/stable ./$FOLDER_PATH/wp
ln -s $MULTITENANT_PATH/assets/drop-ins/advanced-cache.php ./$FOLDER_PATH/wp-content/advanced-cache.php
ln -s $MULTITENANT_PATH/assets/drop-ins/object-cache.php ./$FOLDER_PATH/wp-content/object-cache.php
ln -s $MULTITENANT_PATH/assets/mu-plugins ./$FOLDER_PATH/wp-content/mu-plugins
ln -s $MULTITENANT_PATH/assets/plugins ./$FOLDER_PATH/wp-content/plugins
ln -s $MULTITENANT_PATH/assets/themes ./$FOLDER_PATH/wp-content/themes
ln -s $MULTITENANT_PATH/config/db-config.php ./$FOLDER_PATH/db-config.php
ln -s $MULTITENANT_PATH/config/wp-env.php ./$FOLDER_PATH/wp-env.php

echo -e "\n--------------------------------------------------------------------\n"
echo -e "Symlinks for $FOLDER_PATH have been created"

# Create database
pushd $FOLDER_PATH
wp db create --allow-root
popd

echo -e "\n--------------------------------------------------------------------\n"
echo -e "Database for $FOLDER_PATH has been created and default has been imported"

rm install.sh

echo -e "\n--------------------------------------------------------------------\n"
echo -e "\e[92m\e[1mSite installation has successfully complete\n"
echo -e "\e[0m--------------------------------------------------------------------\n"