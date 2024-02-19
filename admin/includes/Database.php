<?php
require_once("config.php");

class Database
{
    /* properties of variabelen*/
    public $connection;

    /* methods of functions*/
    public function open_db_connection()
    {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (mysqli_connect_errno()) {
            printf("Connectie mislukt: %s\n", mysqli_connect_errno());
            exit();
        }
    }

    public function query($sql, $params = [])
    {
        //create a prepared statement
        //$sql ="select * from users where last_name="vanhoutte" and
        //first_name = "Tom"
        // vanhoutte = s, i, d
        //$sql ="select * from users where last_name = ? and first_name = ?"
        $stmt = $this->connection->prepare($sql);
        //binding van the params
        if (!empty($params)) {
            $types = "";
            $values = [];
            foreach ($params as $param) {
                if (is_int($param)) {
                    $types .= "i";
                } elseif (is_float($param)) {
                    $types .= "d";
                } else {
                    $types .= "s";
                }
                $values[] = $param;

            }
            array_unshift($values, $types);
            call_user_func_array([$stmt, "bind_param"], $this->ref_values($values));
            //execute statement
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    private function ref_values($array)
    {
       $refs = [];
        foreach ($array as $key => $value) {

            if ($key === 0) {
                $refs[$key] = $value;
            } else {
                //Dit wordt gedaan door &$array[$key] te gebruiken. Dit betekent dat in plaats van de waarde zelf, een verwijzing naar de plek in het geheugen waar de waarde wordt bewaard, wordt opgeslagen in $refs.
                $refs[$key] =&$array[$key];
            }
        }
        return $refs;
    }
//            //method chaining
//            $result = $this->connection->query($sql);
//            $this->confirm_query($result);
//            return $result;


    private function confirm_query($result)
    {
        if (!$result) {
            die("Query kan niet worden uitgevoerd " . $this->connection->error);
        }
    }

    public function escape_string($string) {
        if(is_string($string)) {
            return $this->connection->real_escape_string($string);
        }
        return $string;
    }


    /*constructors*/
    function __construct()
    {
        $this->open_db_connection();
    }
}

$database = new Database();
?>