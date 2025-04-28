<?php

class Notification
{
    use Model; 

    protected $table = 'Notification';  

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
