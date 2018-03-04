<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa user o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações
// com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'small36_adfas');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'small36_adfas');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'Small@123');

/** Nome do host do MySQL */
define('DB_HOST', 'small36_adfas.mysql.dbaas.com.br');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'C_hn+w[QQz!Xb]+4(i>S|>ndYYJEl(;`GxO2K:[?)w&x,qL>&=2q7y7x66Baq 4c');
define('SECURE_AUTH_KEY',  '`tm4ZVAnZqwRVWrB7}p+=cQq&OfdWTdsh>E;gyItxY@qmoR~Zbwb.xya<Yqm7+h/');
define('LOGGED_IN_KEY',    'U94ND0?_&g^J5K*l/6AtB#<E$^.Gu,}nw]?#Q=i?Yh`q6r{niFJ=q&J!cQmSuCAG');
define('NONCE_KEY',        'T?kSmPdY,U/XRO7tF<=amD@*b?wZSbMMUs-nw#XH1tkU~XU!vfbufq=GG!EpFW&#');
define('AUTH_SALT',        'YQZq$1(0<NYRT{vS&Sesf6!Rn:G_cu:2*HPFZ|/O+[UF5)6El-|)V#D+A:{aq;9Q');
define('SECURE_AUTH_SALT', '`h`hU$aaW[Bt9*G1~PiU/<aAK<%@~gQkC%w#h ={b&RXgrQSa~1KZFF.|Vfi0&x1');
define('LOGGED_IN_SALT',   'vFz9E9,^a]$nOrG)YEJ>Wo^`Pd agRc%^ggv/XjyA0*w=+OzAcC#xEQB4|,42pAT');
define('NONCE_SALT',       'L3/Fe]|Q#)O2-GTir+,P=!>-ib_UK;Rx[GHQwR+ZG{f]<$r?-=ed`c4`PQvNTzM%');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * para cada um um único prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
