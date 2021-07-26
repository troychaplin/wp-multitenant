# Check for defined environment
if [[ ! $1 ]]; then
    echo "--------------------------------------------------------------------"
    echo "You must specify your environment to continue (local, dev, prod)";
    echo "--------------------------------------------------------------------"
    exit 1;
elif [ "local" = $1 ]; then
  MULTITENANT_PATH=/path_to_multitenant
elif [ "dev" = $1 ]; then
  MULTITENANT_PATH=/path_to_multitenant
elif [ "prod" = $1 ]; then
  MULTITENANT_PATH=/path_to_multitenant
fi

# Set current path
PUBLIC_PATH=$PWD

# Set vars for parent level or second level sites
if [[ ! $2 ]]; then
    FOLDER_PATH=/
elif [[ ! $3 ]]; then
    FOLDER_PATH=/$2
    mkdir .$FOLDER_PATH
elif [ $3 ]; then
    FOLDER_PATH=/$2/$3
    mkdir .$FOLDER_PATH
fi

# Site Config Questions

echo -e "\n"
echo -e "What's your database name? "
read -r DATABASE_NAME
if [[ ! $DATABASE_NAME ]]; then
    echo "--------------------------------------------------------------------"
    echo "You must specify your databse name";
    echo "--------------------------------------------------------------------"
    exit 1;
fi

echo -e "\n"
echo -e "What's your domain name? "
read -r DOMAIN_NAME
if [[ ! $DOMAIN_NAME ]]; then
    echo "--------------------------------------------------------------------"
    echo "You must specify your domain name";
    echo "--------------------------------------------------------------------"
    exit 1;
fi

echo -e "\n"
echo -e "Do you want to use multisite? (y/n) "
read -r USE_MULTISITE
if [[ ! $USE_MULTISITE ]]; then
    echo "--------------------------------------------------------------------"
    echo "You must specify if you are using multisite or not";
    echo "--------------------------------------------------------------------"
    exit 1;
fi

# Make site directory
mkdir .$FOLDER_PATH/wp-content
mkdir .$FOLDER_PATH/wp-content/uploads

# Create htaccess symlinks
if [ "y" = $USE_MULTISITE ]; then
    ln -s $MULTITENANT_PATH/config/.htaccess-multisite .$FOLDER_PATH/.htaccess
elif [ "n" = $USE_MULTISITE ]; then
    ln -s $MULTITENANT_PATH/config/.htaccess-standard .$FOLDER_PATH/.htaccess
fi

# Create symlinks
ln -s $MULTITENANT_PATH/config/wp-cli.yml .$FOLDER_PATH/wp-cli.yml
ln -s $MULTITENANT_PATH/app/stable .$FOLDER_PATH/wp
ln -s $MULTITENANT_PATH/assets/drop-ins/advanced-cache.php .$FOLDER_PATH/wp-content/advanced-cache.php
ln -s $MULTITENANT_PATH/assets/drop-ins/object-cache.php .$FOLDER_PATH/wp-content/object-cache.php
ln -s $MULTITENANT_PATH/assets/mu-plugins .$FOLDER_PATH/wp-content/mu-plugins
ln -s $MULTITENANT_PATH/assets/plugins .$FOLDER_PATH/wp-content/plugins
ln -s $MULTITENANT_PATH/assets/themes .$FOLDER_PATH/wp-content/themes
ln -s $MULTITENANT_PATH/config/wp-env.php .$FOLDER_PATH/wp-env.php

# Copy install files
cp $MULTITENANT_PATH/_install-files/index.php $PUBLIC_PATH$FOLDER_PATH
cp $MULTITENANT_PATH/_install-files/wp-config.php $PUBLIC_PATH$FOLDER_PATH
cp $MULTITENANT_PATH/_install-files/site-config.php $PUBLIC_PATH$FOLDER_PATH/site-config-temp.php

# Modifying site-config
if [[ ! $2 ]]; then
    sed \
        -e "s/full_site_path//g" \
        -e "s/database_name/$DATABASE_NAME/g" \
        -e "s/domain_name/$DOMAIN_NAME/g" \
        ./site-config-temp.php > ./site-config.php
        rm $PUBLIC_PATH/site-config-temp.php
elif [[ ! $3 ]]; then
    sed \
        -e "s/full_site_path/$2/g" \
        -e "s/database_name/$DATABASE_NAME/g" \
        -e "s/domain_name/$DOMAIN_NAME/g" \
        ./$2/site-config-temp.php > ./$2/site-config.php
        rm $PUBLIC_PATH/$2/site-config-temp.php
elif [ $3 ]; then
    sed \
        -e "s/full_site_path/$2\/$3/g" \
        -e "s/database_name/$DATABASE_NAME/g" \
        -e "s/domain_name/$DOMAIN_NAME/g" \
        ./$2/$3/site-config-temp.php > ./$2/$3/site-config.php
        rm $PUBLIC_PATH/$2/$3/site-config-temp.php
fi

echo -e "\n--------------------------------------------------------------------\n"
echo -e "Config has been completed"
echo -e "Multitenant Path: $MULTITENANT_PATH"
echo -e "Public Path: $PUBLIC_PATH"
echo -e "Install Folder Path: $FOLDER_PATH"
echo -e "Database Name: $DATABASE_NAME"
echo -e "Domain Name: $DOMAIN_NAME"
echo -e "Configure Multisite: $USE_MULTISITE"
echo -e "\n--------------------------------------------------------------------\n"