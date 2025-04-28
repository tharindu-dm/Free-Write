<?php

class BuyChapter
{
    use Model; // Use the Model trait

    protected $table = 'BuyChapter'; //when using the Model trait, this table name ise used 
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
