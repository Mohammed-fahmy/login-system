<?php


$is_invalid = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    session_start();

    require_once "database_connection.php";

    $q = sprintf("SELECT * FROM user WHERE email = '%s'", $_POST['email']);

    // echo $q;

    $stmt =  $db_connection->Prepare($q);
    $stmt->execute();

    try {
        $data = $stmt->fetchAll();
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        
    } catch (PDOException $e) {
        die("error" . $e->getMessage());
    }
    if ($data) {
        if (password_verify($_POST['password'], $data[0]['password_hash'])) {

            $_SESSION['id'] = $data[0]['id'];

            header("location:index.php");
        }
    }
$is_invalid = true;

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Login System</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css" />
</head>

<body>
    <div style="margin: 100px auto">

    <?php if ($is_invalid) :?>
        <h3>login invalid</h3>
    <?php endif; ?>    
        <form method="POST" novalidate>
            <!-- Email -->
            <div>
                <label for="email">Email : </label>
                <input type="email" id="email" name="email" value="<?=  isset($_POST['email']) ? $_POST['email'] : "" ?>" />
            </div>
            <!-- password -->
            <div>
                <label for="password">Password : </label>
                <input type="password" id="password" name="password" />
            </div>
            <input type="submit" value="login" />
        </form>
    </div>
</body>

</html>