<?php


namespace App\Controller;


use App\Repository\UserRepository;

class UserController extends BaseController
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            if (isset($_POST['userEmail']) && ($_POST['userEmail']) !== '' && $_POST['userPassword'] && ($_POST['userPassword']) !== '')
            {
             $user = $this->repository->loadByEmail($_POST['userEmail']);
             if ($user != false){
                 if(md5($_POST['userPassword']) == $user['userPassword'])
                 {
                     session_start();
                     $_SESSION["user"]=$user;
                     if(isset($_SESSION['last_url']))
                     {
                         $target_url = $_SESSION['last_url'];
                     }else{
                         $target_url = "http://localhost/~deni/InventorySystem/public/dashboard";
                     }
                     header("Location:  $target_url") ;
                 }else{
                     die("Грешна парола");
                 }
             }else{
                 die("Няма регистриран потребител с такъв email");
             }
            }

        }
        $this->render('../templates/users/login.php', [
            'hideNav' => true
        ]);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['userEmail']) && ($_POST['userEmail']) !== '' && isset($_POST['userPassword']) && ($_POST['userPassword']) !== ''
                && isset($_POST['firstName']) && $_POST['firstName'] != '' && isset($_POST['lastName']) && $_POST['lastName'] != ''
                && isset($_POST['userRole']) && $_POST['userRole'] != '')
            {

                $userEmail = $_POST['userEmail'];
                $userPassword = (md5($_POST['userPassword']));
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $userRole = $_POST['userRole'];

                $this->repository->addRegister($userEmail, $userPassword, $firstName, $lastName, $userRole);
                header('Location: http://localhost/~deni/InventorySystem/public/dashboard');

            }

            die('error');
        }
        session_start();
        if($user = $_SESSION["user"])
        {
            if($user['userRole'] == 'admin')
            {
                $this->render('../templates/users/register.php', [
                    'button_label' => 'Добави'
                ]);
            }else{
                echo "Нямате администраторски права за да достъпите тази страница!";
            }
        }else{
            $_SESSION['last_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            header('Location: http://localhost/~deni/InventorySystem/public/user/login');
        }

    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: http://localhost/~deni/InventorySystem/public/user/login');
    }


}