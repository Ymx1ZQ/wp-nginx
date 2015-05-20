<?php
/**
 * WordPress Config File
 *
 * @link     http://goo.gl/srVcBS Codex Documentation for wp-config.php
 *
 * @category Configuration
 * @package  WPStack
 * @author   Richard Aber <richaber@gmail.com>
 */

/** Local configuration modifications */
if ( file_exists( __DIR__ . '/local-config.php' ) ) {
	require __DIR__ . '/local-config.php';
}

/** Application environment */
if ( ! defined( 'APP_ENV' ) ) {
    define( 'APP_ENV', ( getenv( 'APP_ENV' ) ? getenv( 'APP_ENV' ) : 'dev' ) );
}

/** Path to project root directory */
if ( ! defined( 'PROJECT_DIR' ) ) {
    define( 'PROJECT_DIR', dirname( __DIR__ ) );
}

/** Path to public web directory */
if ( ! defined( 'WEB_DIR' ) ) {
    define( 'WEB_DIR', __DIR__ );
}

/** Path to WP Core directory */
if ( ! defined( 'CORE_DIR' ) ) {
    define( 'CORE_DIR', WEB_DIR . '/wp' );
}

/** Include Composer autoload if available */
if ( file_exists( PROJECT_DIR . '/vendor/autoload.php' ) ) {
	require PROJECT_DIR . '/vendor/autoload.php';
}

/** Increase memory allotted to WordPress PHP @link http://goo.gl/xdcnOA */
if ( ! defined( 'WP_MEMORY_LIMIT' ) ) {
	define( 'WP_MEMORY_LIMIT', '256M' );
}

/** Increase memory allotted to WordPress Admin PHP @link http://goo.gl/xdcnOA */
if ( ! defined( 'WP_MAX_MEMORY_LIMIT' ) ) {
	define( 'WP_MAX_MEMORY_LIMIT', '512M' );
}

/** @var string WP_HOME The site URL @link http://goo.gl/p0sP0U */
if ( ! defined( 'WP_HOME' ) ) {
	define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] );
}

/** @var string WP_SITEURL WordPress Core URL @link http://goo.gl/rYTRuQ */
if ( ! defined( 'WP_SITEURL' ) ) {
	define( 'WP_SITEURL', WP_HOME . '/wp' );
}

/** @var string DB_NAME The database name for WordPress to use @link http://goo.gl/ZQfxCk */
if ( ! defined( 'DB_NAME' ) ) {
	define( 'DB_NAME', 'dbname' );
}

/** @var string DB_USER Username to connect to database as @link http://goo.gl/q9DCY4 */
if ( ! defined( 'DB_USER' ) ) {
	define( 'DB_USER', 'dbuser' );
}

/** @var string DB_PASSWORD Password to connect to database with @link http://goo.gl/QhUVCe */
if ( ! defined( 'DB_PASSWORD' ) ) {
	define( 'DB_PASSWORD', '123' );
}

/** @var string DB_HOST Host where the database resides @link http://goo.gl/PGed9q */
if ( ! defined( 'DB_HOST' ) ) {
	define( 'DB_HOST', 'localhost' );
}

/** @var string DB_CHARSET Character set for defining MySQL tables @link http://goo.gl/3r2gPB */
if ( ! defined( 'DB_CHARSET' ) ) {
	define( 'DB_CHARSET', 'utf8' );
}

/** @var string DB_COLLATE database collation, sort order of character set @link http://goo.gl/8FQf6e */
if ( ! defined( 'DB_COLLATE' ) ) {
	define( 'DB_COLLATE', '' );
}

/** @var string $table_prefix WordPress Database Table prefix @link http://goo.gl/m1qqqY */
if ( empty( $table_prefix ) ) {
	$table_prefix = 'nrdwp_';
}

/** @var string CONTENT_DIR Slug of the content directory and URL @link http://goo.gl/E2YVfB */
if ( ! defined( 'CONTENT_DIR' ) ) {
	define( 'CONTENT_DIR', '/wp-content' );
}

