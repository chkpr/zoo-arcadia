<p>
  <img src="https://github.com/user-attachments/assets/b864d49f-b95b-4ccc-9596-1e9708883a96" width="33%" alt="Zoo Arcadia Homepage hero"/>
  <img src="https://github.com/user-attachments/assets/5670352f-8d59-455e-9fa4-d40691825a67" width="33%"alt="Zoo Arcadia homepage - presentation of the zoo and zoo map"/>
  <img src="https://github.com/user-attachments/assets/c5e953bf-ccae-4d03-add1-aa7c03fc87bd" width="33%"alt="Zoo Arcadia homepage - presentation of the zoo habitats"/>
</p>

# Zoo Arcadia

Web application for the management of Zoo Arcadia, built with Symfony 7.1 and a dual database architecture (MySQL + MongoDB).

This project was developed as part of Studi's Graduate Web Developer program.

## Features

- Public-facing pages: animal profiles, habitats, services, contact form
- Three distinct user roles with dedicated interfaces:
  -**Admin**: full management of animals, habitats, services, users and reviews via EasyAdmin
  -**Employe**: manages visitor reviews and animal feeding records
  -**Vet**: logs veterinary visits and health reports for each animal
- Animal consultation statistics tracked in MongoDB
- Image upload management with VichUploader
- Contact form with email notifications via Symfony Mailer
- User authentication and role-based access control
- Data fixtures for testing

## Tech stack

- PHP 8.2 / Symfony 7.1
- Twig
- MySQL (relational data) + MongoDB (consultation statistics)
- EasyAdmin 4
- Webpack Encore / SCSS
- Bootstrap

## Local setup

Clone repositories and install dependencies:
```bash
composer install
npm install
```

Configure your database credentials in .env, then run:

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migration:migrate
php bin/console doctrine:fixtures:load
npm run dev
symfony serve
```

## Work in progress

- Upgrade to Symfony 7.2+ (blocked by MongoDB driver compatibility)
- Animal statistics page with Mysql/MongoDB cross-database join (branch: feat/animal-stats)

## Notes
This project was developed as a training exercise and is not intended for production use.

