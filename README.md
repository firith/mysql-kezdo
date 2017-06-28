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
  [mezok, kulcsok, indexek]
);

CREATE TABLE IF NOT EXISTS `tabla_neve˙ (
  [mezok, kulcsok, indexek]
);
```

## Mező definiálása

```mysql
CREATE TABLE `tabla_neve` (
  `mezo_neve` TIPUSA(HOSSZA) egyeb_opciok,
  `masik_mezo` TIPUSA(HOSSZA) egyeb_opciok
);
```

### Mező típusok

#### Numerikus

https://dev.mysql.com/doc/refman/5.7/en/numeric-type-overview.html

* `TINYINT`: [-128..127, 0..255]
* `SMALLINT`: [-32768..32767, 0..65535]
* `INT`: [-2147483648..2147483647, 0..4294967295]
* `BIGINT`: [-9223372036854775808..9223372036854775807,0..18446744073709551615]
* `DECIMAL(digit, scale)`: digit: összes számjegy, scale: tizedespont utáni számok
* `FLOAT(digit, scale)`

Módosítók:
* `UNSIGNED`: Nem tartalmaz negítív értéket
* `ZEROFILL`: balról paddingel nullákkal

#### Dátum

https://dev.mysql.com/doc/refman/5.7/en/date-and-time-type-overview.html

* `DATE`: YYYY-MM-DD
* `TIME`: HH:MM:SS
* `DATE`: TIME YYYY-MM-DD HH:MM:SS

#### String

https://dev.mysql.com/doc/refman/5.7/en/string-type-overview.html

* `CHAR(hossz)`: fix hosszúságú szöveg
* `VARCHAR(maxhossz)`: változó hosszúságú szöveg
* `TEXT`: változó hosszúságú szöveg (max 65,535 karakter)
* `ENUM`: felsorolás, értéke előre meghatározott értékek közül választható, nem ajánlott használni.

### Egyéb opciók

* `NOT NULL`: a mező értéke nem lehet NULL
* `DEFAULT 'alapertelmezes`': Ha nincs megadva érték a mezőnek a rekord létrehozásakor akkor a default értéket fogja felvenni
* `AUTO_INCREMENT`: id mezőnél használjuk, olyan default értéket jelent ami beszúrás után egyel nő.
* `UNIQUE`: egyedi, a táblában adott értékkel csak legfeljebb 1 rekord lehet (UNIQUE indexet hoz létre)

### Kulcsok

