<?PhP 
# Defining the codes we need when starting the framework

/* App base path definition */ 
define('BASE_PATH', __DIR__ . '/../');

/* For autoloader execution */
include BASE_PATH . 'vendor/autoload.php';

/* Dotenv library run */
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

/* Object of request for used in all parts of project */
$request = new \App\Core\Request();

/* Include helpers files for use functions */
include BASE_PATH . 'helpers/nicePrint.php';
include BASE_PATH . 'helpers/view.php';

/* Include the web.php file in order to register the allowed routes at the time of program execution */
include BASE_PATH . 'routes/web.php';

