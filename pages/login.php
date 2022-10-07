<?php

session_start();
$usernameError = '';
$passwordError = '';
$user = [];

if (isset($_POST['login_submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        if (empty($username)) {
            $usernameError = "Please enter username! ";
        }
        if (empty($password)) {
            $passwordError = "Please enter password! ";
        }
    } else {
        $user = Users::getUserByUsername($username);

        if ($user) {
            if (!password_verify($password, $user->hash)) {
                $passwordError = "Password is incorrect!";
            } else {
                $_SESSION['user'] = $user;
                header("location:?page=user");
            }
        } else {
            $user = Users::createUser($username, $password);
            $_SESSION['user'] = $user;
            header("location:?page=user");
        }
    }
}

?>

<div>
    <h5>3. Counter web application</h5>
    <div class="col-4 mt-3">
        <div class="row">
            <div class=" col-md-12">
                <form id="login_form" name="login_form" method="post" action="?page=login">
                    <div class="form-group mb-3">
                        <label for="username">Username:</label>
                        <input type="text"
                               class="form-control <?php echo (!empty($usernameError)) ? 'is-invalid' : ''; ?>"
                               id="username" name="username"
                               value="<?= isset($_POST["username"]) ? $_POST["username"] : '' ?>">
                        <div class="text-danger"><?php echo $usernameError; ?></div>
                    </div>
                    <div class="form-group mb-3">
                        <div>
                            <label for="password">Password:</label>
                            <input type="password"
                                   class="form-control <?php echo (!empty($passwordError)) ? 'is-invalid' : ''; ?>"
                                   id="password" name="password"
                                   value="<?= isset($_POST["password"]) ? $_POST["password"] : '' ?>">
                        </div>
                        <div class="text-danger"><?php echo $passwordError; ?></div>
                    </div>
                    <button type="submit" class="col-12 btn btn-primary" name="login_submit">Enter</button>
                </form>
            </div>
        </div>
    </div>
</div>