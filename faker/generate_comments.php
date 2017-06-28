<?php

require_once __DIR__ . '/vendor/autoload.php';

$faker = Faker\Factory::create('hu_HU');

print "TRUNCATE TABLE `comments`;" . PHP_EOL;
foreach (range(0, 20) as $i) {
    printf("INSERT INTO `comments` (`user_id`, `message`) VALUES (%d, '%s');" . PHP_EOL,
        $faker->numberBetween(1, 50), $faker->sentence);
}

//printf("INSERT INTO `users` (`name`, `email`, `birthdate`, `confirmed`, `favorite_number`) VALUES ('%s', '%s', '%s', %d, %d);" . PHP_EOL,
//    $faker->name, $faker->email, $faker->date('Y-m-d'), $faker->boolean, $faker->numberBetween(1, 10));