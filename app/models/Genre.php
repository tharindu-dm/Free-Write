<?php

class Genre
{
    use Model; // Use the Model trait

    protected $table = 'Genre'; //when using the Model trait, this table name ise used 

    public function getGenres()
    {
        $query = "SELECT * FROM Genre";
        return $this->query($query);
    }
}
