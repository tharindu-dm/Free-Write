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

    /*public function getUserDetails($userID)
    {
        $query = "SELECT CONCAT(ud.firstName, ' ', ud.lastName) AS fullName, ud.dob, ud.regDate, ud.country, ud.bio, ud.lastLogDate, u.userType, u.isPremium FROM [dbo].[UserDetails] ud INNER JOIN [dbo].[User] u ON ud.[user] = u.[userID] WHERE u.userID = $userID";

        return $this->query($query);
    }*/

    public function updatePubDetail($bio, $dob, $country, $user_id) {
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
