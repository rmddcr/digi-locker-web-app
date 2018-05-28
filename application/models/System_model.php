<?php
class System_model extends CI_Model{
	function get_all_plants(){
        return $this->db->get('plant')->result();
    }

    function add_plant($name)
    {
    	$query = 'INSERT into plant(name) VALUES ("'.addslashes($name).'")';
        $query = $this->db->query($query);
        if($query != 1) return false;

        return true;
    }

    function add_team($name, $plant_id)
    {
    	$query = 'INSERT into team(name, plant_id) VALUES ("'.addslashes($name).'", '.$plant_id.')';
        $query = $this->db->query($query);
        if($query != 1) return false;

        return true;
    }

    function add_shift($name)
    {
    	$query = 'INSERT into shift(name) VALUES ("'.addslashes($name).'")';
        $query = $this->db->query($query);
        if($query != 1) return false;

        return true;
    }

    function restore($file_name, $plant_id)
    {
    	//var_dump($_FILES[$file_name]);
    	$result['status'] = 'failed';
    	$result['error'] = 'Failed to restore the system <strong> Unknown error </strong>';
    	$result['errors'] = 0;
    	$result['error_rows'] = array();
    	
    	if($_FILES[$file_name]['error'] != 0)
    	{
    		$result['error'] = 'Failed to restore the system <strong> Error when uploading : '.$_FILES[$file_name]['error'].'. </strong>'; 
    		return $result;
    	}
    	if($_FILES[$file_name]['type'] != "text/csv")
    	{
    		$result['error'] = 'Failed to restore the system <strong> File type of uploaded file is '.$_FILES[$file_name]['type'].'. </strong> File type must be <strong>text/csv</strong>'; 
    		return $result;
    	}
    	ini_set('auto_detect_line_endings',TRUE);
		if (($handle = fopen($_FILES[$file_name]['tmp_name'], "r")) !== FALSE) 
		{
			$this->db->trans_begin();
			
			$result['row'] = 0;
			$result['entered_rows'] = 0;
		    while (($data = fgetcsv($handle,",")) !== FALSE) 
		    {
		    	$result['row']++;
		        if($data[0] == "#end")// check end tag
		        {
		        	$result['end'] = '#end';
		        	break;
		        }
		        if($result['row'] == 1)// skip 1st row 
		        {
		        	continue;
		        }

		        if($data[0] == "")// check empty locker number rows
		        {
		        	array_push($result['errpr_rows'], array('row' => $result['row'], 'error' => "locker number field empty"));
		        	$result['errors']++;
		        	continue;
		        }
		        if( !is_numeric($data[0]) )// check invalid locker number rows
		        {
		        	array_push($result['error_rows'], array('row' => $result['row'], 'error' => "locker number invalid"));
		        	$result['errors']++;
		        	continue;
		        }

		        $locker_no = $data[0];
		        $employee_epf_no = $data[1];
		        $employee_name = $data[2];
		        $employee_team = $data[3];
		        $employee_shift = $data[4];

		        //check locker already in the system
		        $query = 'SELECT id, plant_id , locker_no FROM locker WHERE plant_id = '.$plant_id.' AND locker_no = '.$locker_no;
		        $query = $this->db->query($query);
		        $query = $query->row();
		        if(isset($query))
		        {
		        	array_push($result['error_rows'], array('row' => $result['row'], 'error' => "locker already in the system"));
		        	$result['errors']++;
		        	continue;
		        }

		        //insert locker
		        $query = 'INSERT INTO locker(locker_no, plant_id, status_changed_by) VALUES ('.$locker_no.', '.$plant_id.', "'.addslashes($_SESSION['user']['username']).'")';
		        $query = $this->db->query($query);
        		if($query != 1) {$result['error']="Failed to insert new locker ROW : ".$row; return $result;}
        		$result['entered_rows']++;

        		//if locker is broken or locked
        		if($employee_epf_no=="Locked " ||  $employee_epf_no=="Broken" || $employee_epf_no=="Locked" )
        		{
        			$query = 'UPDATE locker SET status="broken" WHERE locker_no = '.$locker_no.' AND plant_id = '.$plant_id;
        			$query = $this->db->query($query);
            		if(!$query) {$result['error']="Failed to set locker broken ROW : ".$row; return $result;}
        		}

        		//skip if epf_no not given
        		if($employee_epf_no=="" || $employee_epf_no=="#N/A" || !is_numeric($employee_epf_no))
        		{
        			continue;
        		}

        		$query = 'SELECT epf_no, name FROM employee WHERE epf_no = '.$employee_epf_no;
        		$query = $this->db->query($query);
		        $query = $query->row();
		        if(isset($query))
		        {
		        	array_push($result['error_rows'], array('row' => $result['row'], 'error' => "employee already in the system EPF no: <strong>".$employee_epf_no."</strong> , name: ".$query->name));
		        	$result['errors']++;
		        	continue;
		        }

		        //check if team is there
		        $query = 'SELECT id, name, plant_id FROM team WHERE name = "'.addslashes($employee_team).'" AND plant_id = '.$plant_id;
        		$query = $this->db->query($query);
		        $query = $query->row();
		        if(isset($query))
		        {
		        	$team_id = $query->id;
		        } else {
		        	$query = 'INSERT INTO team(name, plant_id) VALUES ("'.addslashes($employee_team).'", '.$plant_id.')';
			        $query = $this->db->query($query);
	        		if($query != 1) {$result['error']="Failed to insert new team ROW : ".$row; return $result;}

	        		$query = 'SELECT id, name, plant_id FROM team WHERE name = "'.addslashes($employee_team).'" AND plant_id = '.$plant_id;
	        		$query = $this->db->query($query);
			        $query = $query->row();
			        $team_id = $query->id;
		        }

		        //check if shift exsists
		        $query = 'SELECT id, name FROM shift WHERE name = "'.addslashes($employee_shift).'"';
        		$query = $this->db->query($query);
		        $query = $query->row();
		        if(isset($query))
		        {
		        	$shift_id = $query->id;
		        } else {
		        	$query = 'INSERT INTO shift(name) VALUES ("'.addslashes($employee_shift).'")';
			        $query = $this->db->query($query);
	        		if($query != 1) {$result['error']="Failed to insert new shift ROW : ".$row; return $result;}

	        		$query = 'SELECT id, name FROM shift WHERE name = "'.addslashes($employee_shift).'"' ;
	        		$query = $this->db->query($query);
			        $query = $query->row();
			        $shift_id = $query->id;
		        }

		        //insert employee
		        $query = 'INSERT INTO employee(epf_no, name, team_id, shift_id, has_locker) VALUES ('.$employee_epf_no.', "'.addslashes($employee_name).'", '.$team_id.', '.$shift_id.', TRUE)';
		        $query = $this->db->query($query);
	        	if($query != 1) {$result['error']="Failed to insert new employee ROW : ".$row; return $result;}

	        	//get locker id
		        $query = 'SELECT id, plant_id, locker_no  FROM locker WHERE plant_id = '.$plant_id.' AND locker_no = '.$locker_no;
        		$query = $this->db->query($query);
		        $query = $query->row();
		        $locker_id = $query->id;

		        //assign locker to employee
		        $query = 'UPDATE locker SET status="in_use" WHERE id = '.$locker_id ;
    			$query = $this->db->query($query);
        		if(!$query) {$result['error']="Failed to assgin locker ROW : ".$row; return $result;}

        		$query = 'INSERT INTO employee_has_locker(employee_epf_no, locker_id, assigned_by) VALUES ('.$employee_epf_no.', '.$locker_id.', "'.addslashes($_SESSION['user']['username']).'")';
		        $query = $this->db->query($query);
	        	if($query != 1) {$result['error']="Failed to assgin locker ROW : ".$row; return $result;}
		    	
		    	
		    }
		    fclose($handle);

		    if ($this->db->trans_status() === FALSE)
	        {
	                $this->db->trans_rollback();
	                $result['error'] = "Failed to restore system<strong> Database error </strong>";
	                return $result;
	        }
	        else
	        {
	                $this->db->trans_commit();
	                $result['status'] = "success";
	                return $result;
	        }

		} else {
			$result['error'] = 'Failed to restore the system <strong> Cannot open the file </strong>';
		}

		return $result;
    }

}

?>