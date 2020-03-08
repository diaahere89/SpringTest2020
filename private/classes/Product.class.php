<?php
class Prodcut
{
    // DB stuff
    private $conn;
    private $table = 'products';

    // Product properties
    public $id;
    public $prod_name;
    public $prod_descr;
    public $prod_price;

    // constructor with DB conn
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // getting products from DB
    public function read_all()
    {
        // DB query
        $sql = "SELECT * FROM springtest20." . $this->table . ";";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function read_single($id)
    {
        // DB query
        $sql = "SELECT * FROM springtest20." . $this->table;
        $sql .= " WHERE id = " . h(u($id)) . " LIMIT 1;";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $this->id = $row['id'];
        $this->prod_name = $row['prod_name'];
        $this->prod_descr = $row['prod_descr'];
        $this->prod_price = $row['prod_price'];
    }

    public function insert_record()
    {
        // DB query
        $sql = "INSERT INTO springtest20." . $this->table;
        $sql .= " (id, prod_name, prod_descr) VALUES ('";
        $sql .= h($this->id) . "', '" . h($this->prod_name) . "', '";
        $sql .= h($this->prod_descr) . "');";
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
