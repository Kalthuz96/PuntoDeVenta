<?php

    //define("BASE_URL","127.0.0.1/retord");
    const BASE_URL = "http://127.0.0.1/retoRD/";

    //Zona horaria
    date_default_timezone_set('America/Mexico_City');

    //Variables de Conexion
    const DB_HOST = "localhost";
    const DB_NAME = "retord";
    const DB_USER = "root";
    const DB_PASSWORD = "";
    const DB_CHARSET = "utf8";

    //Delimitadores decimales y millar Ejemplo: 24,999.99
    const SPD = ".";
    const SPM = ",";

    //Simbolo de moneda
    const SMONEY = "$";

    //Datos envio de correo
	const NOMBRE_REMITENTE = "Ing. Jesús Renato De La Rosa Martínez";
	const EMAIL_REMITENTE = "informartica@iudm.mx";
	const NOMBRE_EMPESA = "Nombre Empresa";
	const WEB_EMPRESA = "Página Web empresa";
?>