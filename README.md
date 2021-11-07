# NI Task API

## Steps
- [Set up](#set-up)
- [Configuring Database](#configuring-database)
- [Configuring Test Process And Run Test](#configuring-test-process-and-run-test)


## Set up
First, build docker container and run:

```bash
docker-compose build
docker-compose up -d
```

## Configuring Database
Run migration and seeders

```bash
docker-compose run --rm app php artisan migrate --seed
```


## Configuring Test Process And Run Test
Run migration and seeders for testing

```bash
docker-compose run --rm app php artisan migrate --seed --env=testing
```

Run tests
```bash
docker-compose run --rm app php artisan test 
```

# Auth
| Route | HTTP Verb	 | POST body	 |Header	 | Description	 |
| --- | --- | --- | --- | --- |
| /auth | `POST` | {'email':'foo@bar.com','password':'password'} |  | Get user token |

# User
| Route | HTTP Verb	 | POST body |Header	 | Description	 |
| --- | --- | --- | --- | --- |
| /user | `GET` | Empty | Authorization:Bearer token | Get current user data. |
| /user/product | `GET` | Empty | Authorization:Bearer token| Get users orders. |
| /user/product | `POST` | {'sku' : 'traktor-pro-3'} | Authorization:Bearer token |Add new order to user. |
| /user/product/:sku | `DELETE` | Empty | Authorization:Bearer token | Delete user's order with sku. |

# Product
|Route  |HTTP Verb  |Body   |Header |Description|
| --- | --- | --- | --- | --- |
| /products | `GET` | Empty  | Authorization:Bearer token | Get all products. |


