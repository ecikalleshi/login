<?php
class Login_model extends CI_Model
{
 
  function validate($email,$password)
  {
    $this->db->where('email',$email);
    $this->db->where('user_password',$password);
    $query = $this->db->get('tbl_employees',1);
    $num = $this->db->count_all_results('tbl_employees'); //determine the number of rows
    $data = $query->result(); //returns the query result as an array of objects
    return  $data;
  }

}