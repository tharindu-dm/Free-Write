<?php

class Collection
{
    use Model; // Use the Model trait

    protected $table = 'Collection'; //when using the Model trait, this table name ise used 

    public function getUserCollections($uid)
    {
        $query = "SELECT 
                    c.[collectionID], 
                    c.[title],
                    c.[isPublic],
                    (
                    SELECT COUNT(*) 
                    FROM [CollectionBook] bc 
                    WHERE bc.collection = c.collectionID
                    ) AS BookCount,
                    (
                    SELECT TOP 1 ci.[name]
                    FROM [CollectionBook] cb
                    INNER JOIN [Book] b ON cb.[book] = b.[bookID]
                    INNER JOIN [CoverImage] ci ON b.[coverImage] = ci.[covID]
                    WHERE cb.collection = c.collectionID
                    ORDER BY cb.[collection] 
                    ) AS ThumbnailImageName
                    FROM [dbo].[Collection] c 
                    WHERE c.[user] = $uid;";

        return $this->query($query);
    }



    public function getCollectionsAndBooks($uid, $book)
    {
        $query = "SELECT 
                    c.[collectionID], 
                    c.[title],
                        CASE 
                            WHEN EXISTS (
                            SELECT 1
                            FROM [dbo].[CollectionBook] bc
                            WHERE bc.[Book] = $book AND bc.[Collection] = c.[collectionID]
                            ) THEN 1
                        ELSE 0
                        END AS BookExist
                    FROM [dbo].[Collection] c
                    WHERE c.[user] = $uid;";

        return $this->query($query);
    }
}
