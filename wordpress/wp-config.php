<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'w0rDpr355#1');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '~z.0-{g4Ui{a#d)Ay7mYM#kA2Jnz(z)>H~j}( ?S=w<O4viKl[|,r%EHiM@7yRTV');
define('SECURE_AUTH_KEY',  'L7~[}REMItf9@ojMiJprv7;E1;P9*r&$#*b~K^}8F}Y]PAikU>:(~5hp9%AeYylt');
define('LOGGED_IN_KEY',    'QB9bPH=G?PQuE W4qkTh*BO4fp}QY6``UZ6e%~)arKa6D&s2<&wL!nQL1usL aaU');
define('NONCE_KEY',        'GD_mUy!M*-3JE-sp?*g%Pp5n]Ci|rp.inhjH:-ygJaH](X$}RD(x;B735MTyRCs$');
define('AUTH_SALT',        'pZ[=M.)?:X??E4|U9+*KM</;C7y>IHqA1Mj6LS=Q@gQ94BP /p=oo1=G0Bp*J~<#');
define('SECURE_AUTH_SALT', 'p2A ?2hLt)P!ov$^E8~Ei1{e,Dr|%(sf^V|]FJn0sg,&3~nlr4c&UL-5DMXpR}R-');
define('LOGGED_IN_SALT',   ';#824,Bq@?68]ui>W@J<r_eGXiN`[9A} n7PB-p6Zrcc#w?$1ilhF@RdsAfDO.kA');
define('NONCE_SALT',       'EetQG<kF,%OVjiqd|$R~mVWu`/L6_tYX}-($e<k<z>JWIc[`/*fL+jp_4[s+-`>e');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
