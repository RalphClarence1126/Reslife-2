# Prototype Website

> Made by: TVL-ICT Grade&nbsp;12&nbsp;-&nbsp;Jobs Group&nbsp;2 students

## Pre-requisites

- PHP 7.1.33 *(or higher)*
  - Cookies enabled
- MySQL 5.7.19 *(or higher)*

## Testing & Development

### PHP

For systems without apache: `$ php -S localhost:8170`

For systems with apache: `$ sudo apachectl start` or `$ sudo apachectl -k start`

### MySQL

#### Initial database setup

```bash
Host: 127.0.0.1
Username: root
Password: newpassword
```

#### Database configuration

> Check the config file in `database/config.php` (Change the credentials as necessary)

```bash
DB_SERVER: 127.0.0.1
DB_USERNAME: root
DB_PASSWORD: newpassword
DB_NAME: prototype
```
