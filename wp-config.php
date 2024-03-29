<?php
/** Enable W3 Total Cache Edge Mode */
define('W3TC_EDGE_MODE', true); // Added by W3 Total Cache

/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
define('DB_NAME', 'outdoorfan_nice');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '1*5ysT/Wim3XaPL5+_&B-M?N3cgFOgn|`kf6</p:=`W).vRfYQDON:)J!9C9asp(');
define('SECURE_AUTH_KEY',  'fqZVjv6QU|b4=(iYws:Soz-;+ $>qEcllD6e hZ~{;U-*j[W!|V:f?yy-s| Sahq');
define('LOGGED_IN_KEY',    'OS3|g#2|.JzpIlY!6hAq(w+vm_L~nPLM617xrKNijseiI7-_31(p0i|p}gVLlVO~');
define('NONCE_KEY',        '{Q[j/%Bfx,Y9m!Xe-oU,bC]a>EO{1R+ Y6|yIKK]s^WRU=~>pF96L(-$>A[ VBM2');
define('AUTH_SALT',        '&nmP&,({p`(zc{{$W.BEUKwj%cA[P:~:`{[Yw{E>yp+Y5vFA6-a7[xd|#:7sI`%O');
define('SECURE_AUTH_SALT', '!{9Sw#E_8@p?OhF<Yx5?(EZWRE,yPf.]{omEZ6F=|Ro.<6p/#-B}o`DnuGnwnf}b');
define('LOGGED_IN_SALT',   '#B1pxc|FWI`C)1m,VH<|3?`,~G3K;(@}BTp*?4h?^zPor|1FAog+irzj&}aM&mN-');
define('NONCE_SALT',       '~z+)!$fr $5(DrD5S|a|~nO;^$h+SH3Hf7WRT./V&E1wVPTWqz %=A{|Qy(ZqC)&');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
