<?php

class User
{
    use Model; // Use the Model trait

    protected $table = 'User'; //when using the Model trait, this table name ise used 
    /*protected $allowedColumns = [
        'username',
        'password',
        'userType',
        'isPremium',
        'isActivated',
        'loginAttempt',
    ];*/

    public function createUser($username, $password, $userType, $isPremium, $isActivated)
    {
        $arr = [
            'username' => $username,
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
        $arr = [
            'username' => $username,
        ];
        return $this->first(['username' => $username]);
    }

}
