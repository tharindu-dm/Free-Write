<?php

class CollectionBook
{
    use Model; // Use the Model trait

    protected $table = 'CollectionBook'; //when using the Model trait, this table name ise used 

    public function deleteBookRecord($collection, $book)
    {
        $query = "DELETE FROM [dbo].[CollectionBook] WHERE [Book] = $book AND [collection] = $collection;";
        return $this->query($query);
    }
}
