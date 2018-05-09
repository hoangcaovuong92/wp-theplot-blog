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
define('DB_NAME', 'woo_no_one_blog');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '?JZBbK=Z<Tl-V,r9+Z-!Y6BHGJrvqmS2$5$`9~T~a%#`.<mt:ybS+0x3Is:dLuRX');
define('SECURE_AUTH_KEY',  'Gg=Bd?%cuyTsru8]DX=w}HdPST<RWW{qyf6e/<lAC_[vtT 6#[(jW@s%<Bz<E+^{');
define('LOGGED_IN_KEY',    'Opzb&65*&-ut_td~N]g!DhR@u R.r8vq^TJYo9,YTZ4n/h,Ehaykeo%&tq#`,q5j');
define('NONCE_KEY',        'np->rdRS(f6rQ-ARm:IR)a1j*?QexJl;mk&gX=Gwh+oh+&c5 ~|#Vuugvx#.u08|');
define('AUTH_SALT',        '0imwM22#|D5Ip`KcW.gSaGTa!;a^m4S4%KC=*R*W$Rel?X$]c4}a>*v5W1vaMb@B');
define('SECURE_AUTH_SALT', 'W>+<T>#$Bv2zbKX#9MWmf^VExIvgY^!Aw6B869`7s:DS%)A+zpi1rfBQAWLX;HRN');
define('LOGGED_IN_SALT',   ',NbEwMIHM_i{v6!!i`P5kCi/JV+5^^[);h7A| m+|EzcVH{50eO$!1k,{s3kWTpj');
define('NONCE_SALT',       '5knH<>{llE(I>DX|>y{i<&Z=WiXtxzml)og~T:nbVIA-K6fs{xeoa@6)8&Z#2V2-');

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
