<?php 
function loginform(){
    print_start('login','login');
    echo<<<HTML
    <div class="kontainer-login">
        <div class="title-login">
        <h3 class="login-admin">Login Admin</h3>
        </div>
        <div class="groupform">
        <form action="" method="POST">
            <input type="hidden" name="login">
            <label for="username">Username:</label> 
            <input type="text" name="username" id="username">
            <label  for="password">Password:</label>
            <input type="password" name="password"  id="password">
            <button type="submit"> Login </button>
        </form>
        </div>

        </div>
    HTML;
}

function validate($username, $password){
//   check apakah  ini valid atau tidak
global $db;
try{
$cekuser = "SELECT * FROM admins WHERE username = :user ";
$stmt= $db->prepare($cekuser);
$stmt->bindParam(':user',$username);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($user);
if($user && password_verify($password,PASSWORD_DEFAULT)){
    echo'berhasil login';
}else{
echo'salah';
}
}catch(Exception $e){
    echo"error: " . $e->getMessage();
}
}
// regitser 
function regis(){
    print_start('regis','login');
    echo<<<HTML
    <div class="kontainer-regiter">
        <div class="title-register">
        <h3 class="regitser-admin">regitser Admin</h3>
        </div>
        <div class="groupform">
        <form action="" method="POST">
            <input type="hidden" name="register">
            <label for="username">Username:</label> 
            <input type="text" name="username" id="username">
            <label  for="password">Password:</label>
            <input type="password" name="password"  id="password">
            <button type="submit"> register </button>
        </form>
        </div>

        </div>
    HTML;
}
// form register apabila admin gak ada sama sekali
function isAdminsTableEmpty() {
    global $db;
    try {
        $query = "SELECT COUNT(*) as total FROM admins";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result['total'] == 0;

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false; 
    }
}

function registeradmin($username,$password){
    global $db;
    // insert to dattabase

    $user = strtolower($username);
    $passwordhash= password_hash($password,PASSWORD_DEFAULT);
    try{
    $register = "INSERT INTO admins(username,password) values(:user,:pass)";
    $stmt =$db->prepare($register);
    $stmt->bindParam(':user',$user);
    $stmt->bindParam(':pass',$passwordhash);
    $stmt->execute();
    }catch(Exception $e){
        echo'Error: ' . $e->getMessage();
    }
}
