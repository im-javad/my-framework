<?PhP 
namespace App\Models\Contracts;

# Implementing a interface to standardize database queries

interface CrudInterface{
    /* C : insert data to database */
    public function create(array $data) :int;
    /* R : get data from database */
    public function get($columns , array $where) :array;
    /* U : update data from database */
    public function update(array $newData , array $where) :int;
    /* D : delete data from database */
    public function delete(array $where) :int;
}

