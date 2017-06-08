# Simple example Yii2-ExtJS

A simple example work Yii2(advanced template) + ExtJS. Data validation occurs
only on the backend (Yii2), so most fields into frontend is textfield.

## Dependencies

You need install:
 * [Apache2](https://httpd.apache.org/download.cgi)
 * [MySQL](https://www.mysql.com/downloads/)
 * [Composer](https://getcomposer.org/download/)
 * [Sencha CMD](https://www.sencha.com/products/extjs/cmd-download/).

## How to use

```
$ git clone git@github.com:alles/Yii2-ExtJS
$ cd Yii2-ExtJS
$ composer install
$ mysql -u root -p -e "create database yii2_extjs"
$ mysql -u root -p -e "CREATE USER 'yii2_extjs'@'localhost' IDENTIFIED BY 'yii2_extjs'"
$ mysql -u root -p -e "GRANT ALL PRIVILEGES ON yii2_extjs.* TO 'yii2_extjs'@'localhost' WITH GRANT OPTION"
$ ./init --env=Development --overwrite=n
$ ./yii migrate --interactive=0
$ cd frontend
$ sencha app build
```

#### Apache config

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

    ErrorLog /path_to_folder/backend/runtime/logs/error-apache.log
    CustomLog /path_to_folder/backend/runtime/logs/access-apache.log combined
</VirtualHost>
```

And point your browser to http://yourhostname.