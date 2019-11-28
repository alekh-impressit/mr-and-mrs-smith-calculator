### Requirements ###
- PHP ^7.2.5
- YARN
- Docker

### Project overview ###

In this project we implemented an API for calculator that can handle ​arithmetical​ and bitwise operations using Symfony 5. You can find all API references in `./Calculator.postman_collection.json` file (Provided by Postman). On the front-end we use React and Symfony Encore component.

As a code style format we use PSR-2 standard. To check php code-sniffer report please do the following steps:
- In project root folder create `./phpcs.xml` file based on `./phpcs.xml.dist`(In our case we can keep all configs as they are in base file)
- Execute this command `./vendor/bin/phpcs` in the project root folder.


### Setup the Calculator project ###

1. Clone repository
2. Create `.env` based on the `.env.dist` file and fill it with correct configurations.
3. Execute `composer install` command inside project root folder.
4. Execute `yarn install` to install all frontend dependencies.
5. In `./assets/js/website/configs/` create `config.yml` based on `./assets/js/web​site/configs/config.yml.dist`.
6. Also please add `127.0.0.1 calculator.com` to your hosts file (`/etc/hosts`).
7. To build the application, please execute the following command:

```
yarn encore dev --config-name websiteConfig --watch
```

### Run docker environment ###
In `./docker/` folder you need to create one more `.env` file based on the `./docker/.env.dist` and fill it with correct configurations.

To run docker environment please go to the `./docker/` folder and execute the following command:

For MacOs:
```
docker-compose -f docker-compose-mac.yml up
```
For Linux
```
docker-compose up
```

To prepare network for xDebugger execute this command in your CL: `sudo ifconfig lo0 alias 10.20.30.1`
