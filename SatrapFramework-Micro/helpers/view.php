<?PhP 

# All helper functions used to display views

/**
 * Show a error view with header 
 *
 * @param string $errorCode
 * @return void
 */
function viewError(string $errorCode){
    $filePath = BASE_PATH . "repository/views/errors/{$errorCode}.php";

    header('HTTP/1.0 404 Not Found');

    include $filePath;
    
    die();
}

/**
 * Show a view with data 
 *
 * @param string $sidePath
 * @param array|null $data
 * @return void
 */
function view(string $sidePath , array $data = []){
    extract($data);

    $filePath = realpath(BASE_PATH . "repository/views/{$sidePath}.php");

    include $filePath;
}

