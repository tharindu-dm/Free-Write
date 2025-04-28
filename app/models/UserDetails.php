<?php

class UserDetails
{
    use Model;

    protected $table = 'UserDetails';

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

        return $this->update($user_id, $data, 'user');
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
                AND u.[userType] != 'courier'                 
                AND u.[userType] != 'inst' 
                AND CONCAT(ud.firstName, ' ', ud.lastName) LIKE '%$name%'";

        switch ($type) {
            case "covdes":
                $query .= " AND u.[userType] != 'pub' AND u.[userType] = '$type' OR u.[userType] = 'wricov' AND u.[userType] != 'reader'";
                break;
            case "writer":
                $query .= " AND u.[userType] != 'pub' AND u.[userType] = '$type' OR u.[userType] = 'wricov' AND u.[userType] != 'reader'";
                break;
            case "pub":
                $query .= " AND u.[userType] = 'pub' AND u.[userType] != 'wricov' AND u.[userType] != 'writer' AND u.[userType] != 'covdes' AND u.[userType] != 'reader'";
                break;
            case "user":
            default:
                $query .= " AND u.[userType] != 'pub'";
                break;
        }

        return $this->query($query);
    }
}
