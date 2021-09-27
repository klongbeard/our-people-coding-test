# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

To run please `cd` into the root folder and use the command `php -S localhost:8000 -t public` the API can then be accessed from your browser via the url `http://localhost:8000/api/v1/` or pinged via Postman or Curl in terminal. 


# The Routes
All routes are prefixed with `/api/v1` - perhaps slightly overkill for a coding test but I wanted to follow best practices where possible. 

## Get All
`/all`
Returns all Maps (with island count) stored in DB as a JSON object. 

## Create New
Accepts `/create` and additional query string `islandSize`. The default route will create a charted terrority of 5x5, specifying an `islandSize` will return a square map at the requested size. 

E.G. `/create?islandSize=10` returns a 10 x 10 matrix. 


