<?PhP 
# Defining the codes we need when starting the framework

/**
 * App base path definition
 */ 
define('BASE_PATH', __DIR__ . '/../');

/**
 * For autoloader execution
 */
include BASE_PATH . 'vendor/autoload.php';

/**
 * Dotenv library run
 */
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

