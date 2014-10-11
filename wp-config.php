<?php
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
define( 'DB_NAME', 'hydroponic-garden-manager' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define('AUTH_KEY',         ':5F7OqSq|/eD5c{ohcdAb RCw, zq.=;GX|o-+{i345 S(c #5_>^eP3-66bDyFj');
define('SECURE_AUTH_KEY',  'G$N1&b PZk^=Q|br-Bn48`-z!~P3<-x+1_EtZ],e* ^5`r3BsqibGu;=zebh=a.:');
define('LOGGED_IN_KEY',    'B]-G`yi`0g`,eaE}+b3.6AwkUnAiwVMkm><5<d>|-T}|n(%P)!:P&SrnpsyJ%}!O');
define('NONCE_KEY',        '&.>^D=&l.rNvS><2YubU1>EZqW LMoq=m9g_+|;N_ XNKe;Tf&UYz5%r8]=.GY(z');
define('AUTH_SALT',        'Z28oDX1B{Hsw>$x1V<#v0Uy$xJY!AJ)p,}W-+mV&+N}+Q+02>EXne(on%tr3|AZ:');
define('SECURE_AUTH_SALT', '. )+m_QCq{Q+5b?Dw|#u!M:kIMUbO-iUTKc!FLVkb|40hd7s({b*gCfJODm`#Zx[');
define('LOGGED_IN_SALT',   'nrm3Gg|+V+0-3r(Z1~MnC]xj/J]4ND+~J_(,y!N3v-#Vk|P5!OuRp~-78<EXll,n');
define('NONCE_SALT',       '#`L gTgJ}bZj#4%[w*&+Wp$EdE1k&&Q*{X/|M4PP( h,&>P?T%HRC[M-zV5O.M-x');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
