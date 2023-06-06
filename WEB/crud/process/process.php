<?php
include 'class/cuser.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action){
    case 'new':
        create_new_user();
        break;
    case 'update' :
        update_user();
        break;
    case 'deactivate':
        deactivate_user();
        break;
}

function create_new_user(){
    $user = new user();
    $email = $_POST['email'];
    $Lname = ucword($_POST['Lname']);
    $Fname = ucword($_POST['Fname']);
    $password = $_POST['Password'];
    $confirmpassword = $_POST['confirmpassword'];

    $result = $user->new_user($email, $password, $Lname, $Fname);
    if($result){
        $id = $user->get_user_id($email);
        header('location: ../index.php?page=settings&subpage=users&action=profile&id='.$id);
    }
}
function update_user(){
	$user = new User();
    $user_id = $_POST['userid'];
    $lastname = ucwords($_POST['lastname']);
    $firstname = ucwords($_POST['firstname']);
    $access = ucwords($_POST['access']);
   
    
    $result = $user->update_user($lastname,$firstname,$access,$user_id);
    if($result){
        header('location: ../index.php?page=settings&subpage=users&action=profile&id='.$user_id);
    }
}

function deactivate_user(){
	$user = new User();
    $user_id = $_POST['userid']; 
    $result = $user->deactivate_user($user_id);
    if($result){
        header('location: ../index.php?page=settings&subpage=users&action=profile&id='.$user_id);
    }
}
