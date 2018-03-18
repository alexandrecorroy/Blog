# PHP Blog in POO

A php blog for an openclassrooms project !

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

### Installing

A step by step series of examples that tell you have to get a development env running

1. Install blog.sql in your database.

2. Upload project in your server

3. Run Composer Update

```
Composer Update
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

## Sensiolabs Insight

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/f82b0161-33f0-487f-81fe-0fb61edf3b75/big.png)](https://insight.sensiolabs.com/projects/f82b0161-33f0-487f-81fe-0fb61edf3b75)

## License

This project is licensed under GPL License.
