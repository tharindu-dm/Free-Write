<?php

class CollectionDetails
{
    use Model;

    protected $table = 'CollectionDetails';

    public function createCollection($data)
    {
        return $this->insert($data);
    }

    public function getCollectionsByUser($userID)
    {
        return $this->where(['userID' => $userID]);
    }

    public function first($conditions)
    {
        $result = $this->where($conditions);
        return $result ? $result[0] : null;
    }
}