<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'survivors_database');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '@#08vBsf@IKrtN*0J{o#+}7-U5>oa|LAoyy?+dC:Z5|- MM3l*&;gaG0gst`&m.7');
define('SECURE_AUTH_KEY',  'CANy3SHkW[Bn2L|]R/WYyC[__w_[tGpwU9ejBF77JLv)?C}oNElvZ75h@^yASgD)');
define('LOGGED_IN_KEY',    ',kQk),_Gh$tQ$8hPNd*:B<k&?oAC|c8E8rMPlGw?&;kaYEw_MerbsFKd?a|G-lP9');
define('NONCE_KEY',        '6)J1PQ}pY$gEbiOCd43F4XR),-&f-g95zT)G}ybGt3O[HgAg9pZ8o[t7Du=}/$6=');
define('AUTH_SALT',        'Diit-|$X%,!cC4}-/a>g_q->wzcrLWi=~Fh1>zIV<nIwr8Eg|G6Y j>(#j^L=(<3');
define('SECURE_AUTH_SALT', 'H4tU^Iu0U=.c*bW$jYW_S?|S1u-oEQiuD8bYk!L3{}_<qo~D})rS+T`;f]6BAm>x');
define('LOGGED_IN_SALT',   '[x|o3-B9HXE@QLah,TN9K->^{NOzTVk!Qo!|tN9h_f5`2fwOD,R|6Q|ZIxK}-k[X');
define('NONCE_SALT',       '0C|-R`Ed|l_K]UnUCV-.tD*[m-&+ek L Z>PD#PSmrf8K*xoX&%ML-*gbQ1,N!w]');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
