<?php

class Follow
{
    use Model; // Use the Model trait

    protected $table = 'Follow'; //when using the Model trait, this table name ise used 

    public function getFollowCount($uid)
    {
        $query = "SELECT COUNT(*) as count FROM Follow WHERE FollowedID = $uid";
        $resultSet = $this->query($query); //get the number of followers

        $result['followers'] = isset($resultSet[0]['count']) ? $resultSet[0]['count'] : 0;

        $query = "SELECT COUNT(*) as count FROM Follow WHERE FollowerID = $uid";
        $resultSet = $this->query($query); //get the number of people the user is following

        $result['following'] = isset($resultSet[0]['count']) ? $resultSet[0]['count'] : 0;

        return $result;
    }

    public function getUserDetails($data)
    {
        // Get the first (and only) key from the input array
        $key = key($data);
        $value = $data[$key];

        // get the appropriate column based on the key
        $columnName = ($key === 'FollowerID') ? 'f.[FollowerID]' : 'f.[FollowedID]';
        $joinColumn = ($key === 'FollowerID') ? 'f.[FollowedID]' : 'f.[FollowerID]';
        $query = "SELECT 
                CONCAT(ud.[firstName], ' ', ud.[lastName]) AS userName, 
                ud.[lastLogDate],
                ud.[profileImage],
                ud.[user] 
              FROM Follow f 
              JOIN UserDetails ud ON $joinColumn = ud.[user]
              WHERE $columnName = :value";

        $params = [':value' => $value];
        $resultSet = $this->query($query, $params);

        return $resultSet;
    }

    public function unfollow($data = [])
    {
        $query = "DELETE FROM Follow WHERE FollowerID = :followerID AND FollowedID = :followedID";

        $this->query($query, $data);
        return;
    }
}