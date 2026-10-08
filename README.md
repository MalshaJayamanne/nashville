# Custom WordPress Theme

[![WordPress](https://img.shields.io/badge/WordPress-%2321759b.svg?style=for-the-badge&logo=wordpress&logoColor=white)](https://wordpress.org/)

WordPress theme starter boilerplate with opinionated structure and support for integrations with in-house ecosystems and toolchains.

## Requirements

The Starter Theme follows WordPress recommended requirements. Make sure you have all these dependences installed before moving on:

- WordPress >= 6.4
- PHP >= 7.2
- Composer

## Initial Setup

To get started, clone this repository and follow theese steps.

Install dependencies:

```bash
composer install
```

## Local Setup

To get started, follow the initial setup and proceed as follows.

Start container:

```bash
docker-compose up -d
```

Permission for modifying the app source:

```bash
sudo chmod -R 777 app
```

Stop container:

```bash
docker-compose down
```
