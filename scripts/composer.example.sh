## Bedrock Autoloader for mu-plugins
cp _install-files/_wp-bedrock.php assets/mu-plugins/bedrock-autoloader.php
cp _install-files/_wp-silencer.php assets/plugins/index.php
cp _install-files/_wp-silencer.php assets/themes/index.php

## Redis Object Cache
cp assets/mu-plugins/redis-cache/includes/object-cache.php assets/drop-ins

## Redis Page Cache
cp assets/mu-plugins/pj-page-cache-red/advanced-cache.php assets/drop-ins