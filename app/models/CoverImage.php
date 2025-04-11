<?php

class CoverImage
{
    use Model; // Use the Model trait

    protected $table = 'CoverImage'; //when using the Model trait, this table name ise used 

    public function getAll() {
        return $this->findAll();
    }

    public function getById($id) {
        return $this->where(['id' => $id]); // this returns an array
    }

    public function insertDesign($data) {
        return $this->insert($data);
    }

    public function updateDesign($id, $data) {
        return $this->update($id, $data, 'id'); // Make sure 'id' is your PK
    }

    public function deleteDesign($id) {
        return $this->delete($id, 'id'); // Make sure 'id' is your PK
    }

    public function getByDesigner($designerId)
    {
        return $this->where(['artist' => $designerId]);
    }

}

//chatgpt
// <?php

// class CoverPageDesign extends Model {
//     protected $table = "CoverPageDesigns"; // Make sure this matches your DB table

//     public function getAll() {
//         return $this->findAll();
//     }

//     public function getById($id) {
//         return $this->where(['id' => $id]); // this returns an array
//     }

//     public function insertDesign($data) {
//         return $this->insert($data);
//     }

//     public function updateDesign($id, $data) {
//         return $this->update($id, $data, 'id'); // Make sure 'id' is your PK
//     }

//     public function deleteDesign($id) {
//         return $this->delete($id, 'id'); // Make sure 'id' is your PK
//     }
// }

