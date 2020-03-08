<?php
class Wishlist
{
    // DB stuff
    private $conn;
    private $table = 'wishlists';

    // Product properties
    public $id;
    public $title;
    public $cust_id;

    // constructor with DB conn
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // getting all wishlists from DB
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
        $this->title = $row['title'];
        $this->cust_id = $row['cust_id'];
    }

    public function insert_record()
    {
        // DB query
        $sql = "INSERT INTO springtest20." . $this->table;
        $sql .= " (title, cust_id) VALUES ('" . h($this->title) . "', '";
        $sql .= h($this->cust_id) . "');";
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
