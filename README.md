# YII3-DOCTRINE-APP

A [Yii 3](https://yii3.yiiframework.com) web application template that supports the [Doctrine ORM](https://www.doctrine-project.org/).
The template includes a  [Yii3 authentication](https://yiisoft.github.io/docs/guide/security/authentication.html) implementation using the [klsoft/yii3-user](https://github.com/klsoft-web/yii3-user) package for demo purposes. You can replace or remove this package as needed.

See also:

- [YII3-CACHE-DOCTRINE](https://github.com/klsoft-web/yii3-cache-doctrine) - The package provides the [PSR-16](https://www.php-fig.org/psr/psr-16/) cache using the [Doctrine ORM](https://www.doctrine-project.org/)
- [YII3-RBAC-DOCTRINE](https://github.com/klsoft-web/yii3-rbac-doctrine) - The package provides [Yii RBAC](https://github.com/yiisoft/rbac) storage using the [Doctrine ORM](https://www.doctrine-project.org/)
- [YII3-DATAREADER-DOCTRINE](https://github.com/klsoft-web/yii3-datareader-doctrine) - The package provides a [Yii 3 data reader](https://github.com/yiisoft/data?tab=readme-ov-file#reading-data) that uses the [Doctrine ORM](https://www.doctrine-project.org/)
- [YII3-CMS](https://github.com/klsoft-web/yii3-cms) - A content management system based on the [Yii 3 framework](https://yii3.yiiframework.com) and uses the [Doctrine ORM](https://www.doctrine-project.org/)

## Requirements

- PHP 8.2 - 8.5.

## How to use

 1. Create a new project from a template using the [Composer](https://getcomposer.org/) package manager:
```bash
composer create-project klsoft/yii3-doctrine-app your_project
cd your_project
```
2. Configure the Doctrine connection in the `config/common/params.php`.
3. Create the database schema:
```bash
./yii doctrine:orm:schema-tool:create
```
4. To run the application:
```bash
./yii serve --port=8383
```

Open your browser to the URL [http://localhost:8383](http://localhost:8383)

## How to use with Docker

 1. Clone the repository.
 2. Uncomment the line `'host' => 'mysql'` in the `config/common/params.php`
 3. Start the application: 
    ```bash 
    docker compose up -d 
    ```
 4. Create the database schema:
    ```bash 
    docker compose run --rm app ./yii doctrine:orm:schema-tool:create 
    ```

Open your browser to the URL [http://localhost:8383](http://localhost:8383)

## The following the Doctrine console commands are currently available:

- doctrine:orm:schema-tool:create
- doctrine:orm:schema-tool:drop
- doctrine:orm:schema-tool:update
- doctrine:orm:validate-schema
- doctrine:orm:mapping-describe
- doctrine:orm:generate-proxies
- doctrine:orm:run-dql
- doctrine:orm:info
- doctrine:orm:clear-cache:metadata
- doctrine:orm:clear-cache:query
- doctrine:orm:clear-cache:result
- doctrine:dbal:run-sql

Display help for a command:
```bash
./yii <command> --help
```
