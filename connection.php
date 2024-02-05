<?php
class Database
{
    private $db;

    function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";

        try {
            $this->db = new PDO("mysql:host=$servername;dbname=TaskTest", $username, $password);
            // set the PDO error mode to exception
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function addUnit()
    {
        $unit_name = $_POST['unit_name'];
        $Start = $_POST['Start'];
        $End = $_POST['End'];
        $Rs = $_POST['Rs'];

        $results = []; // Array to store results

        $query = $this->db->prepare("insert into unit (unit_name,Start, End, Rs) VALUES (?, ?, ?,?)");

        foreach ($Start as $index => $Starts) {
            $s_unit_name = $unit_name;
            $s_Start = $Starts;
            $s_End = $End[$index];
            $s_Rs = $Rs[$index];

            $result = $query->execute([$s_unit_name,$s_Start, $s_End, $s_Rs]);

            if ($result) {
                $results[] = true;
            } else {
                $results[] = false;
            }
        }

        return $results;
    }
}

$database = new Database();
?>