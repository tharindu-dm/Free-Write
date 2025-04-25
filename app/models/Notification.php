<?php

class Notification
{
    use Model; // Use the Model trait

    protected $table = 'Notification'; //when using the Model trait, this table name ise used 

    public function addNotification($notification)
    {
        $arr = [
            'notification' => $notification,
        ];

        return $this->insert($arr);
    }

    public function deleteNotification($id)
    {
        return $this->delete(['id' => $id]);
    }
}
