<?php

class CollectionDesigns
{
    use Model;

    protected $table = 'CollectionDesigns';

    public function addDesignToCollection($collectionID, $designID)
    {
        $data = [
            'collectionID' => $collectionID,
            'designID' => $designID,
        ];
        return $this->insert($data);
    }

    public function getDesignsByCollection($collectionID)
    {
        return $this->where(['collectionID' => $collectionID]);
    }

    public function getFirstDesignByCollection($collectionID)
    {
        $designs = $this->where(['collectionID' => $collectionID]);
        return $designs ? $designs[0] : null;
    }

    public function removeDesignFromCollection($collectionID, $designID)
    {
        $sql = "DELETE FROM [{$this->table}] WHERE [collectionID] = :collectionID AND [designID] = :designID";
        return $this->query($sql, ['collectionID' => $collectionID, 'designID' => $designID]);
    }
}