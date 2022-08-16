<?php

class RegisterEvent
{
    private $conn;
    private $table = 'event_clear_sky';
    public $name;
    public $email;
    public $town;
    public $date_time;
    public $comment;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //GET Register Even
    public function read()
    {
        $query = 'SELECT * FROM ' . $this->table;
        $statement = $this->conn->prepare($query);
        $statement->execute();
        return $statement;
    }

    //create Api for register event
    public function create()
    {

        $query = 'INSERT INTO ' . $this->table .'
        SET name = :name,
        email= :email,
        town = :town,
        comment = :comment,
        date_time = :date_time';

        $statement = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->town = htmlspecialchars(strip_tags($this->town));
        $this->comment = htmlspecialchars(strip_tags($this->comment));
        $this->date_time = htmlspecialchars(strip_tags($this->date_time));

        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':town', $this->town);
        $statement->bindParam(':comment', $this->comment);
        $statement->bindParam(':date_time', $this->date_time);
        if ($statement->execute()) {
            return true;
        }
        print_r('Error %s. \n'.$statement->error);
        return false;

    }


}