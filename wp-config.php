<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mssnlasu_wp10' );

/** Database username */
define( 'DB_USER', 'mssnlasu_wp10' );

/** Database password */
define( 'DB_PASSWORD', 'U-46S[U3ph' );

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
define( 'AUTH_KEY',         'cibqrlfyalzdhdo2dvlgkthtps0zx0nnsfegfcqyapx5v3zah7hb44kqb0sd4u3t' );
define( 'SECURE_AUTH_KEY',  'j18exkhgewtmldjlnvno9dn8sefjlwhzvczstnvzn24eu8rdjziyfvgrerp4ootc' );
define( 'LOGGED_IN_KEY',    '09loztmxqrjjea9n90dmkv7jiqbdzosmar9kaywk9qbjkjxioqs7tzqtjjtt992y' );
define( 'NONCE_KEY',        '8cyvc6daj92gtrfc8gral42fpkayljfyhiomzrnlut8ojlf14vovf0cfsff1pp8a' );
define( 'AUTH_SALT',        'tvkhrdudqacqi4f4aeiddfkrdl7rzd9tvp8y2zi4yno1rrozycciasrjwlgzf3lg' );
define( 'SECURE_AUTH_SALT', 'o0qrzzae2etejxfwhbtje6e3kmqwdfanmg07ywemwrc3xkktua4woejavx4o2c71' );
define( 'LOGGED_IN_SALT',   'j9rhgeyefe90ac2oczs7bbgav5e0ah1xije2p1nn2uzcjrmstepaygw8fqpf64gi' );
define( 'NONCE_SALT',       'd5qbgqbhhvdicveztudep0nxnoophgt2qor51k5zzdrblqx4ab9mww9pbljxolsx' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wppr_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



define('DISALLOW_FILE_EDIT', true);

define('CONCATENATE_SCRIPTS', false);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
