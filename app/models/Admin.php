<?php

class User
{
    use Model; // Use the Model trait

    protected $table = 'Admin'; //when using the Model trait, this table name ise used 

    //no admin create function
}