<?php

class index // Представим будто это Player из 2D игры
{
    private $health;
    private $damage;
    private $name;
    private $lvl;

    public function __construct($name, $health, $damage, $lvl)
    {
        $this->name = $name;
        $this->health = $health;
        $this->damage = $damage;
        $this->lvl = $lvl;
    }

    public function save()
    {
        $conn = new PDO("mysql:host=localhost;dbname=gamePlayers", 'elergard', '13254');

        $newPlayer = "Insert Into players(name, health, damage, lvl) Values(?, ?, ?, ?)";
        $addPlayer = $conn->prepare($newPlayer);
        $addPlayer->execute(array($this->name, $this->health, $this->damage, $this->lvl));
    }

    public function remove()
    {
        $conn = new PDO("mysql:host=localhost;dbname=gamePlayers", 'elergard', '13254');

        $deletePlayer = "Delete from players where nameChar = ?";
        $delPlayer = $conn->prepare($deletePlayer);
        $delPlayer->execute(array($this->name));
    }

    public function getById($ID): index
    {
        $conn = new PDO("mysql:host=localhost;dbname=gamePlayers", 'elergard', '13254');

        $getPlayer = $conn->prepare("Select * from players where id = ? ");
        $getPlayer->execute();
        $row = $getPlayer->fetchAll();

        return new index($row['name'],$row['health'],$row['damage'],$row['lvl']);
    }

    public function All(): array {
        $conn = new PDO("mysql:host=localhost;dbname=gamePlayers", 'elergard', '13254');

        $getAllPlayers = $conn->prepare("SELECT * FROM players");
        $getAllPlayers->execute();
        $row = $getAllPlayers->fetchAll();

        return $row;
    }

    public function getByField($field, $fieldValue): array
    {
        $conn = new PDO("mysql:host=localhost;dbname=gamePlayers", 'elergard', '13254');

        $getPlayerByField = $conn->prepare("Select ? from players where ? = ? ");
        $getPlayerByField->execute(array($field, $field, $fieldValue));
        $row = $getPlayerByField->fetchAll();
        return $row;
    }
}