<?php

require_once __DIR__ . '/vendor/autoload.php';

$faker = Faker\Factory::create('hu_HU');

print "TRUNCATE TABLE `users`;" . PHP_EOL;
foreach (range(0, 50) as $i) {
    printf("INSERT INTO `users` (`name`, `email`, `birthdate`, `confirmed`) VALUES ('%s', '%s', '%s', %d);" . PHP_EOL,
        $faker->name, $faker->email, $faker->date('Y-m-d'), $faker->boolean);
}