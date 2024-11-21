<?php

class Institution
{
    use Model; // Use the Model trait

    protected $table = 'Institution'; //when using the Model trait, this table name ise used 

    public function getInstByUsername($username)
    {
        return $this->first(['username' => $username]);
    }
}
