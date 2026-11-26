<?php

require_once __DIR__ . '/../Models/User.php';

class AuthController
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function register()
    {
        $pageTitle = 'Create an Account';
        $isLoggedIn = isset($_SESSION['user_id']);
        $errors = [];
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $firstName = trim($_POST['first_name'] ?? '');
            $lastName = trim($_POST['last_name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if ($firstName === '' || $lastName === '') {
                $errors[] = 'First and last name are required.';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Please enter a valid email address.';
            }

            if ($this->userModel->emailExists($email)) {
                $errors[] = 'This email address is already registered.';
            }

            if (strlen($password) < 8) {
                $errors[] = 'Password must be at least 8 characters.';
            }

            if ($password !== $confirmPassword) {
                $errors[] = 'Passwords do not match.';
            }

            if (empty($errors)) {
                try {
                    $this->userModel->register(
                        $firstName,
                        $lastName,
                        $email,
                        $phone,
                        $password
                    );

                    header('Location: /?page=login&registered=1');
                    exit;

                } catch (PDOException $e) {
                    $errors[] = 'Registration failed. Please try again.';
                    error_log($e->getMessage());
                }
            }
        }

        ob_start();
        require __DIR__ . '/../Views/pages/register.php';
        $content = ob_get_clean();

        require __DIR__ . '/../Views/layouts/main.php';
    }
    public function login(){
        $pageTitle = 'Sign In';
        $isLoggedIn = isset($_SESSION['user_id']);
        $errors = [];

        if (isset($_GET['registered'])) {
            $success = 'Account created successfully. You can now sign in.';
        } else {
            $success = '';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->findByEmail($email);

          if ($user && password_verify($password, $user['password'])) {

    session_regenerate_id(true);

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['first_name'];
    $_SESSION['user_role'] = $user['role'];

    header('Location: /?page=home', true, 303);
    exit;

            } else {
                $errors[] = 'Invalid email address or password.';
            }
        }

        ob_start();

        require __DIR__ . '/../Views/pages/login.php';

        $content = ob_get_clean();

        require __DIR__ . '/../Views/layouts/main.php';
    }
    public function logout()
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();

        header('Location: http://localhost:8080/?page=home', true, 303);
        exit;
    }
}
