<?php

require_once __DIR__ . '/vendor/autoload.php';

$faker = Faker\Factory::create('hu_HU');

print "TRUNCATE TABLE `users`;" . PHP_EOL;
foreach (range(0, 49) as $i) {
//    printf("INSERT INTO `users` (`name`, `email`, `birthdate`, `confirmed`) VALUES ('%s', '%s', '%s', %d);" . PHP_EOL,
//        $faker->name, $faker->email, $faker->date('Y-m-d'), $faker->boolean);

    printf("INSERT INTO `users` (`name`, `email`, `birthdate`, `confirmed`, `favorite_number`) VALUES ('%s', '%s', '%s', %d, %d);" . PHP_EOL,
        $faker->name, $faker->email, $faker->date('Y-m-d'), $faker->boolean, $faker->numberBetween(1, 10));
}