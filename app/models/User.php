<?php

class User
{
    use Model;

    protected $table = 'User';
    protected $allowedColumns = [
        'username',
        'password',
        'userType',
        'isPremium',
        'isActivated',
        'loginAttempt',
    ];

}
