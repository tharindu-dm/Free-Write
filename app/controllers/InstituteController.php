<?php

class InstituteController extends Controller
{
    public function index()
    {
        $this->Dashboard();
    }

    public function Dashboard(){
        $this->view('Institute/InstituteDashboard');
    }

    public function Register(){
        $user = new User();
        $email = $user->first(['userID'=>$_SESSION['user_id']]);
        $this->view('Institute/InstituteSignUpForm', ['user'=>$email]);
    }

    public function signup(){
        $institution_table = new Institution();
        echo "<script>alert('now in signup funct')</script>";
        $name = $_POST['institutionName'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $subStartDate = date("Y-m-d H:i:s");
        //$subEndDate = nope
        //subplan is fixed
        $creator = $_SESSION['user_id'];
        
        //add a new institution with its own login and pw
        $institution_table->insert(['name'=>$name, 'username'=>$username, 'password'=>$password, 'subStartDate'=>$subStartDate, 'subPlan'=>5,'creator'=>$creator]);

        $user = new User();//updating the user as a creator of an institution
        $user->update($creator, ['userType'=>'inst'], 'userID');

        $this->view('Institute/InstituteDasboard');
    }

    public function read()
    {
        $institutionModel = new Institution();
        $institutions = $institutionModel->fetchAllInstitutions();
        $this->view('institution/InstituteManageUser', ['institutions' => $institutions]);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $institutionModel = new Institution();
            $data = [
                'institutionName' => $_POST['institutionName'],
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                //'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'subStartDate' => $_POST['subStartDate'],
                'subEndDate' => $_POST['subEndDate'],
                'subPlan' => $_POST['subPlan'],
                'Creater' => $_POST['Creater']
            ];

            if ($institutionModel->addInstitution($data)) {
                echo "Institution added successfully!";
            } else {
                echo "Failed to add institution.";
            }
        }

        //$this->view('Institute/addInstitution');
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $institutionModel = new Institution();
            $data = [
                'institutionName' => $_POST['institutionName'],
                'username' => $_POST['username'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'subStartDate' => $_POST['subStartDate'],
                'subEndDate' => $_POST['subEndDate'],
                'subPlan' => $_POST['subPlan'],
                'Creater' => $_POST['Creater']
            ];

            if ($institutionModel->updateInstitution($id, $data)) {
                echo "Institution updated successfully!";
            } else {
                echo "Failed to update institution.";
            }
        }

        $institutionModel = new Institution();
        $institution = $institutionModel->findInstitutionById($id);
        $this->view('editInstitution', ['institution' => $institution]);
    }

    public function delete($id)
    {
        $institutionModel = new Institution();
        if ($institutionModel->deleteInstitution($id)) {
            echo "Institution deleted successfully!";
        } else {
            echo "Failed to delete institution.";
        }
    }
}