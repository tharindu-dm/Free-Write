<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function authenticate($username, $password) {
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
?>