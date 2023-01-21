<?PhP 
namespace App\Models\Contracts;

# To base and organize models

use Medoo\Medoo;

abstract class MysqlBaseModel implements CrudInterface{
    /**
     * Giving table name 
     *
     * @var string
     */
    protected $table;
    
    /**
     * An object of the machine to perform operations in the database
     *
     * @var \Medoo\Medoo
     */
    protected $connection;

    /**
     * Giving table primary key
     *
     * @var string
     */ 
    protected $primaryKey = 'id';

    /**
     * Giving attributes(:
     *
     * @var array|null
     */
    protected $attributes = [];
    
    /* Preparation */
    public function __construct(int $id = null) {
        try{
            $this->connection =new Medoo([
                'type' => $_ENV['DB_driver'],
                'host' => $_ENV['DB_host'],
                'database' => $_ENV['DB_name'],
                'username' => $_ENV['DB_user'],
                'password' => $_ENV['DB_password'],        
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'port' => 3306,
                'command' => [
                    'SET SQL_MODE=ANSI_QUOTES'
                ]
            ]);
        }catch(\Throwable $event){
            echo "ERROR MASSAGE : {$event->getMessage()}";
        }

        if(!is_null($id))
            $this->setAttributes($id);
    }

    /**
     * Create a new data at database
     *
     * @param array $data
     * @return integer
     */
    public function create(array $data) :int{
        $this->connection->insert($this->table, $data);

        return $this->connection->id();
    }

    /**
     * Get data from database
     *
     * @param mixed $columns
     * @param array $where
     * @return array|null
     */
    public function get($columns = null , array $where) :array{
        if(is_null($columns))
            $columns = '*';

        $data = $this->connection->select($this->table, $columns, $where);

        return $data;
    }

    /**
     * Update data from database 
     *
     * @param array $newData
     * @param array $where
     * @return integer
     */
    public function update(array $newData , array $where) :int{
        $data = $this->connection->update($this->table, $newData, $where);

        return $data->rowCount();
    }

    /**
     * Delete data from database
     *
     * @param array $where
     * @return integer
     */
    public function delete(array $where) :int{
        $data = $this->connection->delete($this->table, $where);
        return $data->rowCount();
    }

    /**
     * Giving a data with id from database
     *
     * @param integer $id
     * @return array
     */
    public function findWithId(int $id) :array{
        $data = $this->connection->get($this->table , '*' , [$this->primaryKey => $id]);
        return $data;
    }

    /**
     * Giving all of the data from specified table || database
     *
     * @return array
     */
    public function getAll() :array{
        return $this->connection->select($this->table, '*');
    }

    /**
     * Setting attributes 
     *
     * @param int $id
     */
    public function setAttributes(int $id){
        $result = $this->findWithId($id);
        if(is_null($result))
            return [];
        foreach($result as $column => $value){
            $this->attributes[$column] = $value;
        }
        return $this;
    }

    /**
     * Giving all attributes
     *
     * @return array|null
     */
    public function getAttributes(){
        return $this->attributes;
    }

    /**
     * Giving a attribute
     *
     * @param mixed $key
     * @return array|null
     */
    public function getAttribute($key){
        if(!$key || !key_exists($key , $this->attributes))
            return null;
        return $this->attributes[$key];
    }

    /* Side methodes */
    public function remove(){
        $result = $this->delete([$this->primaryKey => $this->getAttribute($this->primaryKey)]);
        return $result;
    }
    public function __get($key){
        return $this->getAttribute($key);
    }
}


