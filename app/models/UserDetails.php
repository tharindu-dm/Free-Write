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

    public function getUserDetailsByName($name, $type = 'user')
    {
        $query = "SELECT CONCAT(ud.firstName, ' ', ud.lastName) AS fullName, 
                ud.[profileImage],  ud.[bio], u.[userID],
                u.userType, u.isPremium FROM [dbo].[UserDetails] ud 
                INNER JOIN [dbo].[User] u ON ud.[user] = u.[userID] 
                WHERE u.[userType] != 'admin' 
                AND u.[userType] != 'mod' 
                AND u.[userType] != 'pub' 
                AND u.[userType] != 'inst' AND 
                CONCAT(ud.firstName, ' ', ud.lastName) LIKE '%$name%'";

        switch ($type) {
            case "covdes":
            case "writer":
                $query .= " AND u.[userType] = '$type'";
                break;
            case "user":
            default:
                break;
        }

        return $this->query($query);
    }
}
