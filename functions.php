<?php

  require_once('dbinfo.inc');


  class adps_functions{

    private function connect(){
      $link = mysqli_connect ( DB_URL, DB_USER, DB_PASS, DB_NAME ) or die ( 'Could not connect: ' . mysqli_error () );
      mysqli_select_db ( $link, DB_NAME ) or die ( 'Could not select database' . mysql_error () );
      return $link;
    }

    public function setIncrement($tableName,$val){
      $link = $this->connect();
      $query=sprintf("ALTER TABLE `".$tableName."` AUTO_INCREMENT = ".$val.";");

      mysqli_query($link, $query);
    }
    public function addUser($username,$password,$access_level){
      $link = $this->connect();
      $query=sprintf("INSERT INTO users(username,password,access_level)
                        VALUES('".mysqli_real_escape_string($link,$username)."','".mysqli_real_escape_string($link,$password)."','".mysqli_real_escape_string($link,$access_level)."')");

      if (!mysqli_query($link, $query)) {
          return mysqli_error($link);
      }else return mysqli_insert_id($link);

    }
    public function editUserDetails($userId,$username,$password,$access_level){
      $link = $this->connect();
      $query=sprintf("UPDATE users
                      SET username = '".mysqli_real_escape_string($link,$username)."',
                      password = '".mysqli_real_escape_string($link,$password)."',
                      access_level = '".mysqli_real_escape_string($link,$access_level)."'
                      WHERE user_id = '".mysqli_real_escape_string($link,$userId)."'");

      if (!mysqli_query($link, $query)) {
          $ret = array("status"=>"failed","message"=>mysqli_error($link));
      }else $ret = array("status"=>"success");

      return $ret;
    }
    public function deactivateUser($userId){
      $link = $this->connect();
      $query=sprintf("UPDATE users
                      SET access_level = '-99'
                      WHERE user_id = '".mysqli_real_escape_string($link,$userId)."'");

      if (!mysqli_query($link, $query)) {
          $ret = array("status"=>"failed","message"=>mysqli_error($link));
      }else $ret = array("status"=>"success");

      return $ret;
    }

    public function addRecord($user_id){
      $link = $this->connect();
      $query=sprintf("INSERT INTO recording(user_id,device)
                        VALUES('".mysqli_real_escape_string($link,$user_id)."','".mysqli_real_escape_string($link,$_SERVER['HTTP_USER_AGENT'])."')");

      if (mysqli_query($link, $query)) {
          return mysqli_insert_id($link);
      }
    }

    public function addSupplier($supplier_name,$address,$contact_number,$record_id){
      $link = $this->connect();
      $query=sprintf("INSERT INTO suppliers(supplier_name,address,contact_number,record_id)
                        VALUES('".mysqli_real_escape_string($link,$supplier_name)."',
                              '".mysqli_real_escape_string($link,$address)."',
                              '".mysqli_real_escape_string($link,$contact_number)."',
                              '".mysqli_real_escape_string($link,$record_id)."')");

      if (!mysqli_query($link, $query)) {
          return mysqli_error($link);
      }else return mysqli_insert_id($link);

    }

    public function editSupplierDetails($supplier_id,$supplier_name,$address,$contact_number,$record_id){
      $link = $this->connect();
      $query=sprintf("UPDATE suppliers
                      SET supplier_name = '".mysqli_real_escape_string($link,$supplier_name)."',
                      address = '".mysqli_real_escape_string($link,$address)."',
                      contact_number = '".mysqli_real_escape_string($link,$contact_number)."',
                      record_id = '".mysqli_real_escape_string($link,$record_id)."'
                      WHERE supplier_id = '".mysqli_real_escape_string($link,$supplier_id)."'");

      if (!mysqli_query($link, $query)) {
          $ret = array("status"=>"failed","message"=>mysqli_error($link));
      }else $ret = array("status"=>"success");

      return $ret;
    }


    public function addCustomer($customer_name,$address,$contact_number,$area_id,$record_id){
      $link = $this->connect();
      $query=sprintf("INSERT INTO customer(supplier_name,address,contact_number,record_id)
                        VALUES('".mysqli_real_escape_string($link,$customer_name)."',
                              '".mysqli_real_escape_string($link,$address)."',
                              '".mysqli_real_escape_string($link,$contact_number)."',
                              '".mysqli_real_escape_string($link,$area_id)."',
                              '".mysqli_real_escape_string($link,$record_id)."')");

      if (!mysqli_query($link, $query)) {
          return mysqli_error($link);
      }else return mysqli_insert_id($link);

    }

    public function editCustomerDetails($customer_id,$customer_name,$address,$contact_number,$area_id,$record_id){
      $link = $this->connect();
      $query=sprintf("UPDATE customer
                      SET customer_name = '".mysqli_real_escape_string($link,$username)."',
                      address = '".mysqli_real_escape_string($link,$password)."',
                      contact_number = '".mysqli_real_escape_string($link,$access_level)."',
                      area_id = '".mysqli_real_escape_string($link,$area_id)."',
                      record_id = '".mysqli_real_escape_string($link,$record_id)."'
                      WHERE customer_id = '".mysqli_real_escape_string($link,$customer_id)."'");

      if (!mysqli_query($link, $query)) {
          $ret = array("status"=>"failed","message"=>mysqli_error($link));
      }else $ret = array("status"=>"success");

      return $ret;
    }


    public function addAccountTitle($account_name,$segment){
      $link = $this->connect();
      $query=sprintf("INSERT INTO account_titles(account_name,segment)
                        VALUES('".mysqli_real_escape_string($link,$account_name)."',
                              '".mysqli_real_escape_string($link,$segment)."')");

      if (!mysqli_query($link, $query)) {
          return mysqli_error($link);
      }else return mysqli_insert_id($link);

    }

    public function editAccountTitle($account_title_id,$account_name,$segment){
      $link = $this->connect();
      $query=sprintf("UPDATE account_titles
                      SET account_name = '".mysqli_real_escape_string($link,$account_name)."',
                      segment = '".mysqli_real_escape_string($link,$segment)."'
                      WHERE account_title_id = '".mysqli_real_escape_string($link,$account_title_id)."'");

      if (!mysqli_query($link, $query)) {
          $ret = array("status"=>"failed","message"=>mysqli_error($link));
      }else $ret = array("status"=>"success");

      return $ret;
    }

    public function addArea($area_name){
      $link = $this->connect();
      $query=sprintf("INSERT INTO areas(area_name)
                        VALUES('".mysqli_real_escape_string($link,$area_name)."')");

      if (!mysqli_query($link, $query)) {
          return mysqli_error($link);
      }else return mysqli_insert_id($link);

    }

    public function editArea($area_id,$area_name){
      $link = $this->connect();
      $query=sprintf("UPDATE areas
                      SET area_name = '".mysqli_real_escape_string($link,$area_id)."'
                      WHERE area_id = '".mysqli_real_escape_string($link,$area_name)."'");

      if (!mysqli_query($link, $query)) {
          $ret = array("status"=>"failed","message"=>mysqli_error($link));
      }else $ret = array("status"=>"success");

      return $ret;
    }

    public function addCashFlow($amount,$particulars,$cf_date,$category,$record_id){
      $link = $this->connect();
      $query=sprintf("INSERT INTO cashflow(amount,particulars,cf_date,category,record_id)
                      VALUES('".mysqli_real_escape_string($link,$amount)."',
                            '".mysqli_real_escape_string($link,$particulars)."',
                            '".mysqli_real_escape_string($link,$cf_date)."',
                            '".mysqli_real_escape_string($link,$category)."',
                            '".mysqli_real_escape_string($link,$record_id)."')");

      if (!mysqli_query($link, $query)) {
          return mysqli_error($link);
      }else return mysqli_insert_id($link);

    }

    public function editCashFlow($cf_id,$amount,$particulars,$cf_date,$category,$record_id){
      $link = $this->connect();
      $query=sprintf("UPDATE cashflow
                      SET amount = '".mysqli_real_escape_string($link,$amount)."',
                      particulars = '".mysqli_real_escape_string($link,$particulars)."',
                      cf_date = '".mysqli_real_escape_string($link,$cf_date)."',
                      category = '".mysqli_real_escape_string($link,$category)."',
                      record_id = '".mysqli_real_escape_string($link,$record_id)."'
                      WHERE cf_id = '".mysqli_real_escape_string($link,$cf_id)."'");

      if (!mysqli_query($link, $query)) {
          $ret = array("status"=>"failed","message"=>mysqli_error($link));
      }else $ret = array("status"=>"success");

      return $ret;
    }

    public function addBankAccount($account_number,$bank_id,$branch,$initial_balance,$current_balance){
      $link = $this->connect();
      $query=sprintf("INSERT INTO bank_accounts(account_number,bank_id,branch,initial_balance,current_balance)
                      VALUES('".mysqli_real_escape_string($link,$account_number)."',
                            '".mysqli_real_escape_string($link,$bank_id)."',
                            '".mysqli_real_escape_string($link,$branch)."',
                            '".mysqli_real_escape_string($link,$initial_balance)."',
                            '".mysqli_real_escape_string($link,$current_balance)."')");

      if (!mysqli_query($link, $query)) {
          return mysqli_error($link);
      }else return mysqli_insert_id($link);

    }

    public function editBankAccount($account_number,$bank_id,$branch,$initial_balance,$current_balance){
      $link = $this->connect();
      $query=sprintf("UPDATE bank_accounts
                      SET bank_id = '".mysqli_real_escape_string($link,$bank_id)."',
                      branch = '".mysqli_real_escape_string($link,$branch)."',
                      initial_balance = '".mysqli_real_escape_string($link,$initial_balance)."',
                      current_balance = '".mysqli_real_escape_string($link,$current_balance)."'
                      WHERE account_number = '".mysqli_real_escape_string($link,$account_number)."'");

      if (!mysqli_query($link, $query)) {
          $ret = array("status"=>"failed","message"=>mysqli_error($link));
      }else $ret = array("status"=>"success");

      return $ret;
    }

    public function addCompanyCheck($check_no,$bank_account_id,$check_date,$amount){
      $link = $this->connect();
      $query=sprintf("INSERT INTO company_checks(check_no,bank_account_id,check_date,amount)
                      VALUES('".mysqli_real_escape_string($link,$check_no)."',
                            '".mysqli_real_escape_string($link,$bank_account_id)."',
                            '".mysqli_real_escape_string($link,$check_date)."',
                            '".mysqli_real_escape_string($link,$amount)."')");

      if (!mysqli_query($link, $query)) {
          return mysqli_error($link);
      }else return mysqli_insert_id($link);

    }

    public function editCompanyCheck($cc_id,$check_no,$bank_account_id,$check_date,$amount){
      $link = $this->connect();
      $query=sprintf("UPDATE company_checks
                      SET check_no = '".mysqli_real_escape_string($link,$check_no)."',
                      bank_account_id = '".mysqli_real_escape_string($link,$bank_account_id)."',
                      check_date = '".mysqli_real_escape_string($link,$check_date)."',
                      amount = '".mysqli_real_escape_string($link,$amount)."'
                      WHERE cc_id = '".mysqli_real_escape_string($link,$cc_id)."'");

      if (!mysqli_query($link, $query)) {
          $ret = array("status"=>"failed","message"=>mysqli_error($link));
      }else $ret = array("status"=>"success");

      return $ret;
    }

    public function addCustomerCheck($check_no,$bank_id,$check_date,$amount,$status){
      $link = $this->connect();
      $query=sprintf("INSERT INTO customer_checks(check_no,bank_id,check_date,amount,status)
                      VALUES('".mysqli_real_escape_string($link,$check_no)."',
                            '".mysqli_real_escape_string($link,$bank_account_id)."',
                            '".mysqli_real_escape_string($link,$check_date)."',
                            '".mysqli_real_escape_string($link,$amount)."',
                            '".mysqli_real_escape_string($link,$status)."')");

      if (!mysqli_query($link, $query)) {
          return mysqli_error($link);
      }else return mysqli_insert_id($link);

    }

    public function editCustomerCheck($cc_id,$check_no,$bank_account_id,$check_date,$amount,$status){
      $link = $this->connect();
      $query=sprintf("UPDATE customer_checks
                      SET check_no = '".mysqli_real_escape_string($link,$check_no)."',
                      bank_id = '".mysqli_real_escape_string($link,$bank_id)."',
                      check_date = '".mysqli_real_escape_string($link,$check_date)."',
                      amount = '".mysqli_real_escape_string($link,$amount)."',
                      status = '".mysqli_real_escape_string($link,$status)."'
                      WHERE cc_id = '".mysqli_real_escape_string($link,$cc_id)."'");

      if (!mysqli_query($link, $query)) {
          $ret = array("status"=>"failed","message"=>mysqli_error($link));
      }else $ret = array("status"=>"success");

      return $ret;
    }

    public function addEmployee($first_name,$last_name,$salary,$type,$position,$date_hired,$status,$remarks,$record_id){
      $link = $this->connect();
      $query=sprintf("INSERT INTO employees(first_name,last_name,salary,type,position,date_hired,status,remarks,record_id)
                      VALUES('".mysqli_real_escape_string($link,$first_name)."',
                            '".mysqli_real_escape_string($link,$last_name)."',
                            '".mysqli_real_escape_string($link,$salary)."',
                            '".mysqli_real_escape_string($link,$type)."',
                            '".mysqli_real_escape_string($link,$position)."',
                            '".mysqli_real_escape_string($link,$date_hired)."',
                            '".mysqli_real_escape_string($link,$status)."',
                            '".mysqli_real_escape_string($link,$remarks)."',
                            '".mysqli_real_escape_string($link,$record_id)."')");

      if (!mysqli_query($link, $query)) {
          return mysqli_error($link);
      }else return mysqli_insert_id($link);

    }

    public function editEmployee($employee_id,$first_name,$last_name,$salary,$type,$position,$date_hired,$status,$remarks,$record_id){
      $link = $this->connect();
      $query=sprintf("UPDATE employees
                      SET first_name = '".mysqli_real_escape_string($link,$first_name)."',
                      last_name = '".mysqli_real_escape_string($link,$last_name)."',
                      salary = '".mysqli_real_escape_string($link,$salary)."',
                      type = '".mysqli_real_escape_string($link,$type)."',
                      position = '".mysqli_real_escape_string($link,$position)."',
                      date_hired = '".mysqli_real_escape_string($link,$date_hired)."',
                      status = '".mysqli_real_escape_string($link,$status)."',
                      remarks = '".mysqli_real_escape_string($link,$remarks)."',
                      record_id = '".mysqli_real_escape_string($link,$record_id)."'
                      WHERE employee_id = '".mysqli_real_escape_string($link,$employee_id)."'");

      if (!mysqli_query($link, $query)) {
          $ret = array("status"=>"failed","message"=>mysqli_error($link));
      }else $ret = array("status"=>"success");

      return $ret;
    }

    public function addExpense($expense_date,$payee,$payee_address,$account_title_id,$amount,$payment_method,$amount_paid,$due_date,$cc_id,$status,$record_id){
      $link = $this->connect();
      $query=sprintf("INSERT INTO expenses(expense_date,payee,payee_address,account_title_id,amount,payment_method,amount_paid,due_date,cc_id,status,record_is)
                      VALUES('".mysqli_real_escape_string($link,$expense_date)."',
                            '".mysqli_real_escape_string($link,$payee)."',
                            '".mysqli_real_escape_string($link,$payee_address)."',
                            '".mysqli_real_escape_string($link,$account_title_id)."',
                            '".mysqli_real_escape_string($link,$amount)."',
                            '".mysqli_real_escape_string($link,$payment_method)."',
                            '".mysqli_real_escape_string($link,$amount_paid)."',
                            '".mysqli_real_escape_string($link,$due_date)."',
                            '".mysqli_real_escape_string($link,$cc_id)."',
                            '".mysqli_real_escape_string($link,$status)."',
                            '".mysqli_real_escape_string($link,$record_id)."')");

      if (!mysqli_query($link, $query)) {
          return mysqli_error($link);
      }else return mysqli_insert_id($link);

    }

    public function editExpense($expense_id,$expense_date,$payee,$payee_address,$account_title_id,$amount,$payment_method,$amount_paid,$due_date,$cc_id,$status,$record_id){
      $link = $this->connect();
      $query=sprintf("UPDATE expenses
                      SET expense_date = '".mysqli_real_escape_string($link,$expense_date)."',
                      payee = '".mysqli_real_escape_string($link,$payee)."',
                      payee_address = '".mysqli_real_escape_string($link,$payee_address)."',
                      account_title_id = '".mysqli_real_escape_string($link,$account_title_id)."',
                      amount = '".mysqli_real_escape_string($link,$amount)."',
                      payment_method = '".mysqli_real_escape_string($link,$payment_method)."',
                      amount_paid = '".mysqli_real_escape_string($link,$amount_paid)."',
                      due_date = '".mysqli_real_escape_string($link,$due_date)."',
                      status = '".mysqli_real_escape_string($link,$status)."',
                      cc_id = '".mysqli_real_escape_string($link,$cc_id)."',
                      record_id = '".mysqli_real_escape_string($link,$record_id)."'
                      WHERE expense_id = '".mysqli_real_escape_string($link,$expense_id)."'");

      if (!mysqli_query($link, $query)) {
          $ret = array("status"=>"failed","message"=>mysqli_error($link));
      }else $ret = array("status"=>"success");

      return $ret;
    }

    public function addInventory($item_id,$quantity,$cost,$trans_date,$record_id){
      $link = $this->connect();
      $query=sprintf("INSERT INTO inventory(item_id,quantity,cost,trans_date,record_id)
                      VALUES('".mysqli_real_escape_string($link,$item_id)."',
                            '".mysqli_real_escape_string($link,$quantity)."',
                            '".mysqli_real_escape_string($link,$cost)."',
                            '".mysqli_real_escape_string($link,$trans_date)."',
                            '".mysqli_real_escape_string($link,$record_id)."')");

      if (!mysqli_query($link, $query)) {
          return mysqli_error($link);
      }else return mysqli_insert_id($link);

    }

    public function editInventory($inv_id,$item_id,$quantity,$cost,$trans_date,$record_id){
      $link = $this->connect();
      $query=sprintf("UPDATE inventory
                      SET item_id = '".mysqli_real_escape_string($link,$item_id)."',
                      quantity = '".mysqli_real_escape_string($link,$quantity)."',
                      cost = '".mysqli_real_escape_string($link,$cost)."',
                      trans_date = '".mysqli_real_escape_string($link,$trans_date)."',
                      record_id = '".mysqli_real_escape_string($link,$record_id)."'
                      WHERE inv_id = '".mysqli_real_escape_string($link,$inv_id)."'");

      if (!mysqli_query($link, $query)) {
          $ret = array("status"=>"failed","message"=>mysqli_error($link));
      }else $ret = array("status"=>"success");

      return $ret;
    }

    public function addItem($item_description,$cost,$record_srp,$display_srp,$quantity,$supplier_id,$record_id){
      $link = $this->connect();
      $query=sprintf("INSERT INTO items(item_description,cost,record_srp,display_srp,quantity,supplier_id,record_id)
                      VALUES('".mysqli_real_escape_string($link,$item_description)."',
                            '".mysqli_real_escape_string($link,$cost)."',
                            '".mysqli_real_escape_string($link,$record_srp)."',
                            '".mysqli_real_escape_string($link,$display_srp)."',
                            '".mysqli_real_escape_string($link,$quantity)."',
                            '".mysqli_real_escape_string($link,$supplier_id)."',
                            '".mysqli_real_escape_string($link,$record_id)."')");

      if (!mysqli_query($link, $query)) {
          return mysqli_error($link);
      }else return mysqli_insert_id($link);

    }

    public function editItem($inv_id,$item_id,$quantity,$cost,$trans_date,$record_id){
      $link = $this->connect();
      $query=sprintf("UPDATE items
                      SET item_description = '".mysqli_real_escape_string($link,$item_description)."',
                      cost = '".mysqli_real_escape_string($link,$cost)."',
                      record_srp = '".mysqli_real_escape_string($link,$record_srp)."',
                      display_srp = '".mysqli_real_escape_string($link,$display_srp)."',
                      quantity = '".mysqli_real_escape_string($link,$quantity)."',
                      supplier_id = '".mysqli_real_escape_string($link,$supplier_id)."',
                      record_id = '".mysqli_real_escape_string($link,$record_id)."'
                      WHERE item_id = '".mysqli_real_escape_string($link,$item_id)."'");

      if (!mysqli_query($link, $query)) {
          $ret = array("status"=>"failed","message"=>mysqli_error($link));
      }else $ret = array("status"=>"success");

      return $ret;
    }

    public function addPosition($position_name){
      $link = $this->connect();
      $query=sprintf("INSERT INTO positions(position_name)
                      VALUES('".mysqli_real_escape_string($link,$position_name)."')");

      if (!mysqli_query($link, $query)) {
          return mysqli_error($link);
      }else return mysqli_insert_id($link);

    }

    public function editPosition($position_id,$position_name){
      $link = $this->connect();
      $query=sprintf("UPDATE positions
                      SET position_name = '".mysqli_real_escape_string($link,$position_name)."'
                      WHERE position_id = '".mysqli_real_escape_string($link,$position_id)."'");

      if (!mysqli_query($link, $query)) {
          $ret = array("status"=>"failed","message"=>mysqli_error($link));
      }else $ret = array("status"=>"success");

      return $ret;
    }

    public function addPurchaseOrder($supplier_id,$po_date,$total_amount,$amount_paid,$terms,$due_date,$payment_method,$status,$cc_id,$record_id){
      $link = $this->connect();
      $query=sprintf("INSERT INTO purchase_orders(supplier_id,po_date,total_amount,amount_paid,terms,due_date,payment_method,status_cc_id,record_id)
                      VALUES('".mysqli_real_escape_string($link,$supplier_id)."',
                            '".mysqli_real_escape_string($link,$po_date)."',
                            '".mysqli_real_escape_string($link,$total_amount)."',
                            '".mysqli_real_escape_string($link,$amount_paid)."',
                            '".mysqli_real_escape_string($link,$terms)."',
                            '".mysqli_real_escape_string($link,$due_date)."',
                            '".mysqli_real_escape_string($link,$payment_method)."',
                            '".mysqli_real_escape_string($link,$status)."',
                            '".mysqli_real_escape_string($link,$cc_id)."',
                            '".mysqli_real_escape_string($link,$record_id)."')");

      if (!mysqli_query($link, $query)) {
          return mysqli_error($link);
      }else return mysqli_insert_id($link);

    }

    public function editPurchaseOrder($po_id,$supplier_id,$po_date,$total_amount,$amount_paid,$terms,$due_date,$payment_method,$status,$cc_id,$record_id){
      $link = $this->connect();
      $query=sprintf("UPDATE purchase_orders
                      SET supplier_id = '".mysqli_real_escape_string($link,$supplier_id)."',
                      po_date = '".mysqli_real_escape_string($link,$po_date)."',
                      total_amount = '".mysqli_real_escape_string($link,$total_amount)."',
                      amount_paid = '".mysqli_real_escape_string($link,$amount_paid)."',
                      terms = '".mysqli_real_escape_string($link,$terms)."',
                      due_date = '".mysqli_real_escape_string($link,$due_date)."',
                      payment_method = '".mysqli_real_escape_string($link,$payment_method)."',
                      status = '".mysqli_real_escape_string($link,$status)."',
                      cc_id = '".mysqli_real_escape_string($link,$cc_id)."',
                      record_id = '".mysqli_real_escape_string($link,$record_id)."'
                      WHERE po_id = '".mysqli_real_escape_string($link,$po_id)."'");

      if (!mysqli_query($link, $query)) {
          $ret = array("status"=>"failed","message"=>mysqli_error($link));
      }else $ret = array("status"=>"success");

      return $ret;
    }

    public function addPOItem($po_id,$item_id,$quantity,$cost){
      $link = $this->connect();
      $query=sprintf("INSERT INTO po_items(po_id,item_id,quantity,cost)
                      VALUES('".mysqli_real_escape_string($link,$po_id)."',
                            '".mysqli_real_escape_string($link,$item_id)."',
                            '".mysqli_real_escape_string($link,$quantity)."',
                            '".mysqli_real_escape_string($link,$cost)."')");

      if (!mysqli_query($link, $query)) {
          return mysqli_error($link);
      }else return mysqli_insert_id($link);

    }

    public function editPOItem($po_item_id,$po_id,$item_id,$quantity,$cost){
      $link = $this->connect();
      $query=sprintf("UPDATE expenses
                      SET po_id = '".mysqli_real_escape_string($link,$po_id)."',
                      item_id = '".mysqli_real_escape_string($link,$item_id)."',
                      quantity = '".mysqli_real_escape_string($link,$quantity)."',
                      cost = '".mysqli_real_escape_string($link,$cost)."'
                      WHERE po_item_id = '".mysqli_real_escape_string($link,$po_item_id)."'");

      if (!mysqli_query($link, $query)) {
          $ret = array("status"=>"failed","message"=>mysqli_error($link));
      }else $ret = array("status"=>"success");

      return $ret;
    }

    public function addSale($customer_id,$sale_date,$total_amount,$amount_paid,$terms,$status,$payment_method,$due_date,$cc_id,$record_id){
      $link = $this->connect();
      $query=sprintf("INSERT INTO sales(supplier_id,po_date,total_amount,amount_paid,terms,due_date,payment_method,status_cc_id,record_id)
                      VALUES('".mysqli_real_escape_string($link,$customer_id)."',
                            '".mysqli_real_escape_string($link,$sale_date)."',
                            '".mysqli_real_escape_string($link,$total_amount)."',
                            '".mysqli_real_escape_string($link,$amount_paid)."',
                            '".mysqli_real_escape_string($link,$terms)."',
                            '".mysqli_real_escape_string($link,$status)."',
                            '".mysqli_real_escape_string($link,$payment_method)."',
                            '".mysqli_real_escape_string($link,$due_date)."',
                            '".mysqli_real_escape_string($link,$cc_id)."',
                            '".mysqli_real_escape_string($link,$record_id)."')");

      if (!mysqli_query($link, $query)) {
          return mysqli_error($link);
      }else return mysqli_insert_id($link);

    }

    public function editSale($sales_id,$customer_id,$sale_date,$total_amount,$amount_paid,$terms,$status,$payment_method,$due_date,$cc_id,$record_id){
      $link = $this->connect();
      $query=sprintf("UPDATE sales
                      SET customer_id = '".mysqli_real_escape_string($link,$customer_id)."',
                      sale_date = '".mysqli_real_escape_string($link,$sale_date)."',
                      total_amount = '".mysqli_real_escape_string($link,$total_amount)."',
                      amount_paid = '".mysqli_real_escape_string($link,$amount_paid)."',
                      terms = '".mysqli_real_escape_string($link,$terms)."',
                      status = '".mysqli_real_escape_string($link,$status)."',
                      payment_method = '".mysqli_real_escape_string($link,$payment_method)."',
                      due_date = '".mysqli_real_escape_string($link,$due_date)."',
                      cc_id = '".mysqli_real_escape_string($link,$cc_id)."',
                      record_id = '".mysqli_real_escape_string($link,$record_id)."'
                      WHERE sale_id = '".mysqli_real_escape_string($link,$sale_id)."'");

      if (!mysqli_query($link, $query)) {
          $ret = array("status"=>"failed","message"=>mysqli_error($link));
      }else $ret = array("status"=>"success");

      return $ret;
    }

    
    public function getBankList(){
      $link = $this->connect();
      $query = "SELECT bank_id,
                        bank_name
                FROM banklist
                ORDER BY bank_name";
      $result = mysqli_query ( $link, $query );
      $data = array();
      while($row =mysqli_fetch_assoc($result))
      {
          $data[] = $row;
      }
      return $data;
    }


  }


?>
