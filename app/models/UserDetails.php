<?php

class UserDetails
{
    use Model; // Use the Model trait

    protected $table = 'UserDetails'; //when using the Model trait, this table name ise used 

    public function addUserDetails($user, $firstName, $lastName, $regDate, $lastlogin)
    {
        $arr = [
            'user' => $user,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'regDate' => $regDate,
            'lastLogDate' => $lastlogin,

        ];

        return $this->insert($arr);
    }

    public function getUserDetails(){

    }

}
