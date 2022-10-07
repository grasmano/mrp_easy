<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("location:?page=login");
}

$user = $_SESSION['user'];
$user_counter = $user->counter;

if (isset($_POST['logout_submit'])) {
    $user->counter = $_POST['hidden_counter'];
    Users::saveUser($user);
    session_start();
    unset($_SESSION['user']);
    session_destroy();
    header('Location:?page=login');
}

?>

<div>
    <h5>3. Counter web application</h5>
    <div class="col-4 mt-3">
        <div class="row">
            <div class=" col-md-12 text-center">

                <form id="logout_form" name="logout_form" method="post">
                    <div style="font-size: 5rem;" id="user_counter"><?php echo $user_counter ?></div>
                    <input type="hidden" name="hidden_counter" id="hidden_counter" value="<?php echo $user_counter ?>">
                    <h1><?php echo $user->username ?></h1>
                    <button type="button" class="col-12 btn btn-primary mt-3" id="increase_counter"
                            name="increase_counter">+1
                    </button>
                    <input type="submit" class="col-12 btn btn-primary mt-2" name="logout_submit" value="Exit">
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#increase_counter").click(function () {
        var hidden_counter = $("#hidden_counter");
        var user_counter = parseInt(hidden_counter.val());
        user_counter++;
        hidden_counter.val(user_counter);
        $("#user_counter").text(user_counter);
    });
</script>
