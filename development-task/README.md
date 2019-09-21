# jobleads Development Task
Develop a software that can be used to calculate statistics about the tax income of a country. The country is organized in 5 states and theses states are devided into counties.

Each county has a different tax rate and collects a different amount of taxes.

The software should have the following features:

- Output the overall amount of taxes collected per state
- Output the average amount of taxes collected per state
- Output the average county tax rate per state
- Output the average tax rate of the country 
- Output the collected overall taxes of the country

Please use the MVC pattern in your implementation and implement two different datasources of your choice.

---------------------------------------

####How to install?
1- git clone the project into local folder.

2- run command `composer install`.

3- run command `php artisan key:generate`.

4- Update .env file with right values mainly related to app name, SMTP and database credentials.

5- run command `php artisan config:cache`.

6- run command `php artisan migrate` to run migration database tables.

7- run command `php artisan db:seed` to fill the database with main data.

8- if you didn't configure virtual host or you don't have apache and need to serve your application run the command `php artisan serve`.

9- go to the main url and you will be asked for email and password you will find them below:-

Email: admin@admin.com
Password: admin8766

####Todo:
1- Add unit testing

2- Add import/export from excel files.
