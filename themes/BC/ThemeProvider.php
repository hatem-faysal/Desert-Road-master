<?php
namespace Themes\BC;

use Database\Seeders\DatabaseSeeder;

class ThemeProvider extends \Themes\Base\ThemeProvider
{

    public static $version = '3.3.0';
    public static $name = 'Desert Road';
    public static $seeder = DatabaseSeeder::class;
}
