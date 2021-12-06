<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Team
- Nick Koenig
- Jonathan Verhaegen
- Stephanie Lambrighs
- Nicolas van der Straten
  
## About
...
## How Envoy works

### SSH key
- Create keypair on laptop and copy to server:
  
    `ssh-keygen -t rsa -b 4096 -C "deploybot@server" -f /home/user/.ssh/id_rsa_deploybot`

- User was created without password so we can't use ssh-copy-id
    
    -> create authorized_keys manually
ssh@server

    ```sh
    cd /home/deploybot
    mkdir /home/deploybot/.ssh
    touch /home/deploybot/.ssh/authorized_keys
    chown deploybot:deploybot -R /home/deploybot/.ssh
    chmod 755 /home/deploybot/.ssh
    chmod 600 /home/deploybot/.ssh/authorized_keys 
    ```

- Edit and paste the generated public key:
  
  `nano  /home/deploybot/.ssh/authorized_keys`
- Copy and paste your private key in laravel project.
  Set this file in .gitignore. Don't forget!

### Using Envoy in Laravel
- Install Envoy:
  
  `./vendor/bin/sail composer require laravel/envoy --dev`
- Install composer to be sure:
  
  `./vendor/bin/sail composer install`
- Create a file in laravel project and name it: Envoy.blade.php
- Write your tasks for deployment in Envoy.blade.php
- Run envoy staging: 
  
  `./vendor/bin/sail php vendor/bin/envoy run deploy-staging`

- Run envoy production: 
  
  `./vendor/bin/sail php vendor/bin/envoy run deploy-production`

