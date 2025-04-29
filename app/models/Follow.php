<?php

class Follow
{
    use Model;

    protected $table = 'Follow';

    public function getFollowCount($uid)
    {
        $query = "SELECT COUNT(*) as count FROM Follow WHERE FollowedID = $uid";
        $resultSet = $this->query($query);

        $result['followers'] = isset($resultSet[0]['count']) ? $resultSet[0]['count'] : 0;

        $query = "SELECT COUNT(*) as count FROM Follow WHERE FollowerID = $uid";
        $resultSet = $this->query($query);

        $result['following'] = isset($resultSet[0]['count']) ? $resultSet[0]['count'] : 0;

        return $result;
    }

    public function getUserDetails($data)
    {

        $key = key($data);
        $value = $data[$key];


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

    public function isFollowing($userID, $designerID)
    {
        $result = $this->where(['FollowerID' => $userID, 'FollowedID' => $designerID]);
        return !empty($result);
    }

    public function follow($userID, $designerID)
    {
        return $this->insert(['userID' => $userID, 'designerID' => $designerID]);
    }

    public function unfollow($data = [])
    {
        $query = "DELETE FROM Follow WHERE FollowerID = :followerID AND FollowedID = :followedID";

        $this->query($query, $data);
        return;
    }
}