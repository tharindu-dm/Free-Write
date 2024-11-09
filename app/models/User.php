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

    public function getUserTypeCounts()
    {
        $query = "SELECT
            COUNT(CASE WHEN [userType] = 'reader' THEN 1 END) as readers,
            COUNT(CASE WHEN ([userType] = 'writer' OR [userType] = 'wricov') THEN 1 END) as writers,
            COUNT(CASE WHEN ([userType] = 'covdes' OR [userType] = 'wricov') THEN 1 END) as covdes,
            COUNT(CASE WHEN [userType] = 'pub' THEN 1 END) as pubs,
            COUNT(CASE WHEN [userType] = 'mod' THEN 1 END) as mod,
            COUNT(CASE WHEN ([userType] = 'premread' OR [userType] = 'premwri') THEN 1 END) as premium,
            COUNT(*) as totalUsers,
            (SELECT COUNT(*) FROM [Institution]) as inst
        FROM [dbo].[User];";

        return $this->query(query: $query);
    }

}
