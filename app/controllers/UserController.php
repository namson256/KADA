<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
         // Fetch all users from the database
         $users = $this->user->all();

         // Pass the data to the 'users/index' view
         $this->view('users/index', compact('users'));
    }

    public function login()
    {
        $this->view('users/login');
    }

    public function authenticate()
    {
        $user = $this->user->findByEmail($_POST['email']);

        if ($user && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: /');
        } else {
            echo "Invalid credentials.";
        }
    }

    public function register()
    {
        $this->view('users/register');
    }

    public function storeUser()
    {
        if ($_POST['password'] !== $_POST['confirm_password']) {
            die("Passwords do not match.");
        }

        $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $this->user->createAcc([
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $hashedPassword,
        ]);

        header('Location: /login');
    }

    public function logout()
    {
        session_destroy();
        header('Location: /login');
    }

    public function create()
    {
        $this->view('users/create');
    }

    public function store()
    {
        $this->user->create($_POST);
        header('Location: /');
    }

    public function edit($id)
    {
        // Fetch the user data using the ID
        $user = $this->user->find($id);

        // Pass the user data to the 'users/edit' view
        $this->view('users/edit', compact('user'));
    }

    public function update($id)
    {
        $this->user->update($id, $_POST);
        header('Location: /');
    }

    public function delete($id)
    {
        $this->user->delete($id);
        header('Location: /');
    }

    public function back()
    {
        header('Location: /');
    }


}