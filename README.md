<p align="center" style="margin-bottom: 50px;">
    <img width="50%" src="https://static.wixstatic.com/media/a27d24_744f4c5834dd4925bdf15e0e5dc99054~mv2.png">
</p>

![](https://img.shields.io/website?down_color=red&down_message=offline&style=flat-square&up_color=brightgreen&up_message=online&url=https%3A%2F%2Focsc-event.com)
![](https://img.shields.io/maintenance/yes/2023?style=flat-square)
# OCSC Event Website

OCSC Event Website repository. The website is no longer online due the closure of OCSC, that is why the code is now public.

## How to install?

#### 1. Clone the repository
To clone the repository, use the following command:

`git clone https://github.com/HerissonMan-TMP/OCSC`

#### 2. Update the .env file
First, you have to create a .env file in the project, then paste the content of .env.example inside it.

After, you must replace / add the values (such as DB_DATABASE) according to your environment.

#### 3. Generate the key
You need to generate a key if you want to navigate on the website. To do so, use the following command:

`php artisan key:generate`

It will automatically set the APP_KEY value in your .env file.

#### 4. Install dependencies
In order to install the required dependencies, use the following commands:

`composer install`

`npm install`

Then, you can compile scripts with the command:

`npm run dev`

#### 5. Migrate & seed
From there, you can start browsing the website by executing the `php artisan serve` command.
However, you need to populate the database with some data. There are two different ways to do so.

Either you can to seed only the data required for the website to work:

`php artisan production-data:generate`

Or you can seed these required data + fake data for other resources, such as news articles, convoys, pictures,...:

`php artisan db:seed`

#### 6. Upload some fake files
*This part is only required if you executed `php artisan db:seed` at the previous step.*

When you seeded fake data, it didn't upload fake files. For example, you may have some records in the pictures table, however no real picture files will be attached to these records.

Therefore, if you want to upload fake files for downloads and pictures, use the following command:

`php artisan fake-files:upload -D -P`

## How to use?
The website is now working completely! However, you still don't have any credentials to log into the website.

In order to login, you have to get the first user's email in the users table (this first user has the Chief Executive Officer role, which has the administrator permission).
Then, you can use that email and the **'password'** password to login.

## Testing
To test the website, use the following command:

`php artisan test`

---

## Project information

The project is no longer maintained. There are no plans to add new features.

#### Versions
- PHP: ^8.0  
- Laravel: ^8.12

#### Credits
- HerissonMan-TMP (HérissonMan#8014)
