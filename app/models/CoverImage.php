<?php

class CoverImage
{
    use Model; // Use the Model trait

    protected $table = 'CoverImage'; //when using the Model trait, this table name ise used 
    protected $dateTimeColumn = 'uploadDate';

    //nalan
    public function getAll()
    {
        return $this->findAll();
    }

    public function getById($id)
    {
        return $this->where(['id' => $id]); // this returns an array
    }

    public function insertDesign($data)
    {
        return $this->insert($data);
    }

    public function updateDesign($id, $data)
    {
        return $this->update($id, $data, 'id');
    }

    public function deleteDesign($id)
    {
        return $this->delete($id, 'id');
    }

    public function getByDesigner($designerId)
    {
        return $this->where(['artist' => $designerId]);
    }

    public function getAllCoverImages()
    {
        // Custom SQL query to fetch all cover images
        $query = "SELECT covID, [name], license, [description], artist FROM {$this->table}";
        return $this->query($query);
    }

    public function getTotalCoverImagesCount()
    {
        $query = "SELECT COUNT(*) as total FROM {$this->table}";
        $result = $this->query($query);
        return $result ? (int) $result[0]['total'] : 0;
    }

    // Get cover images with limit and offset for pagination
    public function getCoverImagesPaginated($limit, $offset)
    {
        $limit = (int) $limit;
        $offset = (int) $offset;
        $query = "SELECT covID, [name], license, [description], artist FROM {$this->table} WHERE artist IS NOT NULL ORDER BY covID DESC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";

        return $this->query($query);
    }

    public function getCoversByName($name)
    {
        $query = "SELECT ci.covID, 
        ci.[name], 
        ci.license, 
        ci.[description], 
        ci.artist,
        CONCAT(u.[firstName], ' ', u.[lastName]) AS [creator] 
        FROM {$this->table} ci
        JOIN [dbo].[UserDetails] u ON ci.[artist] = u.[user] 
         WHERE artist IS NOT NULL AND [name] LIKE '%$name%' ORDER BY covID DESC";

        return $this->query($query);
    }
}