* PRIMARY KEY(\`mezo_neve\`,...): az adott mező lesz a tábla egyedi azonosítója
* UNIQUE KEY \`kulcs_neve\` (\`mezo_neve\`, ...) egyedi a táblában adott értékkel legfeljebb csak egy 1 rekord lehet
* KEY \`kulcs_neve\` (\`mezo_neve\`) indexet hoz létre, gyorsítja az olyan lekérdezéseket amiknél szűrve van ennek a mezőnek az értéke

### Példa 

```mysql
CREATE TABLE users (
	`id` BIGINT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(60) NOT NULL,
	`email` VARCHAR(50) NOT NULL,
	`birthdate` DATE NOT NULL,
	`confirmed` TINYINT NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	KEY `idx_name` (`name`),
	UNIQUE KEY `uni_email` (`email`)
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

# Műveletek adatokkal

## Rekord beszúrása

https://dev.mysql.com/doc/refman/5.7/en/insert.html

```mysql
INSERT INTO `table_neve` (`mezo1`, `mezo2`) VALUES ('mezo1_ertek', 'mezo2_ertek');
INSERT INTO `users` (`name`, `email`, `birthdate`) VALUES ('Simon Balázs', 'balazs.simon@intren.hu', '1984-03-18');
```

## Rekord módosítása

https://dev.mysql.com/doc/refman/5.7/en/update.html

```mysql
UPDATE `table_name` SET `mezo1`='mezo1_uj_ertek', `mezo2_uj_ertek` WHERE feltetel;
UPDATE `users` SET `name`='Simon Balázs Miklós' WHERE email LIKE 'balazs.simon@intren.hu';
```

Ha nem adunk meg feltételt, akkor a tábla összes rekordját módosítani fogja!

## Rekord törlése

https://dev.mysql.com/doc/refman/5.7/en/delete.html

```mysql
DELETE FROM `tabla_neve` WHERE feletetel;
DELETE FROM `users` WHERE confirmed = 0; -- Kitöröl minden sort ahol a confirmed oszlop értéke 0
```

## Adatok lekérdezése

https://dev.mysql.com/doc/refman/5.7/en/select.html

```mysql
SELECT `mezo1`, `mezo2` FROM `tabla_neve`
```

Ha minden mező értékét le akarjuk kérdezni, akkor nincs szükség egyesével felsorolni, ehelyett használhatjuk a `*` karaktert:

```mysql
SELECT * FROM `tabla_neve`
```

Lehetőség van a tábla nevére aliast létrehozni, ez akkor hasznos, ha több táblát érint a lekérdezés (lásd később):

```mysql
SELECT * FROM `tabla_neve` AS t1;
SELECT * FROM `tabla_neve` t1;
```
### Adatok szűrése

Adatok szűrésére a `WHERE` kulcsszó után lehet feltételeket írni. Ha több feltétel van akkor meg kell adni ezek relációját (`AND`, `OR`)

```mysql
SELECT * FROM `tabla_neve`
WHERE `mezo1` > 100 AND `mezo2` <> 2
-- minden olyan sor ahol a `mezo1` oszlop értéke nagyobb mint 100 és a `mezo2` oszlop értéke nem 2 
```

Használható operátorok és függvények: https://dev.mysql.com/doc/refman/5.7/en/functions.html

### Eredmény sorrendkének megadása

```mysql
SELECT * FROM `tabla_neve` WHERE ...ORDER BY `mezo1` ASC, `mezo2` DESC;
```

Ha nincs megadva sorrend, akkor a lekérdezés eredményének sorrendje előre nem meghatározható.

Irányok:
* `ASC`: növekvő
* `DESC`: csökkenő

### Találatok mennyiségének limitálása

```mysql
SELECT * FROM `tabla_neve` LIMIT 20;
SELECT * FROM `tabla_neve` LIMIT 10, 20;
SELECT * FROM `tabla_neve` LIMIT 20 OFFSET 10
```

Lekérdez 10 sort, a kezdő sor el van tolva 20-al (21-től 30-ig kérdez le)


### Aggregátor függvények

https://dev.mysql.com/doc/refman/5.7/en/group-by-functions.html

Csoportosított sorok halmazain működik és egyetlen eredményt ad vissza csoportonként

pl:
* `SUM(mezo_neve)`: összegzi a mezők értékét
* `MIN(mezo_neve)`: visszaadja a legkisebb mezőértéket
* `MAX(mezo_neve)`: visszaadja a legkisebb mezőértéket
* `COUNT(mezo_neve)`: Megszámolja a nem null értékű mezőket

```mysql
SELECT MIN(`mezo_neve`) FROM `tabla_neve`;
SELECT MIN(`birthdate`) FROM `users`;
SELECT COUNT(`id`) FROM `users`
```

### Csoport képzése

```mysql
SELECT * FROM `tabla_neve` GROUP BY `mezo_neve`;
SELECT `confirmed`, MIN(`birthdate`) FROM `users` GROUP BY `confirmed`;
```

### Having

Lekérdezett eredményen való szűrés

```mysql
SELECT ... FROM `tabla_neve` GROUP BY `mezo1` HAVING feltetel;
SELECT `favorite_number`, COUNT(`id`) AS darab FROM `users`
GROUP BY `favorite_number`
HAVING darab > 10;
```