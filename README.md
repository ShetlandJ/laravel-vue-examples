## Project installation instructions

Hello! To get this up and running, we assume the following to be true:

1. You have the repo cloned onto your machine
2. You have PHP (8.x) installed
3. You have Composer installed
4. You have NPM and Node installed
5. You have a way to create and manage DBs on your machine
6. You have the Google Chrome extension `Vue DevTools` installed (or FireFox has it too) - this is a really useful thing!

### First things you need to do:

Whenever I say "Run X" I mean in your terminal BTW.

0. Do not worry about the size of the project! There are hundreds of files, but we'll work with less than 10. You don't need to know what everything does, and there are parts I'm sure I don't even know about!
1. Make a copy of the `.env.example` file and rename it `.env`, and update the DB_DATABASE, DB_USERNAME and DB_PASSWORD with your chosen DB and the credentials you use to access your MySQL - for me on my local machine this just username `root` and no password. Yours may vary. You'll need to create a DB with any name, make sure you update DB_DATABASE in your `.env` file to match.
2. Run `composer install` (installed PHP dependencies, like `npm` does for Javascript)
3. Run `npm install` or `npm i` (both of these commands do the same thing, you only need to run it once)
4. Run `php artisan key:generate` (Artisan is a CLI-tool for Laravel to help run commands, in this case, this command creates an application key that will be automatically inserted into your `.env` file. I don't even really know why it needs this, but it does need it)
5. Run `php artisan migrate` (one of the more common commands to run in Laravel. It will run any new migrations. When you run migrations for the first time, it'll run some that are pre-provided by Laravel like a users table. I've made some additional ones that will also run. Migrations in Laravel are also used to run seeders, so I have made a seeder with some data in it for this project.)
6. Run `php artisan serve` (runs the php server)
7. In a new terminal tab, run `npm run hot` (runs the front-end JS)
8. Visit http://localhost:8000

### Troubleshooting

A lot could go wrong with a fresh PHP installation, there may be some patience and persistence required here! 

I really recommend Google/ChatGPT for problems you might run into, but I'm always on hand to answer questions. 

If you get it up and running but see CSS errors in your Console tab, don't stress. We don't need to worry about those.