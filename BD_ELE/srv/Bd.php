<?php

class Bd
{
 private static ?PDO $pdo = null;

 static function pdo(): PDO
 {
  if (self::$pdo === null) {

   self::$pdo = new PDO(
    // cadena de conexión
    "sqlite:srvbd.db",
    // usuario
    null,
    // contraseña
    null,
    // Opciones: pdos no persistentes y lanza excepciones.
    [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
   );

  // self::$pdo->exec("DROP TABLE IF EXISTS ELECTRONICO");
//  self::$pdo->exec("DROP TABLE IF EXISTS ELECTRONICO");
  

   self::$pdo->exec(
    "CREATE TABLE IF NOT EXISTS ELECTRONICO (
      ELE_ID INTEGER,
      ELE_NOMBRE TEXT NOT NULL,
      ELE_COLOR TEXT NOT NULL,
      ELE_TAMAÑO TEXT NOT NULL,

      CONSTRAINT ELE_PK
       PRIMARY KEY(ELE_ID),

      CONSTRAINT ELE_NOM_UNQ
       UNIQUE(ELE_NOMBRE),

      CONSTRAINT ELE_NOM_NV
       CHECK(LENGTH(ELE_NOMBRE) > 0),
       
      CONSTRAINT ELE_COLOR_NV
       CHECK(LENGTH(ELE_COLOR) > 0),
       
      CONSTRAINT ELE_HAB_NV
       CHECK(LENGTH(ELE_TAMAÑO) > 0)
     )"
   );
  }

  return self::$pdo;
 }
}
