<?php
class Customer
{
    // DB stuff
    private $conn;
    private $table = 'customers';

    // Product properties
    public $id;
    public $fullname;
    public $username;
    public $email;
    public $phone;
    public $website;

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
        $this->fullname = $row['fullname'];
        $this->username = $row['username'];
        $this->email = $row['email'];
        $this->phone = $row['phone'];
        $this->website = $row['website'];
    }

    public function insert_record()
    {
        // DB query
        $sql = "INSERT INTO springtest20." . $this->table;
        $sql .= " (id, fullname, username, email, phone, website) VALUES ('";
        $sql .= h($this->id) . "', '" . h($this->fullname) . "', '";
        $sql .= h($this->username) . "', '" . h($this->email) . "', '";
        $sql .= h($this->phone) . "', '" . h($this->website) . "');";
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
