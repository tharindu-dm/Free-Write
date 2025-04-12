<?php

class Publisher {
    use Model;

    protected $table = 'Publisher';
    

    public function insertPublisher($email,$officeEmail, $website, $address, $contactNumber,$dob,$bio, $userID) {
        $userDetails = new UserDetails();
        // Using 'user' instead of 'userID' as the column name
        $userData = $userDetails->first(['user' => $userID]);

        $fullName = $userData['firstName'] . ' ' . $userData['lastName'];
        
        $data = [
            'officeEmail' => $officeEmail,
            'website' => $website,
            'hqaddress' => $address,
            'contactNo' => $contactNumber,
            'pubID' => $userID,
            'dob' => $dob,
            'bio' => $bio,
            'name' => $fullName,
            'email' => $email
        ];

        return $this->insert($data);
    }

    
}
