<?php

class CoverImage
{
    use Model; // Use the Model trait

    protected $table = 'CoverImage'; //when using the Model trait, this table name ise used 

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
}
