# Adatbázis műveletek

## Csatlakozás adatbázis szerverhez

```bash
$ mysql --user=myname --password=mypass
$ mysql --user=myname --password=mypass adatbazis_neve 
```

## Adatbázisok listázása

```mysql
SHOW DATABASES;
```

## Adatbázis kiválasztása

```mysql
USE adatbazis_neve;
```

## Táblák kilistázása

```mysql
SHOW TABLES;
```

## Adatbázis létrehozása

https://dev.mysql.com/doc/refman/5.7/en/create-database.html

```mysql
CREATE DATABASE `adatbazis_neve`;
CREATE DATABASE IF NOT EXISTS `adatbazis_neve`;
```

## Adatbázis törlése

https://dev.mysql.com/doc/refman/5.7/en/drop-database.html

```mysql
DROP DATABASE `adatbazis_neve`;
DROP DATABASE IF EXISTS `adatbazis_neve`;
```

# Táblaműveletek

## Tábla létrehozása

https://dev.mysql.com/doc/refman/5.7/en/create-table.html

```mysql
CREATE TABLE `tabla_neve˙ (
  ...
);

CREATE TABLE IF NOT EXISTS `tabla_neve˙ (
  ...
);
```

## Tábla adatainak kiürítése

Az AUTO INCREMENT mező számlálója visszaáll 1-re.

```mysql
TRUNCATE TABLE `tabla_neve`;
```

## Tábla eldobása

```mysql
DROP TABLE `tabla_neve`;

DROP TABLE IF EXISTS `tabla_neve`;
```