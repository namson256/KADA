<?php
namespace App\Models;

use App\Core\Model;

class User extends Model
{
    public function all() 
    {
        $stmt = $this->getConnection()->query("SELECT * FROM users"); // Use query() for SELECT statements
        return $stmt->fetchAll(); // Use fetchAll() to get all records
    }

    public function find($id)
    {
        $stmt = $this->getConnection()->prepare("SELECT * FROM users WHERE id = :id"); // Use prepare() for SQL statements with variables
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT); // Use bindParam() to bind variables
        $stmt->execute(); // Use execute() to run the query
        return $stmt->fetch(); // Use fetch() to get a single record
    }

    public function create($data)
    {
        $stmt = $this->getConnection()->prepare("INSERT INTO users (name, email) VALUES (:name, :email)"); // Use prepare() for SQL statements with variables
        $stmt->execute([ // Use execute() to run the query
            ':name' => $data['name'], // Use named placeholders to prevent SQL injection
            ':email' => $data['email'], // Use named placeholders to prevent SQL injection
        ]);
        return $stmt; // Return the PDOStatement object
    }

    public function update($id, $data)
    {
        $stmt = $this->getConnection()->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id"); // Use prepare() for SQL statements with variables
        $stmt->execute([ // Use execute() to run the query
            ':name' => $data['name'], // Use named placeholders to prevent SQL injection
            ':email' => $data['email'], // Use named placeholders to prevent SQL injection
            ':id' => $id, // Use named placeholders to prevent SQL injection
        ]);
        return $stmt; // Return the PDOStatement object
    }

    public function delete($id)
    {
        $stmt = $this->getConnection()->prepare("DELETE FROM users WHERE id = :id"); // Use prepare() for SQL statements with variables
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT); // Use bindParam() to bind variables
        $stmt->execute(); // Use execute() to run the query
        return $stmt; // Return the PDOStatement object
    }

    public function findByEmail($email)
    {
        $stmt = $this->getConnection()->prepare("SELECT * FROM users_reg WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    public function createAcc($data)
    {
        $stmt = $this->getConnection()->prepare(
            "INSERT INTO users_reg (name, email, password) VALUES (:name, :email, :password)"
        );
        $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password' => $data['password'], // Hash the password beforehand
        ]);
    }

//     public function register($data)
//     {
//         $stmt = $this->getConnection()->prepare("INSERT INTO users_reg (name, email, password) VALUES (:name, :email, :password)");
//         $stmt->execute([
//             ':name' => $data['name'],
//             ':email' => $data['email'],
//             ':password' => password_hash($data['password'], PASSWORD_BCRYPT), // Hash the password
//         ]);
//         return $stmt;
//     }

//     public function login($email, $password)
//     {
//         $stmt = $this->getConnection()->prepare("SELECT * FROM users_reg WHERE email = :email");
//         $stmt->execute([':email' => $email]);
//         $user = $stmt->fetch();

//         if ($user && password_verify($password, $user['password'])) {
//             return $user;
//         }
//         return false;
//     }

//     public function authenticate()
// {
//     session_start(); // Start the session

//     // Attempt to authenticate the user
//     $user = $this->user->login($_POST['email'], $_POST['password']);
//     if ($user) {
//         // Store user information in the session
//         $_SESSION['user_id'] = $user['id'];
//         $_SESSION['user_name'] = $user['name'];
//         $_SESSION['user_email'] = $user['email'];

//         // Redirect to the homepage or dashboard
//         header('Location: /');
//     } else {
//         // Display an error message if login fails
//         echo "Invalid email or password.";
//     }
// }

// public function logout()
// {
//     session_start(); // Start the session
//     session_destroy(); // Destroy all session data
//     header('Location: /login'); // Redirect to the login page
// }



}