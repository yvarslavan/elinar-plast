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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'local');

/** Database username */
define('DB_USER', 'root');

/** Database password */
define('DB_PASSWORD', 'root');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY',          '#/z/(0?-f#2dum!u-%$?8{w.(JXp=8IrI*U.wBb`l,yd]vd?F~J</9GM[T >3Bq>');
define('SECURE_AUTH_KEY',   'Gt7^G,@nj;LdLK>z@mM0~KNJfyl(RuwO]o}mG~=wL-m(hx;C:Dl!cziw]BQ)fFY=');
define('LOGGED_IN_KEY',     'nhQFzl1vElB<<-DU2@I>h$&2%S6-e]z58i=svOG;GX{S$hBOhf|H0jKe*5}HW_(7');
define('NONCE_KEY',         'xfZMrE!mq0K*:OFYBi$&k)wm%>!8:@u/.8%,Sjc8E?Zg[#~sR@W2KDq>en1Ln^r9');
define('AUTH_SALT',         'Gb=.<s:4<TDaxWB0](UA[2OZ{`#TA0z*{D!PFkj{P0Bm%LCvnP>Vs<;Q*icS0}N^');
define('SECURE_AUTH_SALT',  '/GJ$ags%w#=P#cSDOBrTQ&2^=uKfg) CZJquZ>I(cSu>:pyGrvCkJmRuG<+qc%Uh');
define('LOGGED_IN_SALT',    'VEhCg7HJw#aH2Im7#;?Ab[{>^2/q$eFh_0:s&!B3^:Wujs2|*l[w!B^n>e-[U1|$');
define('NONCE_SALT',        '=l<F2O4EU}S%JZD16ckMFC?37BM5ZHhZ-kCZ`OPRX q:=DrVyy7Y.dm9<,y7&6xt');
define('WP_CACHE_KEY_SALT', 'Hj2`Rc+Js5>NZEL1)v2a.MdNvLS-s*683*D6g+(a#{E;Igp52z3v#>wK1RZ4Z5_L');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */

// Настройки темы Elinar Plast
// API ключ Яндекс.Карт (опционально, если не задан - используется значение по умолчанию)
define('ELINAR_YANDEX_MAPS_API_KEY', 'b376f600-5f23-4f98-aff8-76b815df14bf');

// Email-адреса для получения заявок с форм сайта
// Основной адрес (если не задан - используется plast@elinar.ru)
define('ELINAR_PRIMARY_EMAIL', 'plast@elinar.ru');
// Резервный адрес для копии заявок (если не задан - используется varslavanyury@gmail.com)
define('ELINAR_COPY_EMAIL', 'varslavanyury@gmail.com');

// Telegram Bot Token для отправки заявок в Telegram
// Получить токен: создайте бота через @BotFather в Telegram
// Бот: https://t.me/elinarplast_bot
define('TELEGRAM_BOT_TOKEN', '7672102144:AAFM47VmlL1otzZljLXG8mXq-rebxxf1PSw');


// Performance optimization flags (safe rollback switches)
// Set to false to disable a specific optimization without code changes.
define('ELINAR_OPT_DEFER_SCRIPTS', true);
define('ELINAR_OPT_DEFER_NONCRIT_CSS', true);
define('ELINAR_OPT_ASYNC_FONTS', true);
define('ELINAR_OPT_RESOURCE_HINTS', true);
define('ELINAR_OPT_FRONT_PAGE_ASSETS', true);
define('ELINAR_OPT_GLIGHTBOX_FOOTER', true);



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
if (! defined('WP_DEBUG')) {
	define('WP_DEBUG', false);
}

define('WP_ENVIRONMENT_TYPE', 'local');

define('WP_HOME', 'http://localhost:10004');
define('WP_SITEURL', 'http://localhost:10004');

// Disable internal WP-Cron to prevent page load delays on first visit
define('DISABLE_WP_CRON', true);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (! defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
