<?php
function emptyFieldsSignup($name, $username, $password, $passwordRepeat){
    $result = null;
    if(empty($name) || empty($username) || empty($password) || empty($passwordRepeat)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function invalidUsername($username){
    $result = null;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function usernameTaken($conn, $username){
    $sql = "SELECT * FROM users WHERE users_username = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup_page.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if(!mysqli_fetch_assoc($resultData)){
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function passwordsMismatch($password, $passwordRepeat){
    $result = null;
    if($password !== $passwordRepeat){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function createUser($conn, $name, $username, $password){
    $sql = "INSERT INTO users(users_name, users_username, users_password) VALUES(?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup_page.php?error=stmtfailed");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $name, $username, $hashedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup_page.php?error=none");
    exit();
}

function emptyFieldsLogin($username, $password){
    $result = null;
    if(empty($username) || empty($password)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function userExists($conn, $username){
    $sql = "SELECT * FROM users WHERE users_username = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../login_page.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function loginUser($conn, $username, $password){
    $userExists = userExists($conn, $username);

    if($userExists === false){
        header("location: ../login_page.php?error=incorrectlogin");
        exit();
    }

    $passwordHashed = $userExists["users_password"];
    $checkPassword = password_verify($password, $passwordHashed);

    if($checkPassword === false){
        header("location: ../login_page.php?error=incorrectpassword");
        exit();
    }else if($checkPassword === true){
        session_start();
        $_SESSION["user_id"] = $userExists["users_id"];
        $_SESSION["user_username"] = $userExists["users_username"];
        $_SESSION["server_picked"] = "";
        header("location: ../index.php");
        exit();
    }
}

function send_message($conn, $username, $message, $userServerName){
    $sql = "INSERT INTO messages(messages_username, messages_message, server) VALUES(?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $username, $message, $userServerName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../index.php?error=none");
    exit();
}

function updateText($conn, $userServerName){
    $sql = "SELECT * FROM messages WHERE server = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $userServerName);
    mysqli_stmt_execute($stmt);
    $messages = mysqli_stmt_get_result($stmt);

    while($row = mysqli_fetch_assoc($messages)){
        echo $row["messages_username"] . ": " . $row["messages_message"] . "\n";
    }

    mysqli_stmt_close($stmt);
}

function createServer($conn, $userServerName, $userServerPassword, $userId){
    $sql = "INSERT INTO servers(servers_name, servers_password) VALUES(?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../create_server.php?error=stmtfailed");
        exit();
    }

    $hashedPassword = password_hash($userServerPassword, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ss", $userServerName, $hashedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    addUserToServer($conn, $userServerName, $userId);

    header("location: ../create_server.php?error=none");
    exit();
}


function addUserToServer($conn, $userServerName, $userId){
    $sql = "UPDATE users SET servers_joined = CONCAT(servers_joined, ?, ', ') WHERE users_id = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../create_server.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $userServerName, $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function getServersList($conn, $userId){
    $sql = "SELECT servers_joined FROM users WHERE users_id = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $servers = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    return $servers["servers_joined"];
}

function serverExists($conn, $userServerName){
    $sql = "SELECT * FROM servers WHERE servers_name = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../join_server.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $userServerName);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function joinServer($conn, $userServerName, $userServerPassword, $userId){
    $serverExists = serverExists($conn, $userServerName);

    if($serverExists === false){
        header("location: ../join_server.php?error=serverdoesntexist");
        exit();
    }

    $passwordHashed = $serverExists["servers_password"];
    $checkPassword = password_verify($userServerPassword, $passwordHashed);

    if($checkPassword === false){
        header("location: ../join_server.php?error=incorrectpassword");
        exit();
    }else if($checkPassword === true){
        addUserToServer($conn, $userServerName, $userId);
        header("location: ../join_server.php?error=none");
        exit();
    }
}

function emptyFieldsJoinServer($userServerName, $userServerPassword){
    $result = null;
    if(empty($userServerName) || empty($userServerPassword)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function alreadyJoinedServer($conn, $userServerName, $userId){
    $sql = "SELECT servers_joined FROM users WHERE users_id = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../join_server.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $serversJoined = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if(str_contains($serversJoined["servers_joined"], $userServerName)){
        return true;
    }

    return false;
}

function emptyFieldsCreateServer($userServerName, $userServerPassword, $userServerPasswordRepeat){
    $result = null;
    if(empty($userServerName) || empty($userServerPassword) || empty($userServerPasswordRepeat)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function getServerMembers($conn, $serverPicked){
    $sql = "SELECT users_username FROM users WHERE servers_joined LIKE ?;";
    $stmt = mysqli_stmt_init($conn);

    $str = "%" . $serverPicked . "%";

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $str);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($members = mysqli_fetch_assoc($result)){
        echo "<li>" . $members["users_username"] . "</li>\n";
    }
    mysqli_stmt_close($stmt);
}