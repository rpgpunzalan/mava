<?php
  include "functions.php";
  $db = new adps_functions();
  if(isset($_GET['op'])){
    $op = $_GET['op'];

    switch($op){

      case "addUser":{
        if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['access_level'])){
          $user_id = $db->addUser($_POST['username'],$_POST['password'],$_POST['access_level']);
          if(is_numeric($user_id)) echo json_encode(array("status"=>"success", "user_id"=>$user_id));
          else echo json_encode(array("status"=>"failed", "message"=>$user_id));
        }else echo json_encode(array("status"=>"failed", "message"=>"check parameters"));
        break;
      }
      case "editUserDetails":{
        if(isset($_POST['user_id'])&&isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['access_level'])){
          $res = $db->editUserDetails($_POST['user_id'],$_POST['username'],$_POST['password'],$_POST['access_level']);
          if($res->status) echo json_encode(array("status"=>"success"));
          else echo json_encode(array("status"=>"failed", "message"=>$res->message));
        }else echo json_encode(array("status"=>"failed", "message"=>"check parameters"));
        break;
      }
      case "deactivateUser":{
        if(isset($_POST['user_id'])){
          $res = $db->deactivateUser($_POST['user_id']);
          if($res->status) echo json_encode(array("status"=>"success"));
          else echo json_encode(array("status"=>"failed", "message"=>$res->message));
        }else echo json_encode(array("status"=>"failed", "message"=>"check parameters"));
        break;
      }
      case "getBankList":{
        $res = $db->getBankList();
        if(sizeOf($res)>0) echo json_encode(array("status"=>"success","result"=>$res));
        else echo json_encode(array("status"=>"failed", "message"=>$res->message));
        break;
      }
      default:{
        echo json_encode(array("status"=>"failed", "message"=>"operation not found"));
        break;
      }

    }
  }
?>
