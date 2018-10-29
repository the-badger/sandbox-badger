<p align="center">
<img src="http://i.imgur.com/mFAwoIi.png" alt="Gruik Logo"/>
</p>

## What's Badger ?

Badger is a gamification platform initially developed as an internal project by [Akeneo](http://www.akeneo.com).

## Prerequisite
- PHP 7.1+

## Installation
Badger is based on the great Symfony framework. **If you encounter some installation errors**,
please have a look on the [Symfony installation documentation](http://symfony.com/doc/4.0/book/installation.html).
If you still have some troubles, feel free to open a [GitHub issue](https://github.com/the-badger/sandbox-badger/issues/new).
Docker comes with a [Docker Compose](https://docs.docker.com/compose/) file template docker-compose.yml.dist, ready to be used.

##### DOCKER AND DOCKER COMPOSE
If you don’t already have Docker and Docker Compose installed on your system, please refer to [the documentation of the GitHub repository](https://github.com/akeneo/Dockerfiles/blob/master/Docs/getting-started.md).

#### 1) Start docker
```
make start
```

#### 1) Update dependencies
```
make update
```

## Running Tests

#### Acceptance test

```bash
make run-gamification-acceptance
```

#### Code style

```bash
make run-gamification-cs
```

#### Specification

```bash
make run-gamification-phpspec
```

## License
Badger is licensed under the [MIT](https://opensource.org/licenses/MIT)
