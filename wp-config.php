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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'sam_jocelyn-realestate' );

/** MySQL database username */
define( 'DB_USER', 'sam_dev' );

/** MySQL database password */
define( 'DB_PASSWORD', 'S/852*963.' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );
//define( 'DB_HOST', '27.111.84.217' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

//SET DEFAULT SITE URL
if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
    define('WP_HOME','http://jocelyn-realestate.local'); 
	define('WP_SITEURL','http://jocelyn-realestate.local');
	define( 'WP_DEBUG', false );
	define( 'WP_DEBUG_LOG', false );
}else{
    define('WP_HOME','http://jocelyn-realestate.createmywordpress.com'); 
    define('WP_SITEURL','http://jocelyn-realestate.createmywordpress.com');
	define( 'WP_DEBUG', false );
	define( 'WP_DEBUG_LOG', false );
}

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '|Ko)5wwhWH&f?-8+vG/{5n0c+wp+y-zgD&|gmQ+^>GU46K`c[0tR7@,%!A}^z}$x');
define('SECURE_AUTH_KEY',  'WxG8-D&-3@*xs1y>^tK0Aa+]Fgecc=NNT,j[WyhQ,IuG$n6D!:AtR6cAKZ9>Zoin');
define('LOGGED_IN_KEY',    '1eaV=5b|*-gjkzB]O%/ZTi*(@c ;PNK/W76|x%|&Cm.PO4QKU4Y6noK& !u/!*JI');
define('NONCE_KEY',        'F-+V2{yw}4Z`nk*bEEjvXp{7s~-5l+c|V-8C;T`2-[4AGmn:AD=YUT=k|Nv*p)|D');
define('AUTH_SALT',        'yb+DsuJwt9=^!FXOq&bW4aqKNmzn-lA3zN -R YY/@V,t-Y0.>.0S.$#uDR)7P9P');
define('SECURE_AUTH_SALT', 'hiQnnw|p*L MJo;8Sdx! )xlhQ6V+nK3{p|T(;>Kv)alg$@NFfz%]&sHlEk?V}kq');
define('LOGGED_IN_SALT',   '06t9>LCwX|W`_vSMuPNq-]|y0r,uI%qjifl-,~7zaiMw(KH|35 ?C MY&`?=Cwz~');
define('NONCE_SALT',       'PjlxZZDG;WU:]pX5V-$-cEb{Tr5I6j2IVHrE</[2[Uy&U|zCMY[(-FL)Q}}+&q-I');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
