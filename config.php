<?php
/** 
 * Configuración básica de la libreria.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de Base de Datos,
 * claves secretas. Los ajustes de la base de datos te los proporcionará tu proveedor de alojamiento web.
 *
 * @package PHPDB
 * @author Alejandro Moreno <alejandromj92@nauta.cu>
 * @version 0.0.1
 * @license MIT
 */

/**
 * Ajustes de Base de Datos. Solicita estos datos a tu proveedor de alojamiento web.
 */

/** Controlador de la Base de Datos */
define('DRIVER', 'mysql');

/** El nombre de tu base de datos */
define('NAME', 'test');

/** Tu usuario de la base de datos */
define('USER', 'root');

/** Tu contraseña de la base de datos */
define('PASSWORD', '');

/** Host de la base de datos (es muy probable que no necesites cambiarlo) */
define('HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('CHARSET', 'utf8');
