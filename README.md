# PHP Blog in POO

A php blog for an Openclassrooms project !

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

What things you need to install the software and how to install them

```
php version >= 7
```
```
composer
```
```
SMTP server
```
```
PhpMyAdmin
```
```
Google captcha keys
```

Free SMTP Server : http://sendinblue.com

Google Captcha : https://www.google.com/recaptcha/admin

Download Composer : https://getcomposer.org/download/

### Installing

A step by step series of examples that tell you have to get a development env running

1. Import blog.sql in your database. (a new database name "blog" will be create)

2. Upload project in your server

3. Run Composer

```
Composer install
```

Then rename "template_config.json" to "config.json" and change values :

```
// replace with your db info
{
  "db": {
    "host": "localhost",
    "dbname": "blog",
    "username": "root",
    "password": ""
  },
//  require for send emails
  "smtp": {
    "host": "",
    "port": "",
    "username": "",
    "password": ""
  },
//  require for new user (go to https://www.google.com/recaptcha/intro/index.html)
  "captcha": {
    "secret": "your_google_captcha_secret_key",
    "public": "your_google_captcha_public_key"
  }
}
```

See demo : http://www.alexandrecorroy.fr/blog/

## Secure config.json / folders

You can create .htaccess file to secure access to config.json and folders

```
Options -Indexes
<files "config.json">
Order allow,deny
Deny from all
</files>
```

## Sensiolabs Insight

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/f82b0161-33f0-487f-81fe-0fb61edf3b75/big.png)](https://insight.sensiolabs.com/projects/f82b0161-33f0-487f-81fe-0fb61edf3b75)

## License

This project is licensed under GPL License.
