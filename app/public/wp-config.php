<?php
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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          ']lHZA[^}(0F_nQxe^cS0aD+@vF8gp)8+T|.L5 mW&oQP|LG}T]{qK`^pwWdDR ;2' );
define( 'SECURE_AUTH_KEY',   'KJK{=]:ftI-CoqMG zLjWnyVf?y>;QaJ~ob#hdUMZKrXbD=OJK1jfXleIwH`BEx#' );
define( 'LOGGED_IN_KEY',     'ez]p`81@.=XsW?6duqs0Bas?MhXv(T{]KepB+%_Gm XAz..ZQE!hEL6y/ozNK)r?' );
define( 'NONCE_KEY',         'mmtXTibQR?fcB_v?IBL$gP_u}LvJ_c0z[z}V[$[Yek6f-%)GvzTx6x#=20c}t-og' );
define( 'AUTH_SALT',         '!l,,^g?UzH$wG<j@j8FI~?Bqm/8ikv!.T68uNFVFU_t3,N%(N|v@M(;RDw7>{1*.' );
define( 'SECURE_AUTH_SALT',  '_C>zG~Ds/w$2QY.}|AKZrkO?&`(lA0f6>01(w@*-1mv2b_j~E;Y`>VU{d:yT*wf7' );
define( 'LOGGED_IN_SALT',    'l@<v&qJ?.,..I?~>j}FLXU@d($Je|yX8__v|IJ)prRuQJx>m0,[d_R%9BX_1Mn(x' );
define( 'NONCE_SALT',        'H<,5{NJy/i@6~#}1xLm%P}MFz_5h.(Yy`+/WRJ[,_U9V@q}QJVTqf0KLukRr6$Gz' );
define( 'WP_CACHE_KEY_SALT', '3,-G9o9dQ;$ejFO5B/@U&Q`*mb&TxUG0:gKRd+iW!##?N:3<I|*BSAZA,SD,M_nk' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */

// Preview provisorio via tunel (LocalTunnel, ngrok, Live Link do Local).
if ( ! empty( $_SERVER['HTTP_HOST'] ) && false === strpos( $_SERVER['HTTP_HOST'], 'liderban.local' ) ) {
	$preview_host = preg_replace( '/:\d+$/', '', $_SERVER['HTTP_HOST'] );
	define( 'WP_HOME', 'https://' . $preview_host );
	define( 'WP_SITEURL', 'https://' . $preview_host );
}

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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
