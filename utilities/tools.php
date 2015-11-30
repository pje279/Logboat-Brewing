<?php

function say($text) {
    echo "$text<br>";
}

function printReadOnly($key, $value = '') {
    echo "<div class='form-group'>";
    echo "<label for='$key'>$key</label>";
    echo "<input type='text' class='form-control' id='$key' value='$value' readonly>";
    echo "</div>";
}

function printTextInput($key, $value = '') {
    echo "<div class='form-group'>";
    echo "<label for='$key'>$key</label>";
    echo "<input type='text' class='form-control' id='$key' name='$key' value='$value' required>";
    echo "</div>";
}

function printNumberInput($key, $value = '') {
    echo "<div class='form-group'>";
    echo "<label for='$key'>$key</label>";
    echo "<input type='number' class='form-control' id='$key' name='$key' value='$value' required>";
    echo "</div>";
}

class Database {
    protected $dbname = "logboatDB";
    protected $username = "be1dbd64a86c89";
    protected $password = "3b83625d";
    protected $host = "us-cdbr-azure-central-a.cloudapp.net";
    protected $port = 3306;
    
    public static function runQuery($queryStr, $bind_params = array()) {
        try {
            $connection = new PDO(  "mysql:host=" . $this->host
                                    . ";dbname=" . $this->dbname
                                    . ";port=" . $this->port
                                    , $this->username
                                    , $this->password
            );
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch(PDOException $e) {
            echo "PDO Connection Exception: " . $e->getMessage();
        }
        
        try {
            $stmt = $connection->prepare($queryStr);
            $stmt->execute($bind_params);
            
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return data;
        } catch(PDOException $e) {
            echo "PDO Query Exception: " . $e->getMessage();
        }
    }
}