/** @var string CONTENT_DIR Content directory @link http://goo.gl/E2YVfB */
if ( ! defined( 'WP_CONTENT_DIR' ) ) {
	define( 'WP_CONTENT_DIR', WEB_DIR . CONTENT_DIR );
}

/** @var string WP_CONTENT_URL Content URL @link http://goo.gl/E2YVfB */
if ( ! defined( 'WP_CONTENT_URL' ) ) {
	define( 'WP_CONTENT_URL', WP_HOME . CONTENT_DIR );
}

/** Authentication Unique Keys and Salts @link http://goo.gl/XPFQLN */
define( 'AUTH_KEY',         'O`7.#^3s6K]:.se$Jm? mUe3!bu]mkPb UY.UW1_)FNl}yM-Di&@&xo-%du-P(U1' );
define( 'SECURE_AUTH_KEY',  'Ba@-vG4,r]P8FFk Gt|@|mg+%quUEl+BUdtsX,8[a6Lh1Fc{y13O|);(f60pzXLL' );
define( 'LOGGED_IN_KEY',    '|DxKU!T):P(=8b6dZL{cT*7dPmG~^*3!c2a^mfb+q,9-){W2c7FBN.@CpD1&_m6w' );
define( 'NONCE_KEY',        '{(]>Q1R#{(iV[vPio>B`y$nWmu#9i#-:jy.3d8<qvi/ab-&_Up{Ogxy#%S:<h>d]' );
define( 'AUTH_SALT',        '8)y+CV?7n+lF[c-]!mFkff0]xZL(,*QBbCk@l54q7%Qj*(!sBLlb_|A3H3{lIjf.' );
define( 'SECURE_AUTH_SALT', 'K6WKQK8N?$J^ L99z0iHLf<didg2NNb>q=Di2i,fhbU#eIeOQ^hI&kdWPOAFk}9Z' );
define( 'LOGGED_IN_SALT',   'zP+OW<IdH7!}EtEB+-e+<uc=izu_>3`l`ZU8y^&rR~MRl1o.!wJo^@G @nm|+RXu' );
define( 'NONCE_SALT',       'qTrOK#& npt]: %%kS]= {WP+q`|OPzXD|2DgaU-rk y<dxh/!V96>R~-x(X>hG#' );

/** WordPress Localized Language, defaults to English. */
if ( ! defined( 'WPLANG' ) ) {
	define( 'WPLANG', '' );
}

/** debug mode @link http://goo.gl/QcHLVl */
if ( 'production' != APP_ENV ) {
	define( 'WP_DEBUG', true );
	define( 'WP_DEBUG_DISPLAY', false );
	define( 'WP_DEBUG_LOG', true );
	define( 'SAVEQUERIES', true );
}

/** @var bool DISALLOW_FILE_EDIT Disable file editor @link http://goo.gl/ppzZwo */
if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
	define( 'DISALLOW_FILE_EDIT', true );
}

/** @var string ADMIN_COOKIE_PATH Admin cookie path @link http://goo.gl/aLNHAj */
if ( ! defined( 'ADMIN_COOKIE_PATH' ) ) {
	define( 'ADMIN_COOKIE_PATH', '/' );
}

/** Use the latest Jetpack user-agent detection if we have it, VIP style */
if ( file_exists( WP_CONTENT_DIR . '/plugins/jetpack/class.jetpack-user-agent.php' ) ) {
	require_once( WP_CONTENT_DIR . '/plugins/jetpack/class.jetpack-user-agent.php' );
} else if ( file_exists( WEB_DIR . '/config/is-mobile.php' ) ) {
	require WEB_DIR . '/config/is-mobile.php';
}

/** Load Batcache if available */
if ( file_exists( WEB_DIR . '/config/batcache-config.php' ) ) {
	require WEB_DIR . '/config/batcache-config.php';
}

/** Load custom roles configuration if available */
if ( file_exists( WEB_DIR . '/config/roles.php' ) ) {
	require WEB_DIR . '/config/roles.php';
}

/** @var string ABSPATH Absolute path to the WordPress Core directory */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', CORE_DIR . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
