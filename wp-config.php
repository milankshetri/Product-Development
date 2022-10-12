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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'olympic2022' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'lEN2P`29fIHXZAX)nONQMP@t7aiY|nXSVs@V1N-XuM+B6|E* 0kaJzJKG1~8J5AA' );
define( 'SECURE_AUTH_KEY',  'hl?*t#b{5E+cs{4x%MPX6VpmeVXogBUiea0VXS_N#AY!XiL:y;]1`7@2WP_<WI4x' );
define( 'LOGGED_IN_KEY',    'm+Gj/Y0o#M&D1~^>W`~0dc}3rku!/o_Ql`5G E]oa#D(UW`de|<l^h1zI[D.TRA.' );
define( 'NONCE_KEY',        'Vir:pfH9#Zl[g](u^+h,2{Vma9:k)U%8_@ .7p$k_z@Xlv<^+3zID38M=Y?zuWod' );
define( 'AUTH_SALT',        '.CL.N?^@M9sGH5 B/J,h%9[*gi3(hid@tg<1N#o@ w#lL[ssr?OCS&_&%a^do>dF' );
define( 'SECURE_AUTH_SALT', '?r7G [1a,jdR_y1`|j!ME225M7-$Og!6UkaY9=FUmY=D%`Sk}]Fa/b^*?A(e5{{)' );
define( 'LOGGED_IN_SALT',   ';&~2:2?~90699LaO<zC;=QX)o1~zsg38l&W[,DpTsy,8UIQ4+#%Nudd3 C4LjD:Q' );
define( 'NONCE_SALT',       'AD,vTQ _$JaZ5p>0Ujcy72H.Z&o.b3a_;*2j+Rf}bjdsiUXW7(A? MF0`,N%TQ{M' );

/**#@-*/

/**
 * WordPress database table prefix.
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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
