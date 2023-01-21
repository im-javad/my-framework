<?PhP 
namespace App\Models;

use App\Models\Contracts\MysqlBaseModel;

class User extends MysqlBaseModel{
    protected $table = 'users';
}


