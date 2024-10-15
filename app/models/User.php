<?php

class User
{
    use Model; // Use the Model trait

    protected $table = 'User'; //when using the Model trait, this table name ise used 

    public function createUser($email, $password, $userType, $isPremium, $isActivated)
    {
        $arr = [
            'email' => $email,
            'password' => $password,
            'userType' => $userType,
            'isPremium' => $isPremium,
            'isActivated' => $isActivated,
            'loginAttempt' => 0,
        ];

        return $this->insert($arr);
    }

    public function getUserByUsername($username)
    {
        return $this->first(['email' => $username]);
    }

}
