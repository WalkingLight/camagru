<?PHP

define('ROOT_FUNC', $_SERVER['DOCUMENT_ROOT'] . '/camagru/functions/');
define('ROOT_CONFIG', $_SERVER['DOCUMENT_ROOT'] . '/camagru/config/');
$directory = basename(dirname(dirname(__FILE__)));
$url = explode($directory, $_SERVER['REQUEST_URI']);
define('ROOT', $url[0] . $directory . '/');
define('IMAGES', ROOT . '/' . 'img');

require ROOT_CONFIG . 'database.php';
require ROOT_FUNC . 'funct.php';
require ROOT_FUNC . 'email.php';
require ROOT_FUNC . 'session.php';

?>