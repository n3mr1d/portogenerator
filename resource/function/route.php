<?php
function route(){
    $path = $_SERVER['REQUEST_URI'];
    
    if(isset($_POST['inputproject'])) {
        handleProjectSubmission();
        return; // Exit after handling submission
    }elseif(isset($_POST['username']) && isset($_POST['login'])){
        validate($_POST['username'], $_POST['password']);
        return;
    }elseif(isset($_POST['username']) && isset($_POST['register'])){
        if(isAdminsTableEmpty()){
            registeradmin($_POST['username'],$_POST['password']);
            loginform();
            exit;
        }else{
            loginform();
            return;
        }
  }elseif(isset($_POST['action']) && $_POST['action']== 'delete'){
  del($_POST['id']);
  }elseif(isset($_POST['action']) && $_POST['action']=='update'){
    update($_POST['id']);
  }elseif(isset($_POST['action']) && $_POST['action']=="addcry"){
    addcry($_POST['name'],$_POST['address'],$_POST['icon']);
  }
  $get = $_GET;
  if(isAdminsTableEmpty()){
        regis();
    }elseif($path == "/index.php" || $path == "/"){
     showhome();
    }elseif($path == "/login"){
        loginform();
    }elseif($path == "/add-project"){
        showaddprojectform();
    }elseif($get['action'] == 'edit'){
    editingpage($get['id']);
    }elseif($path=="/donate"){
    showdonate();
  }elseif($path == "/settings"){
    showsettings();
  }else{
    showhome();
  }
}
