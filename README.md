
# Online  gambling api (work in progress)

### Deployment

- Add a  record in /etc/hosts :

```127.0.0.1    slotagrator.com```
- Execute docker-compose up -d
- Define parameters in file db.env . Required parameters can be checked in db.env.example
- Define parameters in file api.env . Required parameters can be checked in api.env.example
- ```docker-compose exec api composer install```
- Set up database schema ```docker-compose exec api php bin/doctrine orm:schema:update --force```
- Initiate application settings: ```docker-compose exec api php bin/initateSettings.php```

#### Dev/test environment configuration

- Bootstrap db with test data:
```docker-compose exec api php tests/bin/bootstrapThingsTable.php```


### What is working so far
- PlayAction (http://slotegrator.com:8080/play) is not finished but it still can be executed just to see that request handler, routing and dependency injection works
- LoadTestAction to check concurrent load: ```ab -k -c 500 -n 10000 http://slotegrator.com:8080/load-test```


### What is done so far
- Docker compose configuration based on NGINX and PHP-FPM. This is a good stack to make handling of big number of concurrent requests to work.
- Implemented request handler based on PSR Interface
- Added service  container and dependency injection mechanism  
- Added and configured doctrine library. To doctrine console commands  check out ```docker-compose exec api php bin/doctrine```
- Implemented simple routing
- Laid out overall component structure:
  - Actions
  - Models
  - Handlers
  - Repositories
  - Routing



### TODO
- Add swagger yaml docs and add  swagger-ui in docker compose services (https://hub.docker.com/r/swaggerapi/swagger-ui)
- Implement security mechanism
- Passing parameters via api/.env (eg. db credentials)
- Add symfony console component for implementing required commands
- run code sniffer to check compliance with PSR-12
- Clean out unused composer libraries
- Consider non local deployment environments. Create base docker-compose.yaml and docker-compose extensions for various environments
- 