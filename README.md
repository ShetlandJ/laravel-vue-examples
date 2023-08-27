### Project installation instructions

Hello! To get this up and running, we assume the following to be true:

1. You have the repo cloned onto your machine
2. You have PHP (8.x) installed
3. You have Composer installed
4. You have NPM and Node installed
5. You have a way to create and manage DBs on your machine

## First things you need to do:

0. Not worry about the size of the project - there's hundreds of files, we'll work with less than 10.
1. Make a copy of the .env.example file, and update the DB_DATABASE, DB_USERNAME and DB_PASSWORD with your chosen DB and the credentials you use to access your MySQL - for me on my local machine this just username `root` and no password. Yours may vary. You'll need to create a DB with any name, make sure it matches the DB_DATABASE value in your .env file.
2. Run `composer install`
3. Run `npm install` or `npm i` (same thing)
4. Run `php artisan key:generate` (we'll cover `artisan` in a bit)
5. Run `php artisan migrate`
6. Run `php artisan serve`
7. In a new terminal tab, run `npm run hot`
8. Visit http://localhost:8000