<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>


## About Kinderbook

Kinderbook is my examination project for WCM18 at Medieinstitutet. It is a web application suited for daycare/preschools. It is a complete system for handling the daily schedule.

Features including: Visual indicator on which children is currently present. Visual indicator on which children is currently sick. Parents can upload an image of their child. Parents can make a notification to the daycare/preschool. The staff can make blogg-like announcements with a image to reflect what has happned during the day. And ofcource the application is 
using authentication so a user(parent) can't edit children of other users, and the staff can only make minor chages to the children(change what department each child belongs to).

## Using Kinderbook

1 - You have to clone this repository

2 - in the root folder in a terminal window type the following command: npm install
    This installs all the applications depedencies.

3 - Open the root folder in a text-editor (ex: Visual Studio Code, Sublime Text, Atom). Here you will see a file called: .env.example
    Make a copy of this file and rename it to: .env
    This is the file handling all your environment variables, such as configuration of the database.
    To use the application you will need a application key, so again go to the terminal in the root folder and type the command: php artisan key:generate --show
    As a response you will get something showing in the terminal window. Copy whatever is showing and paste it in the .env file next to: APP_KEY=

4 - You will need to setup a Database, and please use the UTF-8 encoding. And update the .env file with your credentials.
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=

5 - Now you can use the predefined migration to populate your database with tables, using the the terminal command: php artisan migrate

6 - And finally to give you some dummy data to work with, I have also made some database seeding. If you want to use it type the terminal command: php artisan db:seed

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
