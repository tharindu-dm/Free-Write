<?php

class Genre
{
    use Model; 

    protected $table = 'Genre';  

    public function getGenres()
    {
        $query = "SELECT * FROM Genre";
        return $this->query($query);
    }
}
