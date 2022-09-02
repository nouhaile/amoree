<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'projetmiles' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '~%O%,%$WG:bk6=AS_b#V8;R@Wl01G:jQx#`gX$K&H;Jfs!SPaL2_m~xb*Tao?s.2' );
define( 'SECURE_AUTH_KEY',  '7{x#&lFw=h}%-^D/#_#!.)IiMrI|ES,AFs-`~1VZ-/~}T_prB3g2r1uWgO_Q4Q%t' );
define( 'LOGGED_IN_KEY',    '[y].mJd3!?`I>c2ZPEQ:WqUqs!6(gg.*uR&_S`aVPArc1&HWFN-vNe.9vyAwNsH_' );
define( 'NONCE_KEY',        'Gx5v(qBMoIYc`^mlGxAu^lch[C}3;!L!p.1]FTw8L]{A]<9e1_aqP]hrT`4o0pn<' );
define( 'AUTH_SALT',        'lRl&0`k+.lP_n=]9L,P{q;go/a%Ikc^;ma(s#HKP{/!FR0b<{.Ujg>4cKNWpQ]9N' );
define( 'SECURE_AUTH_SALT', '0bK%iKCt~JbVeG-kWI2d{;cH^dO[AlbfQ5i($RJ&QX,bm2As5;@5@b w(*_j]s>9' );
define( 'LOGGED_IN_SALT',   '{^]HUm02ZNSo&Yl77VCar)%%|CPg|G]@F{=aL9!$?Q^,VUz<WQAE4xk<$QaY1]&,' );
define( 'NONCE_SALT',       'z;^~5NZ1DbHC}kJ &j66?^G!^riu9^{*36Ybnlxb9gAQN^6r1h,~W@(<[dFs9c$w' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
