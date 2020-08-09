# leadhack-backend
LeadHack Backend built-in [Symfony API](https://symfony.com/doc/current/index.html) which serves historical stock prices data for [LeadHack Frontend](https://github.com/rezehnde/leadhack-frontend).

See it in action: [https://leadhack-backend.rezehnde.com/](https://leadhack-backend.rezehnde.com/)

Send an JSON object in the format bellow to ```https://leadhack-backend.rezehnde.com/historical-data``` and _voilá_ (see the Google stock prices).
```
{
  "companySymbol": "GOOG",
  "startDate": "2020-08-01",
  "endDate": "2020-08-07",
  "email": "your_email_here"
}
```

## Deploy on Shared Server
1. Do this bellow inside your domain directory
```
git init
git remote add origin https://github.com/rezehnde/leadhack-backend.git
git pull origin master
composer update
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```
2. Point your domain directory to ```public```

## How to run locally (Docker is required)
```
mkdir leadhack-backend
git init
git remote add origin https://github.com/rezehnde/leadhack-backend.git
git pull origin master
docker-compose up -d --build leadhack
docker-compose run --rm composer update
docker-compose run --rm php bin/console doctrine:database:create
docker-compose run --rm php bin/console doctrine:migrations:migrate
```

## :triangular_ruler: Built with 

* [Symfony](https://symfony.com/) - PHP Framework
* [API Platform](https://api-platform.com/) - REST and GraphQL framework to build modern API-driven projects
* [Composer](https://getcomposer.org/) - A Dependency Manager for PHP
* [Docker](https://www.docker.com/) - Help developers and development teams build and ship apps.

## :trophy: Authors 

* **Marcos Rezende** - *Initial work* - [Software Engineer](https://github.com/rezehnde)
