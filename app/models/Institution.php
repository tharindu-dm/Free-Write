<?php

class Institution
{
    use Model;

    protected $table = 'Institution';


    public function addInstitution($data)
    {
        return $this->insert($data);
    }

    public function fetchAllInstitutions()
    {
        return $this->findAll();
    }

    public function updateInstitution($id, $data)
    {
        return $this->update($id, $data, 'institutionId');
    }

    public function deleteInstitution($id)
    {
        return $this->delete($id, 'institutionId');
    }

    public function findInstitutionById($id)
    {
        return $this->first(['institutionId' => $id]);
    }
}

