# Herbonomics
##### Connects farmers and dispensaries together.

#### By Ryan Brown, Alex Fallenstedt, Schuyler Klaassen, Matt Knuttson, Oskar Radon, Adam Ross Russell

## Description

Herbonomics makes it easy for dispensaries and farms to connect with each other and do business.  

As a dispensary, you can make your own profile and display what strains and the quantity you need.  You can also search for a strain or farm and see what is available on the market.  If you find a farm that suits your need, you can contact them and make a bid on their product.

Similarly, as a farm you can make your own profile and can display what products you have on hand.  You can search for dispensaries or strains and see the current product demand on the market.  If you see a dispensary that suits your need, you can contact them and make them an offer for your product.

## Setup

1. Clone this repository using the command `git clone https://github.com/OskarRadon/Herbonomics.git`.
2. Change directory into the top level of the project folder.
3. Install Composer (https://getcomposer.org) and then run the command `composer install` to download the Silex and Twig vendor files.
4. Change directory into the `web` folder and run the command `php -S localhost:8000` start your server.
5. Navigate your browser to the home page at the root address  `http://localhost:8000`.
6. Open `localhost:8888/phpmyadmin` in your browser. Enter the user name `root` and the password `root`.
7. Choose the `Import` tab, select the database file named `herbonomics.sql.zip` (from the project folder) and click `Go`. You should now be able to see the `shoes` database in your phpMyAdmin.
8. Repeat step 7 with the file named `herbonomics_test.sql.zip` in order to run tests.

## MySQL Commands Used

1. `CREATE DATABASE herbonomics;`

2. `USE herbonomics;`

3. `CREATE TABLE growers (id serial PRIMARY KEY, name VARCHAR(255), website VARCHAR(255), email VARCHAR(255), username VARCHAR(255), password VARCHAR(255));`

4. `CREATE TABLE dispensaries (id serial PRIMARY KEY, name VARCHAR(255), website VARCHAR(255), email VARCHAR(255), username VARCHAR(255), password VARCHAR(255));`

5. `CREATE TABLE dispensaries_demands (id serial PRIMARY KEY, dispensary_id INT, strain_name VARCHAR (255), pheno VARCHAR (255), quantity INT);`

6. `CREATE TABLE dispensaries_growers (id serial PRIMARY KEY, dispensary_id INT, grower_id INT);`

7. `CREATE TABLE growers_strains (id serial PRIMARY KEY, strain_name VARCHAR(255), pheno VARCHAR(255), thc DECIMAL, cbd DECIMAL, cgc TINYINT, price DECIMAL, growers_id INT);`

## Technologies Used

HTML5, CSS3, SASS, PHP, Silex, Twig, PHPUnit, mySQL

### Legal

Copyright (c) 2016, Ryan Brown, Alex Fallenstedt, Schuyler Klaassen, Matt Knuttson, Oskar Radon, Adam Ross Russell

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
