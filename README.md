# Backend Interview Test
Build a RESTful-API ecosystem for a to-do list.

- [Backend Interview Test](#backend-interview-test)
  - [Object](#object)
    - [Setup](#setup)
      - [Development Requirement](#development-requirement)
    - [Definition of done](#definition-of-done)
      - [API List](#api-list)
    - [Notice](#notice)
  - [License](#license)


## Object
In this test, you have to fulfill all exceptions and complete tests successfully. Following rules are your mission:

1. Follow the [`Setup`](#setup), [`Development Requirement`](#development-requirement) to create your code
2. Finish the test by following [`Definition of done`](#definition-of-done)

### Setup
1. Create new repository with this template. (Please `DO NOT` use any words related to `Voicetube`)
2. Run `docker-compose up -d --build`
3. Run `docker-compose exec app php artisan migrate`
4. Uncomment the lines in `routes/api.php` and create your class by the route list

#### Development Requirement

1. Complete it with `Laravel 8`, `PHP 8`, `Nginx` and `MySQL 8`
2. API that modifies data *must* be protected by tokens
3. Finish the test with current design pattern
4. Follow PSR-12 for coding style

### Definition of done
1. Run `docker-compose exec app composer run test`
2. Make all tests passed successfully

#### API List

* Get all to-do lists belong to authenticated user, sort by created time
* Get one to-do list
* Create one to-do list
* Update one to-do list
* Delete one to-do list
* Delete all to-do list
* Create one to-do list item
* Update one to-do list item
* Delete one to-do list item
* Login by email and password
* Generate a new token
* Get token status

### Notice

We highly value the quality of the assignment, and we understand that candidates have their commitments. Hence should you require more information to complete the assignment to the best of your ability, please feel free to let us know.

## License

Copyright © 2021 VoiceTube Corporation. All rights reserved.

The source code is licensed under [MIT license](https://mit-license.org/).
