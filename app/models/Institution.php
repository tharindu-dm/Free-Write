<?php

class Institution
{
    use Model; // Use the Model trait

    protected $table = 'Institution'; //when using the Model trait, this table name ise used 


    public function addInstitution($data)
    {
        // Inserts a new institution into the database
        return $this->insert($data);
    }

    public function fetchAllInstitutions()
    {
        // Retrieves all institutions from the database
        return $this->findAll();
    }

    public function updateInstitution($id, $data)
    {
        // Updates an institution's details by ID
        return $this->update($id, $data, 'institutionID');
    }

    public function deleteInstitution($id)
    {
        // Deletes an institution from the database by ID
        return $this->delete($id, 'institutionID');
    }

    public function findInstitutionById($id)
    {
        // Retrieves a specific institution by ID
        return $this->first(['institutionID' => $id]);
    }
}

