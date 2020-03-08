<?php
class WishProduct
{
    // DB stuff
    private $conn;
    private $table = 'wishproducts';

    // Product properties
    public $wish_id;
    public $prod_id;

    // constructor with DB conn
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // getting all wishProducts from DB
    public function read_all()
    {
        // DB query
        $sql = "SELECT * FROM springtest20." . $this->table . ";";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function wish_count()
    {
        // DB query
        $sql = "SELECT wish_id, COUNT(*) as \'N. of items\' FROM springtest20.";
        $sql .= $this->table . " GROUP BY wish_id;";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function insert_record()
    {
        // DB query
        $sql = "INSERT INTO springtest20." . $this->table;
        $sql .= " (wish_id, prod_id) VALUES ('";
        $sql .= h($this->wish_id) . "', '" . h($this->prod_id) . "');";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            return true;
        } else {
            // INSERT failed
            echo mysqli_error($this->conn);
            db_disconnect($this->conn);
            exit;
        }
    }
}
