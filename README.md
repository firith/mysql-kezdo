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

* TINYINT [-128..127, 0..255]
* SMALLINT [-32768..32767, 0..65535]
* INT [-2147483648..2147483647, 0..4294967295]
* BIGINT [-9223372036854775808..9223372036854775807,0..18446744073709551615]
* DECIMAL(digit, scale): digit: összes számjegy, scale: tizedespont utáni számok
* FLOAT(digit, scale)

Módosítók:
* UNSIGNED: Nem tartalmaz negítív értéket
* ZEROFILL: balról paddingel nullákkal

#### Dátum

https://dev.mysql.com/doc/refman/5.7/en/date-and-time-type-overview.html

* DATE YYYY-MM-DD
* TIME HH:MM:SS
* DATE TIME YYYY-MM-DD HH:MM:SS

#### String

https://dev.mysql.com/doc/refman/5.7/en/string-type-overview.html

* CHAR(hossz): fix hosszúságú szöveg
* VARCHAR(maxhossz): változó hosszúságú szöveg
* TEXT: változó hosszúságú szöveg (max 65,535 karakter)
* ENUM: felsorolás, értéke előre meghatározott értékek közül választható, nem ajánlott használni.

### Egyéb opciók

* NOT NULL: a mező értéke nem lehet NULL
* DEFAULT 'alapertelmezes': Ha nincs megadva érték a mezőnek a rekord létrehozásakor akkor a default értéket fogja felvenni
* AUTO_INCREMENT: id mezőnél használjuk, olyan default értéket jelent ami beszúrás után egyel nő.
* UNIQUE: egyedi, a táblában adott értékkel csak legfeljebb 1 rekord lehet (UNIQUE indexet hoz létre)

### Kulcsok

* PRIMARY KEY(`mezo_neve`,...): az adott mező lesz a tábla egyedi azonosítója
* UNIQUE KEY `kulcs_neve` (`mezo_neve`, ...) egyedi a táblában adott értékkel legfeljebb csak egy 1 rekord lehet
* KEY `kulcs_neve` (`mezo_neve`) indexet hoz létre, gyorsítja az olyan lekérdezéseket amiknél szűrve van ennek a mezőnel az értékére

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