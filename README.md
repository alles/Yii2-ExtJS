# Yii2-ExtJS

A simple example work Yii2(advanced template) + ExtJS.

## Dependencies

You need install:
 * [Composer](https://getcomposer.org/download/)
 * [Sencha CMD](https://www.sencha.com/products/extjs/cmd-download/).

## How to use

```
$ git clone git@github.com:alles/Yii2-ExtJS yii2-extjs
$ cd yii2-extjs
$ composer install
$ ./init --env=Development --overwrite=n
$ cd frontend
$ sencha app build
```

##### Apache config

```
<VirtualHost *:80>
    ServerName yourhostname

    ServerAdmin admin@yourhostname

    DocumentRoot /path_to_folder/frontend
    Alias /api /path_to_folder/backend/web
    Alias /requirements /path_to_folder/requirements.php

    <Directory /path_to_folder/backend/web>
        RewriteBase /api
        RewriteEngine On

        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d

        RewriteRule . index.php
    </Directory>
    <Directory /path_to_folder/frontend>
        RewriteBase /
        RewriteEngine On

        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d

        RewriteRule . index.php
    </Directory>

    ErrorLog /path_to_folder/backend/runtime/logs/error-apache.log
    CustomLog /path_to_folder/backend/runtime/logs/access-apache.log combined
</VirtualHost>
```

And point your browser to http://yourhostname.