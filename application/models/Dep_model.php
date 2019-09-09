<?php
class Dep_model extends CI_Model{


	function dep_list()
	{
		$sql = "SELECT a.*,b.departmentCode as main_dep
				from tbl_departments a
				left join tbl_departments b on a.id_dep = b.departmentId";

		$hasil=$this->db->query($sql);
		return $hasil->result();
	}

	function getAllDep()
	{
		$query = $this->db->query('SELECT departmentId from tbl_departments');

		/*$query = $this->db->query('SELECT a.departmentId , a.departmentCode as main_dep
								   from tbl_departments a
								   left join tbl_departments b 
								   on a.id_dep = b.departmentId');*/
        return $query->result();
	}

	/*function get_DepCode($id_dep){
		
		$sql = "SELECT a.*,b.departmentCode 
				  from tbl_departments a
				  join tbl_departments b on a.departmentId = b.id_dep";

				   print_r($sql);exit;

		$query = $this->db->query($sql);
		//$result = $query->result_array();

		return $query->result();				 
	}*/



	/*public 
    function get_mainDeps() { 
        $result = $this->db-> select('departmentId, id_dep')->get('tbl_departments')->result_array(); 
 
        $mainDep = array(); 
        foreach($result as $r) { 
            $mainDep[$r['departmentId']] = $r['id_dep']; 
        } 
        $mainDep[''] = 'Select Main Department...'; 
        return $mainDep; 
    } */
	/*function get_mainDep(){

		$query = $this->db->query('SELECT id_dep FROM tbl_departments');


        return $query->result();
		//$query = $this->db->query('SELECT departmentCode FROM tbl_departments'); 
		//where departmentId=id_dep');

		//$row = $query->row();
		//echo $row->name;

		//foreach ($query->result() as $row)
		//{
		//	echo $row->departmentCode;
		//}
	}*/

	function save_dep()
	{
		$data = array(
		//'departmentId'	 => $this->input->post('departmentId'),
		'departmentName' => $this->input->post('departmentName'),
		'departmentCode' => $this->input->post('departmentCode'),
		//'main_dep' => $this->input->post('main_dep'),
		'id_dep'         => $this->input->post('id_dep'),    
		);

		$result=$this->db->insert('tbl_departments',$data);
		return $result;
	}

	function update_dep()
	{
		$departmentId = $this->input->post('departmentId');
		$departmentName = $this->input->post('departmentName');
		$departmentCode = $this->input->post('departmentCode');
		//$iddep = $this->input->post('id_dep');

		$this->db->set('departmentId', $departmentId);
		$this->db->set('departmentName', $departmentName);
		$this->db->set('departmentCode', $departmentCode);
		//$this->db->set('id_dep', $iddep);
		$this->db->where('departmentId', $departmentId);
		$result=$this->db->update('tbl_departments');
		return $result;
	}

	function delete_dep()
	{
		$departmentId=$this->input->post('departmentId');
		$id_dep = $this->input->post('id_dep');

		if($id_dep == 0)
		{
			$this->db->set('id_dep', 0);
			$this->db->where('id_dep', $departmentId);
			$this->db->update('tbl_departments');
		}

		//if($id_dep != 0)
		//{
			$this->db->where('departmentId', $departmentId);
			$result=$this->db->delete('tbl_departments');
		//}

		return $result;
	}
	
}