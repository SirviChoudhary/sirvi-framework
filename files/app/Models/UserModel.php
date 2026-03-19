<?php
namespace App\Models;

use App\Core\Model;

class UserModel extends Model
{
    protected $table = 'users';

    /**
     * Find user by email
     */
    public function findByEmail($email)
    {
        return $this->table($this->table)
                    ->where('email', $email)
                    ->first();
    }

    /**
     * Save OTP (insert ya update)
     */
    public function saveOtp($email, $otp)
    {
        $user = $this->findByEmail($email);

        $hashedOtp = password_hash($otp, PASSWORD_DEFAULT);

        if ($user) {
            // update existing user
            return $this->update([
                'id'   => $user['id'],
                'otp'  => $hashedOtp
            ]);
        } else {
            // create new user
            return $this->create([
                'email' => $email,
                'otp'   => $hashedOtp
            ]);
        }
    }

    /**
     * Verify OTP
     */
    public function verifyOtp($email, $otp)
    {
        $user = $this->findByEmail($email);

        if (!$user) {
            return false;
        }

        if (password_verify($otp, $user['otp'])) {
            return $user;
        }

        return false;
    }

    /**
     * Simple login (email only for now)
     */
    public function login($email)
    {
        return $this->findByEmail($email);
    }
}