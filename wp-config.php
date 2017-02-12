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
define('DB_NAME', 'alteredbrain');

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
define('AUTH_KEY',         '+B-<W+:l`<elT+xyv)C7iBkIf#!./A4`}$RVZ$D|F>[*g18K-@#PUX]#Hnq;mV%O');
define('SECURE_AUTH_KEY',  '7;m1z7C)RT0Jf/ 6o!]&tk+uJvRr0^`6ag6+RM-f(w.@7Yk,a]`IY+*XY8@N#|Cm');
define('LOGGED_IN_KEY',    '}+M$gR~uc$vo2li0W37}*#m1XikF~xb~-%T~+t|&&8^J9n_@&Kr;_U|:@F 8ep/L');
define('NONCE_KEY',        '.{S]7W>wwnejulFbAUk,^%I^NY8Y7WV#js-H9jV{^:PH+*yv&i39-kuRVVYN1IH-');
define('AUTH_SALT',        'KEI@j{->=Q{gm1Dm~2$mL}_m6w!kewSjZ-WfPz;S],w,0FbQa<Iz`/zAKZ~*bOp6');
define('SECURE_AUTH_SALT', 'SP)tk48_f=32$e3` vL+{Li0}JkT3<1&02#l5mwiYv#p_:e3*_#1x7mQ4j0DPn.w');
define('LOGGED_IN_SALT',   '&]5y%1p8&/$(04<P 7nkK:Zpt|>Ih5s*b{0ue6:7LG]} yxfU9Qc>Ztqq$GhJsPb');
define('NONCE_SALT',       '}$iCn*S*)!Ot[Fjg1AKM9$wI}Ot*2{Ii3|X`9bL@w+;d+-IRqosk=L/r}uTXeWf0');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
