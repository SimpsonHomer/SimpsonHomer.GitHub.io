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
define('DB_NAME', 'vanesso3_wor2');

/** MySQL database username */
define('DB_USER', 'vanesso3_wor2');

/** MySQL database password */
define('DB_PASSWORD', 'TFi6Jm9C');

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
define('AUTH_KEY', 'zOy>>/cG?C?v-TOM%/)FkuE]_daM>cOmx<w+Rd^lhPv{Y*?A+ECzn&kUJNou)q)PM@<JWhTpTS<|OYv|HYZmXpVAKwtkrW{}h}Yoziv[eTDO!<xkL?q%qPQGe+$Cr$Gw');
define('SECURE_AUTH_KEY', 'wKkJCgh;+gzJyTlOqkhhTn]ZmZPsk$gv|LDVdpQaw;dEA;-$arh&@}wWYcT{HUrT+of(++m$b-?pA;To*PO]HKr;urpPCus?UZ}ajwA?oLWIM>TL&Q-mOOq*eWDUUPPH');
define('LOGGED_IN_KEY', 'P*pDmwABN|(ABi=t[E+S^MoMC[s]EnKC&P{ZU%aSKZ?CfjAGjQo<LX;Qjb!B+rjwPJuAPKvEtoQv{Uk?(]vq*e}P;@N{aL)yOZsBD*)xIz^jRRhRdnP<p=sIXhG[a?-j');
define('NONCE_KEY', '}S&^P$a>gWHhIvLyA!j>|x=VZgtroCPThhpgxSr[^@PPDcTeg&GbO%_Zn_<P&yJ[BWZy($jkCXY_cF/_u=Bb!nb_N>Pe]e(UPzuDfD-UtNZ<&mGMR(*PzuN%$zu@Wz_k');
define('AUTH_SALT', 'F!}H)-L/z?h&-tLx;xTw_DzIDNct_ax-%vgBxMyU%R@%U*${V?FNEz*J{Y$@<Cg|U/up_wAloZzX;f)NjZyUc%Cb?%=xyPBvV_s_vcv|^|-Of>)PU;H&gx(q^glzsi/C');
define('SECURE_AUTH_SALT', 'E(Y;jI*qR^c}[}lc=<exBm(Mzb^S;OusPEktvm?y_Ava^mau?Qpb;><Xd=FWcc^>iO{xPhyva$?lNC(pqs^$@M+[XUa^|]XU?!Azq!<%?sF$@l{q+hwDI(u+)gfKEnW%');
define('LOGGED_IN_SALT', 'bnqqsc-%MT$JKyoRv$Rz>o][VMXF@ILdOs-eM%Hf{n!aJg&^-aBYZs{?wEQB*$;r?ru>@};wu]B*eac<a|s%T!w&Xw<%JbV^@H_%{Esnsgb{!qgfRrc>W(X}]/KfKbk)');
define('NONCE_SALT', '&?X*?K}G|Y]zr}IAd>{{xeWmdwEpXS]Cjb]zUB*=OoRcIaYU<p-Id&uM>@Thc>hckNsF)L@Bb{LRj$EahAF!nG/Ul)nLXDG@m*+lIq>x(lm?A&TrmeCVijB^N%ill/zV');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_xjmi_';

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
