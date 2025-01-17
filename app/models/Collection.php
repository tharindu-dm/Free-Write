<?php

class Collection
{
    use Model; // Use the Model trait

    protected $table = 'Collection'; //when using the Model trait, this table name ise used 

    public function getUserCollections($uid)
    {
        $query = "SELECT c.[collectionID], c.[title],
       c.[isPublic],
       (SELECT COUNT(*)
        FROM [CollectionBook] bc
        WHERE bc.collection = c.collectionID) AS BookCount
FROM [dbo].[Collection] c WHERE [user] = $uid;";

        return $this->query($query);
    }
}
