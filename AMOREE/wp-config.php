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
define( 'DB_NAME', 'AMOREE' );

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
define( 'AUTH_KEY',         '@k|Zi4-Zvc&b*}SWK;tTe6w*%SrqK_S)`r{><M$6e%5NN8WxEQ[t8~N4WcNX ?eD' );
define( 'SECURE_AUTH_KEY',  '[iyLc6;wcM]izW6|OgBwlF+Ra*^lI$ o&:H<aT,H)B>KuqW+p}{ma%qn^[1h=l{L' );
define( 'LOGGED_IN_KEY',    ';.TO8>t%=L/qmL*V3e8eg^l00[e59uk^s@a2NMnRLRK?Ry`npB]_NPFj^]tgGp[R' );
define( 'NONCE_KEY',        '}IR/0Vyidnwc,&se)c{4X{hW>5cnLELK((1xT-.8h_0YaAv^y5]Fsa[6V-$~Bxm}' );
define( 'AUTH_SALT',        '*M~H$gxIT`<3buH>x0M8h%~Y<rvT[y~Q5((O;K23jD|)2UA+4Jk(4#A@J5Mc}_{i' );
define( 'SECURE_AUTH_SALT', 'D&l1u}ccSls <o&;j!,5W;sM&?Svg$!5aMh,(o5jo`]HS;6?TjF_&k78D^d~rsjp' );
define( 'LOGGED_IN_SALT',   '{6^p~$kIBn4RAj+XM2i;M>kxHSF#>1i9u~@(9/h+1samGZH7+mHDzifvBI<.8G+[' );
define( 'NONCE_SALT',       'cP#R+|VgZ%MCBI^0c5n-24KNxA,o*SN3W6}D/h6gK|~L)M[vur+N.LD; C71yN@|' );
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
