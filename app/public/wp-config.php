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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'JjEPZ7whjpNKEHUKZkcuO0i8u+hCysIvUzMZzx06W+wptbFs6KD+94geBPLIufIo0yPseCE5Kz+1FxKNOxqrMw==');
define('SECURE_AUTH_KEY',  'c28t7+45z0jQvUPx0Gkj4xQfPxAAf9Aqq2h6ydyGAmYk9P09xGtSyo84KxRW8djQvhLWZsP42T1o4nnRansODg==');
define('LOGGED_IN_KEY',    'Ii/JW5L7gUapGCjbrd4Qf8Ni30Ckbo9I3esRv24xfcNgfWrvYt1UmmBs2K44iwqr9D1z6+/V1FPUSdCj2uAtgA==');
define('NONCE_KEY',        'oiwPaiBQris5f/eyiRE3PxX+XRMgHKJynIKX47X/PEswu1re1UT2raLFBkulrIth3/K/yXF6oZtPtINnk5P3aQ==');
define('AUTH_SALT',        'EZIFZqLFIcXZUVvgnRJ2OWwOHBVoP/tKMYi2ygbKM0lK2BHiXCaWHC6DI+xgDdjOK4neCuoIUSwIjvBV5B4iuQ==');
define('SECURE_AUTH_SALT', 'nDZNhGboVQBQt9bMm1+/nLx21/Q2TWvz4oQsJUErF6kEhUE9jXxtXMn/nZRr+cIk5/uWQHPceFOw5+SOc/2KFA==');
define('LOGGED_IN_SALT',   'LjnRGWivQUgYzS/e47wIcjzpzR8eEuC+rHlhP99RqeYb1Dj9W/rGz42xu9MOd+ElOfIvlNUJRov4NXyRKY43Ew==');
define('NONCE_SALT',       'eBgPjdFw2KO28BUPdeKDYu1JthfpHTAdF0bERhxLRCA9iCNk63B8qjY8Ott0y6ejY/qehWHtR3ONnBcfA9PJcQ==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';





/* Inserted by Local by Flywheel. See: http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy */
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
	$_SERVER['HTTPS'] = 'on';
}

/* Inserted by Local by Flywheel. Fixes $is_nginx global for rewrites. */
if ( ! empty( $_SERVER['SERVER_SOFTWARE'] ) && strpos( $_SERVER['SERVER_SOFTWARE'], 'Flywheel/' ) !== false ) {
	$_SERVER['SERVER_SOFTWARE'] = 'nginx/1.10.1';
}
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
