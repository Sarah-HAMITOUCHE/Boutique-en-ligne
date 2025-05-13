<?php
class Session {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function get($key) {
        return $_SESSION[$key] ?? null;
    }

    public function remove($key) {
        unset($_SESSION[$key]);
    }

    public function destroy() {
        session_destroy();
    }

    public function setUser($user) {
        unset($user['password']);
        $this->set('user', $user);
    }

    public function getUser() {
        return $this->get('user');
    }

    public function isLoggedIn() {
        return !is_null($this->getUser());
    }

    public function isAdmin() {
        $user = $this->getUser();
        return $user && isset($user['is_admin']) && $user['is_admin'];
    }
}
?>