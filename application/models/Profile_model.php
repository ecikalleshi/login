<?php 
class Profile_model extends CI_Model
{

  function show()
  {
      $id= $this->session->userdata('user_id');
      $query=$this->db->query("SELECT first_name,last_name,email,profileImage FROM tbl_employees WHERE empId='$id'");
    
      if($query->num_rows()>0){
          return $query->result();
      }else{
          return FALSE;
      }
  }

    function update_data($data)
    {
      $id= $this->session->userdata('user_id');
      $this->db->where('empId', $id);

      if($this->db->update('tbl_employees', $data))
      {
          return TRUE;
      } 
    }

}