<?php
class Validator {
    // Password must be at least 8 chars, 1 upper, 1 lower, 1 number, 1 special
    public static function isStrongPassword($password) {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password);
    }
}
