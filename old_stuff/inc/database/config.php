<?php
/**
 * Hier kommen die Zugangsdaten hin.
 * So kann jemand der keine Ahnung hat, seine Daten eintragen,
 * ohne im System rumpfuschen zu müssen. Sicherheit!
 */

/* MySQL Zugangsdaten */
define('DB_NAME', 'db348734303');
define('DB_USER', 'dbo348734303');
define('DB_PASS', 'london2010');
define('DB_HOST', 'db2922.1und1.de');
/* define('DB_CHARSET', 'utf8'); brauchst du nicht zum Verbinden. */

/* Ich glaube das ist selbsterklärend. 
   DB_NAME ist eine Konstante und daher (nach einmaligem includen der config.php) 
   im ganzen System verfügbar. Das war das Problem gestern bei dir mit den Variablen. */
   
/* Schnickschnack */
define('SALT_PATTERN', 'gf4sfad486as7dsa4d648as6');

/* Das ?> fehlt absichtlich! Wenn du mehrere Dateien includest und die Dokumente vielleicht 
   nicht als UTF-8 gespeichert wurden, kann es sein das du so ekelhaften wightspace im Layout 
   bekommst (z.B.: Header, Content, Footer) */