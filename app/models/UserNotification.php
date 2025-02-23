<?php

class UserNotification
{
    use Model; // Use the Model trait

    protected $table = 'UserNotification'; //when using the Model trait, this table name ise used 


    public function getUserNotifications($userID)
    {
        $query = "SELECT * FROM [UserNotification] un
          JOIN [Notification] n ON un.[notification] = n.[notificationID]
          WHERE un.[user] = $userID";

        // Debug log
        error_log("Executing query: " . $query);

        $result = $this->query($query);
        error_log("Query result: " . print_r($result, true));

        return is_array($result) ? $result : [];
    }


}
