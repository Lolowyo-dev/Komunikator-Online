<?php

namespace Web;

class Auth extends \Application\Main
{
    public function __construct($cmd, $config)
    {
        parent::__construct($cmd, $config);
    }

    public function show()
    {
        $this->addAsset("tailwind.css", "css");
        $this->addAsset("auth.css", "css");

        $Controller = $this->GetInstance('Application\Controller');
        $User = $this->GetInstance('Model\User');

        $err_message = "";

        $formType = 'login';

        //login or register
        if (isset($_POST['form_type'])) {
            $formType = $_POST['form_type'];
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // login user
            if ($formType == 'login') {
                if (isset($_POST['login']) && isset($_POST['password'])) {
                    $login = $_POST['login'];
                    $password = $_POST['password'];

                    $user = $User->login($login, $password);

                    if ($user) {
                        $_SESSION['user'] = $user;
                        $Controller->redirectPage("/Web/Chat");
                    } else {
                        $err_message = "Wrong login or password";
                    }
                }
                // register user
            } elseif ($formType == 'register') {
                if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    if ($User->findByUsername($username)) {
                        $err_message = "Username is already taken";
                        $formType = 'register';
                    } else
                    if ($User->findByEmail($email)) {
                        $err_message = "E-mail is already taken";
                        $formType = 'register';
                    } else
                    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                        $err_message = "Wrong e-mail format";
                        $formType = 'register';
                    } else {
                        $reg = $User->register($username, $email, $password);

                        // login user after registration
                        if ($reg) {
                            $user = $User->login($email, $password);
                            if ($user) {
                                $_SESSION['user'] = $user;
                                $Controller->redirectPage("/Web/Chat");
                            }
                        } else {
                            $err_message = "Registration error";
                        }
                    }
                }
            }
        }


        // loading templates
        $templates = ["header.php", "auth.php", "footer.php"];
        foreach ($templates as $template) {
            $path = $this->getTemplatePath($template);
            if ($path) {
                include $path;
            }
        }
    }
}
