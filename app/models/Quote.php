<?php

class Quote
{
    use Model; // Use the Model trait for database interaction

    protected $table = 'Quote'; // Specify the table name

    public function addQuote($chapter, $quote)
    {
        $query = "INSERT INTO $this->table (chapter, quote) VALUES (:chapter, :quote)";
        $params = [
            ':chapter' => $chapter,
            ':quote' => $quote,
        ];
        return $this->query($query, $params);
    }

    public function getQuotes($chapter = null)
    {
        if ($chapter) {
            $query = "SELECT * FROM $this->table WHERE chapter = :chapter";
            $params = [':chapter' => $chapter];
        } else {
            $query = "SELECT * FROM $this->table";
            $params = [];
        }

        return $this->query($query, $params);
    }

    public function getQuoteByID($quoteID)
    {
        $query = "SELECT * FROM $this->table WHERE quoteID = :quoteID";
        $params = [':quoteID' => $quoteID];
        $result = $this->query($query, $params);
        return $result ? $result[0] : null;
    }
}

