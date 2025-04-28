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

    public function getUserTypeCounts()
    {
        $query = "SELECT
            COUNT(CASE WHEN [userType] = 'reader' THEN 1 END) as readers,
            COUNT(CASE WHEN ([userType] = 'writer' OR [userType] = 'wricov') THEN 1 END) as writers,
            COUNT(CASE WHEN ([userType] = 'covdes' OR [userType] = 'wricov') THEN 1 END) as covdes,
            COUNT(CASE WHEN [userType] = 'pub' THEN 1 END) as pubs,
            COUNT(CASE WHEN [userType] = 'mod' THEN 1 END) as mod,
            COUNT(CASE WHEN [userType] = 'courier' THEN 1 END) as courier,
            COUNT(CASE WHEN [userType] = 'inst' THEN 1 END) as inst,
            COUNT(CASE WHEN ([isPremium] = 1) THEN 1 END) as premium,
            COUNT(*) as totalUsers
            -- ,(SELECT COUNT(*) FROM [Institution]) as inst
        FROM [dbo].[User];";

        return $this->query(query: $query);
    }

    public function getInstituteUsers($instName)
    {
        $query = "SELECT
            u.[userID], 
            u.[email],
            ud.[firstName],
            ud.[lastName],
            ud.[firstName] + ' ' + ud.[lastName] AS fullName,
            ud.[lastLogDate]
            FROM 
            [dbo].[User] u
            JOIN 
            [dbo].[UserDetails] ud ON u.[userID] = ud.[user]
            WHERE 
            u.[email] LIKE '%@%usr.$instName.fw'";

        return $this->query($query);
    }


    public function updateToPub($userType, $user_id)
    {
        $data = [
            'userType' => $userType
        ];
        return $this->update($user_id, $data, 'userID');
    }


    public function getUserByName($name)
    {
        $query = "SELECT u.* FROM [dbo].[User] u
        RIGHT JOIN [dbo].[UserDetails] ud ON u.[userID] = ud.[user]
        WHERE ud.[firstName] LIKE '%$name%' OR ud.[lastName] LIKE '%$name%'";
        return $this->query($query);
    }

    public function getNormalUsers()
    {
        $query = "SELECT * FROM [dbo].[User] WHERE [userType] != 'admin' AND [userType] != 'mod' AND [userType] != 'pub' AND [userType] != 'inst' ";

        return $this->query($query);
    }

    //nalan
    public function updateUserTypeToCovdes($userID)
    {
        $data = [
            'userType' => 'covdes'
        ];
        return $this->update($userID, $data, 'userID');
    }

    public function updateUserTypeToWricov($userID)
    {
        $data=['userType' => 'wricov'];
        return $this->update($userID, $data, 'userID');
    }

    public function getCoverDesigners()
    {
        $query = "SELECT u.[userID], u.[email], u.[userType], ud.[firstName], ud.[lastName], ud.[profileImage]
                FROM [dbo].[User] u
                JOIN [dbo].[UserDetails] ud ON u.[userID] = ud.[user]
                WHERE u.[userType] IN ('covdes', 'wricov') AND u.[isActivated] = 1";
        return $this->query($query);
    }

    public function getTotalCoverDesignersCount()
    {
        $query = "SELECT COUNT(*) as total FROM [dbo].[User] WHERE [userType] IN ('covdes', 'wricov') AND [isActivated] = 1";
        $result = $this->query($query);
        return $result ? (int) $result[0]['total'] : 0;
    }

    public function getCoverDesignersPaginated($limit, $offset)
    {
        $limit = (int) $limit;
        $offset = (int) $offset;
        $query = "SELECT u.[userID], u.[email], u.[userType], ud.[firstName], ud.[lastName], ud.[profileImage]
                  FROM [dbo].[User] u
                  JOIN [dbo].[UserDetails] ud ON u.[userID] = ud.[user]
                  WHERE u.[userType] IN ('covdes', 'wricov') AND u.[isActivated] = 1
                  ORDER BY u.[userID] DESC
                  OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
        return $this->query($query);
    }
}
