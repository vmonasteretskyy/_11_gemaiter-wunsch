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
define( 'DB_NAME', 'gemaiter' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '{8B0ux:?;+@)r5,83;<|)]$`=?dHn7V *A[QKOj<N!RIpVU9fk?4*HhrehU$.**a' );
define( 'SECURE_AUTH_KEY',  'ws?I/u-;&]$KMamo!u2?K*[y[aym0XtiN{3;I=9Sm[aG|4.lf#F^p1KAyl4Hs{y@' );
define( 'LOGGED_IN_KEY',    '=|=9tL/[gKF-sce%[c`_bdsPlkz2hF=Z;JnAET<li1{UmErkHr8@L.GIN6]jOxN~' );
define( 'NONCE_KEY',        'aB/&8F~zTN!W-L[*xF|`x9Gty+Mo6K%.Ip&Pq]fTl{%xZ~rE@}$0P;Q-*?Lut7J^' );
define( 'AUTH_SALT',        'C&kIL~t[ualx)n{>4Os_d0$V%-$wPKBreXQLaSt[ACP?28=z5d |l*wtqD}b+Ay.' );
define( 'SECURE_AUTH_SALT', '-Z~HlFG,Lh5&)JsN1_HMSDb@kA*GvP7?@HX#)l.m:3 uJHY+x7{gc+G:y}rG_1=.' );
define( 'LOGGED_IN_SALT',   'EVy>YE,Y/`2W}#6$;~?7NS@^6:OM*lm}?kgas=vJaD~CySC%8v?7;4C<0WUqkG|P' );
define( 'NONCE_SALT',       'ps.;29RS(6+PC&^C_w_>6N-6.eh6/ZCj3)!{hOWU560Ooc.^#_],^R**.TZ^ 8a.' );

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
define( 'WP_DEBUG', true );

define( 'WP_HOME', 'http://lh.me' );
define( 'WP_SITEURL', 'http://lh.me' );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
