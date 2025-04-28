<?php

class HomeController extends Controller
{
    public function index()
    {
        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $advertisement = new Advertisement();
            $ad = $advertisement->first(['status' => 'active']);

            ($ad) ? $_SESSION['user_ads'] = $ad['adImage'] : null;
        }

        $this->view("home"); //calling the view function in /includes/Controller.php to view the homepage
    }

    public function About()
    {
        $this->view("AboutUs");
    }

    public function Terms_of_Service()
    {
        $this->view("TOS");
    }

    public function Privacy_Policy()
    {
        $this->view("PrivacyPolicy");
    }

    public function Feedback()
    {
        $this->view("Feedback");
    }

    public function SendFeedback()
    {
        //validation and checking:
        $feedback = new Feedback();

        $content = $_POST['feedback'] ?? '';
        $contact = $_POST['contact'] ?? 'not provided';
        $recommendation = $_POST['recommend'] ?? '';

        //VALIDATIONS
        $message = "-body: " . $content . " -Recommendation:" . $recommendation . "";

        if (strlen($message) > 600) {
            return;
        }

        $feedback->insert([
            'isRead' => 0,
            'email' => $contact,
            'content' => $message,
            'sentDateTime' => date('Y-m-d H:i:s')
        ]);

        header('Location: /Free-Write/public');
        exit;
    }
}
