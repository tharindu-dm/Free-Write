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

    public function updatePubDetail($bio, $dob, $country, $user_id)
    {
        $data = [
            'bio' => $bio,
            'dob' => $dob,
            'country' => $country
        ];

        return $this->update($user_id, $data, 'user'); // Changed 'userID' to 'user'
    }

    public function getDetails($userId)
    {
        return $this->first(['user' => $userId]);
    }
}
