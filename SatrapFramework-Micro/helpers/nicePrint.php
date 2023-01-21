<?PhP 
# Having better print with these function 

/**
 * Print specified data 
 *
 * @param mixed $data
 * @return array|null
 */ 
function dump($data){
    echo "<pre style='background: black; color: #00beff; border-radius: 16px; padding: 15px 10px;'>";
    print_r($data);
    echo "</pre>";
}

/**
 * Print and die specified data
 *
 * @param mixed $data
 * @return array|null
 */
function dd($data){
    dump($data);
    die();
}
