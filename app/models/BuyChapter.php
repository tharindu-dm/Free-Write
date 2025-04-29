<?php

class BuyChapter
{
    use Model; 

    protected $table = 'BuyChapter';  
    protected $dateTimeColumn = 'purchaseDateTime';

    public function ChapPurchaseStatus($chapterID)
    {
        $arr = null;
        $chapBought = null;
        if (isset($_SESSION['user_id'])) {
            $arr = ['chapter' => $chapterID, 'user' => $_SESSION['user_id']];
            $chapBought = $this->where($arr);
        }

        if ($chapBought) {
            return true;
        } else {
            return false;
        }
    }

}
