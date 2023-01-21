<?PhP 
namespace App\Controllers; 

class HomeController{
    /**
     * Show the home page
     *
     * @return void
     */
    public function index(){
        return view('home');
    }
}
