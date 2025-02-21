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
}
