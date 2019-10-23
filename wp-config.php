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
define( 'DB_NAME', 'hakunamatata' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'admin' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
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
define( 'AUTH_KEY',         'pxDOQTHdphXrEVwuOfg3I4FZgQrOgkJMlWWcf4tiZ0SimemNP6sM1cpn9GCy2abu' );
define( 'SECURE_AUTH_KEY',  'VzTSW47bJ0FaZgItBx2zaHxxQjUQ0d288Dd82QtuYIHdDpXCWZdkOS0K4cOQUCmb' );
define( 'LOGGED_IN_KEY',    '9jKe4L53vtsUDozcULep0CxvLqA6v6EcKtsRPfzsVHkrJVNeFpu8uW2zwpOeWRFA' );
define( 'NONCE_KEY',        'hXRI8RkdUt3yo7rEIc4kxKbaGCFHs3i3MTO7vPr4XpzNloUrxjdawRx3lzokyMzP' );
define( 'AUTH_SALT',        'AJFxbdOryLA0ZUtdMFD7EeM7qvEcGZhvSIbUa8hgZUp12Fpf6scB7CvgoU5mBjpd' );
define( 'SECURE_AUTH_SALT', 'VlOqDc8SgHvmmVKpixLfUBXTlxqim0WGn3LfdkjA2LMN9JNbzsOuBIaQHFnckzDf' );
define( 'LOGGED_IN_SALT',   'zfn26FSqvdnwq9lQjtr6DI2fWV1azlg92dnJdWh86cmioqViqWV0dsHYrKSWV4Iy' );
define( 'NONCE_SALT',       'xrmkwA45ihaDdwhwQuDDPzYacFnPjzgPNf2naXaQbc0vPMPDFVwxXO9DEazzoLF9' );

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
