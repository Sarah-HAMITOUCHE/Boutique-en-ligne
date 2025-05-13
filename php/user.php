<?php
require_once '../database.php';

class User {
    private $db;
    private $table = 'users';

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    // Inscription utilisateur
    public function register($email, $password, $first_name, $last_name) {
        // Vérifier si l'email existe déjà
        if ($this->findUserByEmail($email)) {
            return false;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $verification_token = bin2hex(random_bytes(32));

        $stmt = $this->db->prepare("
            INSERT INTO $this->table 
            (email, password, first_name, last_name, email_verification_token) 
            VALUES (:email, :password, :first_name, :last_name, :token)
        ");

        return $stmt->execute([
            ':email' => $email,
            ':password' => $hashed_password,
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':token' => $verification_token
        ]);
    }

    // Connexion utilisateur
    public function login($email, $password) {
        $user = $this->findUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            if (!$user['email_verified']) {
                throw new Exception("Veuillez vérifier votre email avant de vous connecter");
            }
            return $user;
        }

        return false;
    }

    // Trouver un utilisateur par email
    public function findUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Trouver un utilisateur par ID
    public function findUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE user_id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Vérifier l'email
    public function verifyEmail($token) {
        $stmt = $this->db->prepare("
            UPDATE $this->table 
            SET email_verified = 1, email_verification_token = NULL 
            WHERE email_verification_token = :token
        ");
        $stmt->execute([':token' => $token]);
        return $stmt->rowCount() > 0;
    }

    // Générer un token de réinitialisation
    public function createPasswordResetToken($email) {
        $user = $this->findUserByEmail($email);
        if (!$user) return false;

        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $stmt = $this->db->prepare("
            UPDATE $this->table 
            SET reset_token = :token, reset_token_expires = :expires 
            WHERE email = :email
        ");

        return $stmt->execute([
            ':token' => $token,
            ':expires' => $expires,
            ':email' => $email
        ]) ? $token : false;
    }

    // Réinitialiser le mot de passe
    public function resetPassword($token, $new_password) {
        $stmt = $this->db->prepare("
            SELECT user_id FROM $this->table 
            WHERE reset_token = :token AND reset_token_expires > NOW()
        ");
        $stmt->execute([':token' => $token]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) return false;

        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("
            UPDATE $this->table 
            SET password = :password, reset_token = NULL, reset_token_expires = NULL 
            WHERE user_id = :id
        ");

        return $stmt->execute([
            ':password' => $hashed_password,
            ':id' => $user['user_id']
        ]);
    }
}
?>