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
define( 'DB_NAME', 'wp_animal_food' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'b(ej{}#V5A;Z2M]0VcF*QooDN;s374N^SKO{qM|d=_n7uwsGC=uI<fA@aW2RjGUT' );
define( 'SECURE_AUTH_KEY',  '~;fL8jiND1ozW{3 Dl,zM#j5uHqKA,uBOJvh-PCd,.awK#xKW77]?u;<PIOaCHoj' );
define( 'LOGGED_IN_KEY',    'WzbJ~r&[z2+t4F-!XR~5iHoL76f8&TWf.-8VsQ&;:.ptm+` PkxT3pN)AKM?AE&M' );
define( 'NONCE_KEY',        't5hRWtg`7;gVp^WKx%^iT a^jvW^iO^gRz<eJa{plK1Y8Z2H1LAGvExbX/DDdGe)' );
define( 'AUTH_SALT',        '_hItz%`LD1RUnwz],wS?3pP@SprN2W?w~ak>+b(Y{=1mg{XK#rvzt.NGL{KS>f`3' );
define( 'SECURE_AUTH_SALT', '0/92yg0L9H?H6=8vKTHtwR.WdHU<L2ZP$u0vu;Dm_T)ujtczWAT!*XS| Th(<=*i' );
define( 'LOGGED_IN_SALT',   ' )Xh^uWcAG5VD/N[TImW0ZP;6iC1v}Ct(0X)eS~ILPVxqACk@[{huh.-0%}4%Dq#' );
define( 'NONCE_SALT',       ')Z2#WHq<AU?^sq~fApstubAa|U_fgd*fpRjA!L/a431d.u)iKfdx,Vhm=8ySvM%j' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
