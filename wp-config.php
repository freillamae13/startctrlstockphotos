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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'startctrlstockphotos' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'wmUDf?cBw6[}&H?a@#6[Z(3;J^Y9IUiZ~c99Hk6uf=7VW&gL>$LLahvCq,M5{]Hc' );
define( 'SECURE_AUTH_KEY',  'eHFf|*6`5)c|Y` uH+H$;G_m3rnfQL;s|Muu/Bj+K;HW9A/1d&%!&a,s,zBn[;^z' );
define( 'LOGGED_IN_KEY',    'myI*x{SKm_+@$B~xV7+(. Dlw NwYS7z8uhpt>_0T$Wqf;I+-;*%M%?+VQ8qC?L3' );
define( 'NONCE_KEY',        '<M[VmftvP9Nv^T)Z#]wMxQ<AyoSr`}0rdH~s~P,<_h0r#ye^@Y:st+f!5_bh7AJR' );
define( 'AUTH_SALT',        'nU3I6rSLbv3fPR*W@HV%:W-m9pFlm~`xLBxO8.>-_c81k)N[}@$BF.K*VrZ~c5A{' );
define( 'SECURE_AUTH_SALT', '^qn{yza?G@>$=m=(kavJ57NbDL*gI,R6zOMheB*9k9@0B+VjC:#RPp=ij{`*_){x' );
define( 'LOGGED_IN_SALT',   '7ws^&lP.7{=6DH@W;$NfU8oH}F@w6E]Sg,7KrPnt?.yN[t<6Jzt8;.[2Tn^iP1^{' );
define( 'NONCE_SALT',       'W]eM&Z(A}|^Mg=?{~i+XEq10@}I<z<dOs|+#6+n2 `]&?|7V)zL(.WWn?SK(^Z(j' );

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
