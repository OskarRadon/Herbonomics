# Herbonomics
##### Connects Cannabis Retailers and Cultivators

#### By Ryan Brown, Alex Fallenstedt, Schuyler Klaassen, Matt Knutson, Oskar Radon, Adam Ross Russell

## Description

Herbonomics makes it easy for retailers and cultivators to connect with each other and do business.

Each cultivator can make a profile and post what cannabis strains the cultivator are selling. Each strain has details regarding
* THC & CBD content
* Strain name
* Species
* [Clean Green Certification](http://cleangreencert.com/home/)
*  Price (Dollars / Pound).

The cultivator has full CRUD (Create, Read, Update, and Delete) capability when managing their strains, making it easy for keeping an up-to-date inventory on the marketplace.

A retailer can also make a profile to post the amount of a specific cannabis strains a retailer is in need of. Each offer a retailer makes has full CRUD capability, which allows the retailer to manage their demands and only request offers from specific cultivators.

Cultivators and retailers can both browse the marketplace for strains that are in demand by retailers and are offered by cultivators. This saves time for both parties by eliminating countless phone calls, emails, and store visits by connecting specific retailer demands to cultivator who has that supply.

Future versions could include product transparency and online ordering for each cannabis flower posted to the marketplace. This would include:
* Full product descriptions
* Reviews of the product and the cultivator
* Sample requests

## Bug list

None at this time.

4. Potentially give an alert that the password or user name was incorrect upon login attempt.

## Setup

1. Clone this repository using the command `git clone https://github.com/OskarRadon/Herbonomics.git`.
2. Change directory into the top level of the project folder.
3. Install Composer (https://getcomposer.org) and then run the command `composer install` to download the Silex and Twig vendor files.
4. Change directory into the `web` folder and run the command `php -S localhost:8000` start your server.
5. Navigate your browser to the home page at the root address  `http://localhost:8000`.
6. Open `localhost:8888/phpmyadmin` in your browser. Enter the user name `root` and the password `root`.
7. Choose the `Import` tab, select the database file named `herbonomics.sql.zip` (from the project folder) and click `Go`. You should now be able to see the `herbonomics` database in your phpMyAdmin.
8. Repeat step 7 with the file named `herbonomics_test.sql.zip` in order to run tests.

## MySQL Commands

1. `CREATE DATABASE herbonomics;`

2. `USE herbonomics;`

3. `CREATE TABLE growers (id serial PRIMARY KEY, name VARCHAR(255), website VARCHAR(255), email VARCHAR(255), username VARCHAR(255), password VARCHAR(255));`

4. `CREATE TABLE dispensaries (id serial PRIMARY KEY, name VARCHAR(255), website VARCHAR(255), email VARCHAR(255), username VARCHAR(255), password VARCHAR(255));`

5. `CREATE TABLE dispensaries_demands (id serial PRIMARY KEY, dispensary_id INT, strain_name VARCHAR (255), pheno VARCHAR (255), quantity INT);`

6. `CREATE TABLE dispensaries_growers (id serial PRIMARY KEY, dispensary_id INT, grower_id INT);`

7. `CREATE TABLE growers_strains (id serial PRIMARY KEY, strain_name VARCHAR(255), pheno VARCHAR(255), thc FLOAT(5,2), cbd FLOAT(5,2), cgc TINYINT, price DECIMAL(11,0), growers_id INT(11,0));`

## Technologies Used

* HTML5
* CSS3
* SASS
* PHP
* Silex & Twig
* PHPUnit for testing
* MySQL

### Legal

Copyright (c) 2016, Ryan Brown, Alex Fallenstedt, Schuyler Klaassen, Matt Knutson, Oskar Radon, Adam Ross Russell

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
