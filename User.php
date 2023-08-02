<?php
require_once 'DBConnect.php';

class User
{
    private $id;
    private $username;
    private $email;
    private $hashedPassword;


    public function __construct($id, $username, $email,$hashedPassword)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->hashedPassword = $hashedPassword;
    }

    public function getPassword()
    {
        return $this->hashedPassword;
    }
    public static function createUser($username, $email, $password)
    {
        $connection = DBConnect::getConnection();
        
        if (self::isUsernameExists($username)) {
            return false; 
        }    
        
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if ($stmt) {
            $stmt->bind_param("sss", $username, $email, $hashedPassword);
            $stmt->execute();
            $stmt->close();
            return true;
        } else {
            return false;
        }
    }

    public static function getUserByUsername($username)
    {
        $connection = DBConnect::getConnection();
        $sql = "SELECT id, username, email, password FROM users WHERE username = ?";
        $stmt = $connection->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($id, $retrievedUsername, $email, $hashedPassword);
    
            if ($stmt->fetch()) {
                $userArray = array(
                    'id' => $id,
                    'username' => $retrievedUsername,
                    'email' => $email,
                    'hashedPassword' => $hashedPassword
                );
    
                $stmt->close();
                $connection->close(); 
                return $userArray;
            } else {
                $stmt->close();
                $connection->close(); 
                return null; 
            }
        } else {
            return null; 
        }
    }

    public static function getUserById($id)
    {
        $connection = DBConnect::getConnection();
        $sql = "SELECT id, username, email, password FROM users WHERE id = ?";
        $stmt = $connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $id); 
            $stmt->execute();
            $stmt->bind_result($userId, $username, $email, $hashedPassword);

            if ($stmt->fetch()) {
                $userArray = array(
                    'id' => $userId,
                    'username' => $username,
                    'email' => $email,
                    'hashedPassword' => $hashedPassword
                );

                $stmt->close();
                $connection->close(); 
                return $userArray;
            } else {
                $stmt->close();
                $connection->close();
                return null; 
            }
        } else {
            return null;
        }
    }

    


    

    private static function isUsernameExists($username)
    {
        $connection = DBConnect::getConnection();
        // Assume you have a 'users' table with a 'username' column
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = $connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            $num_rows = $stmt->num_rows;
            $stmt->close();

            return ($num_rows > 0); // Return true if username exists, otherwise false
        }

        return false;
    }

    // Static method to fetch user data based on the username
   

    // Getters for user properties
    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
