<?php
define('WP_CACHE', true); // WP-Optimize Cache
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */
// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'sagardhadketech_db' );
/** Database username */
define( 'DB_USER', 'root' );
/** Database password */
define( 'DB_PASSWORD', '' );
/** Database hostname */
define( 'DB_HOST', 'localhost' );
/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );
/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'WX&t[p[w>#jMN6ccZ*uDkww+*%HzTM/fly,>h-P`tkn4HE!$7)&j[`E{cB9R.t9V' );
define( 'SECURE_AUTH_KEY',  '2M67O<QTT_WzQ$4L:[XC.@N*X$Q`#=DQ]*=Rkdo]:L=ly)U~(LTP-Dtbd [;9F-R' );
define( 'LOGGED_IN_KEY',    'p:ku],AB*Wy7Kei<.S)UE>@-}EFU3c+}t5<$=L}Re@XOWIpzkMT[;3DDQ2TuWC>C' );
define( 'NONCE_KEY',        '.rI5-L|5K]cQ3coK<;-@K+vt n;Nlc~psPQ`eaK9+|XlDVT&#&&ea((oGx+-hyy.' );
define( 'AUTH_SALT',        'H9,lGBDOPCYI&f@l4FzMF<uIrGsLi,C(*+>F6wvO<M=(&6N?Q[Po-y$&JQ)rYktu' );
define( 'SECURE_AUTH_SALT', '*sk{P&zG.Q?Q4|$<VSRAfIq)XxJg?1O#NjxFiE1P/V}sY[P3OD,pdT7T^pqj]Xo`' );
define( 'LOGGED_IN_SALT',   '}lPQTsEb`-/a{}5af[^yPh`Q6,M$Yy|!lbJRV.$RgxqR*!3l,/:|DX8.,>#e`8N:' );
define( 'NONCE_SALT',       'yIC`nU.K9~+_{csEWF2~fg));LNSs~6va#o:He`DX:k|~j8qw |:@lu8[(Xq[sB:' );
/**#@-*/
/**
 * WordPress database table prefix.
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
/* Add any custom values between this line and the "stop editing" line. */
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';