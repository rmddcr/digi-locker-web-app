<?php
class Employee_model extends CI_Model{
    function get_all_plants()
    {
        return $this->db->get('plant')->result();
    }

    function get_all_teams()
    {
        return $this->db->get('team')->result();
    }

    function get_all_shifts()
    {
        return $this->db->get('shift')->result();
    }

    function get_filtered_employees($epf_no, $name, $team, $shift, $plant)
    {
        $query = 'SELECT e.has_locker, e.epf_no, e.name, t.name as team, s.name as shift, p.name as plant FROM employee as e JOIN shift as s ON e.shift_id = s.id JOIN team as t ON e.team_id = t.id JOIN plant as p ON t.plant_id = p.id WHERE 1 ';
        if($epf_no != "")
        {
            $query = $query."AND e.epf_no = ".$epf_no." ";
        }
        
        if($name != "")
        {
            $query = $query."AND e.name LIKE '%".addslashes($name)."%' ";
        }

        if($team != "" && $team != "all")
        {
            $query = $query."AND t.id = '".$team."' ";
        }

        if($shift != "" && $shift != "all")
        {
            $query = $query."AND s.id = '".$shift."' ";
        }

        if($plant != "" && $plant != "all")
        {
            $query = $query."AND p.id = '".$plant."' ";
        }
        $query = $this->db->query($query);
        return $query->result();
    }

    function get_all_employees()
    {
        $query = 'SELECT e.has_locker, e.epf_no, e.name, t.name as team, s.name as shift, p.name as plant FROM employee as e JOIN shift as s ON e.shift_id = s.id JOIN team as t ON e.team_id = t.id JOIN plant as p ON t.plant_id = p.id ';
        $query = $this->db->query($query);
        return $query->result();
    }


    function get_employee_by_id($employee_id)
    {
        $query = 'SELECT e.has_locker, e.epf_no, e.name, t.name as team, s.name as shift, p.name as plant, p.id as plant_id FROM employee as e JOIN shift as s ON e.shift_id = s.id JOIN team as t ON e.team_id = t.id JOIN plant as p ON t.plant_id = p.id  WHERE e.epf_no = '.$employee_id;
        $query = $this->db->query($query);
        return $query->row();
    }

    function get_employee_current_locker($employee_id)
    {
        $query = 'SELECT l.id, l.locker_no, l.plant_id as plant_id, p.name as plant, ehl.assigned_by, ehl.assigned_time  FROM locker as l JOIN employee_has_locker as ehl ON l.id = ehl.locker_id JOIN plant as p ON l.plant_id = p.id WHERE ehl.employee_epf_no = '.$employee_id;
        $query = $this->db->query($query);
        return $query->row();
    }

    function get_employee_locker_history($employee_id)
    {
        $query = 'SELECT l.id, l.locker_no, l.plant_id as plant_id, p.name as plant, ehlh.assigned_by, ehlh.assigned_time, ehlh.unassigned_by, ehlh.unassigned_time  FROM locker as l JOIN employee_has_locker_history as ehlh ON l.id = ehlh.locker_id JOIN plant as p ON l.plant_id = p.id WHERE ehlh.employee_epf_no = '.$employee_id;
        $query = $this->db->query($query);
        return $query->result();
    }

    function get_employees_without_lockers($plant)
    {
        $query = 'SELECT e.has_locker, e.epf_no, e.name, t.name as team, s.name as shift, p.name as plant, p.id as plant_id FROM employee as e JOIN shift as s ON e.shift_id = s.id JOIN team as t ON e.team_id = t.id JOIN plant as p ON t.plant_id = p.id WHERE e.has_locker = FALSE AND p.id ='.$plant;
        $query = $this->db->query($query);
        return $query->result();
    }

    function add_employee($epf_no, $name, $plant_id, $team_id, $shift_id)
    {
        $result['status'] = "failed";
        $result['error'] = "Failed to add employee due to <strong> unknown error </strong>";
        
        $this->db->trans_begin();

        $query = 'SELECT epf_no FROM employee WHERE epf_no = '.addslashes($epf_no);
        $query = $this->db->query($query);
        $employee = $query->row();
        if(isset($employee))
        {
            $result['error'] = "Failed to add employee due to <strong> Employee with EPF number ".$epf_no." already exists</strong>";
            return $result; 
        }

        $query = 'SELECT t.id FROM team as t JOIN plant as p ON t.plant_id = p.id WHERE t.id = '.$team_id.' AND p.id = '.$plant_id;
        $query = $this->db->query($query);
        $plant = $query->row();
        if(!isset($plant))
        {   
            $query = 'SELECT name FROM plant where id = '.$plant_id;
            $query = $this->db->query($query);
            $plant = $query->row();
            $result['error'] = "Failed to add employee due to <strong> Team selected is not in Plant ".$plant->name."</strong>";
            return $result; 
        }

        $query = 'INSERT into employee(epf_no, name, team_id, shift_id) VALUES ('.$epf_no.', "'.addslashes($name).'", '.$team_id.', '.$shift_id.')';
        $query = $this->db->query($query);
        if($query != 1) return $result;


        if($_FILES['image_file']['size'] > 0)
        {
            $this->db->where('epf_no', $epf_no);
            $img = $this->db->get('employee_picture');
            $img = $img->row();
    
            $imgData = file_get_contents($_FILES['image_file']['tmp_name']);
            $data = array('epf_no' => $epf_no, 'image'=>$imgData);

            if(isset($img))
            {
                $res = $this->db->replace('employee_picture', $data);
            } else {
                $res = $this->db->insert('employee_picture', $data);
            }
            if(!$res)
            {
                $result['error'] = "Failed to update employee due to <strong> Failed upload image </strong>";
                return $result; 
            }
        }
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $result['error'] = "Failed to add employee due to <strong> Database error </strong>";
                return $result;
        }
        else
        {
                $this->db->trans_commit();
                $result['status'] = "success";
                $result['employee_id'] = $epf_no;
                return $result;
        }        
    }

    function update_employee($epf_no, $name, $plant_id, $team_id, $shift_id)
    {
        $result['status'] = "failed";
        $result['error'] = "Failed to update employee due to <strong> unknown error </strong>";
        
        $this->db->trans_begin();

        $query = 'SELECT epf_no FROM employee WHERE epf_no = '.addslashes($epf_no);
        $query = $this->db->query($query);
        $employee = $query->row();
        if(!isset($employee))
        {
            $result['error'] = "Failed to update employee due to <strong> Employee with EPF number ".$epf_no." has been removed</strong>";
            return $result; 
        }

        $query = 'SELECT t.id FROM team as t JOIN plant as p ON t.plant_id = p.id WHERE t.id = '.$team_id.' AND p.id = '.$plant_id;
        $query = $this->db->query($query);
        $plant = $query->row();
        if(!isset($plant))
        {   
            $query = 'SELECT name FROM plant where id = '.$plant_id;
            $query = $this->db->query($query);
            $plant = $query->row();
            $result['error'] = "Failed to update employee due to <strong> Team selected is not in Plant ".$plant->name."</strong>";
            return $result; 
        }

        $data = array('name' => $name,
                    'team_id' => $team_id,
                    'shift_id' => $shift_id
                    );
        $this->db->where('epf_no', $epf_no);
        $query = $this->db->update('employee', $data);
        if(!$query) return $result;

        if($_FILES['image_file']['size'] > 0)
        {
            $this->db->where('epf_no', $epf_no);
            $img = $this->db->get('employee_picture');
            $img = $img->row();
    
            $imgData = file_get_contents($_FILES['image_file']['tmp_name']);
            $data = array('epf_no' => $epf_no, 'image'=>$imgData);

            if(isset($img))
            {
                $res = $this->db->replace('employee_picture', $data);
            } else {
                $res = $this->db->insert('employee_picture', $data);
            }
            if(!$res)
            {
                $result['error'] = "Failed to update employee due to <strong> Failed upload image </strong>";
                return $result; 
            }
        }

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $result['error'] = "Failed to update employee due to <strong> Database error </strong>";
                return $result;
        }
        else
        {
                $this->db->trans_commit();
                $result['status'] = "success";
                $result['employee_id'] = $epf_no;
                return $result;
        }        
    }

    function remove_employees_csv($file_name)
    {
        //var_dump($_FILES[$file_name]);
        $result['status'] = 'failed';
        $result['error'] = 'Failed to remove employees <strong> Unknown error </strong>';
        $result['errors'] = 0;
        $result['error_rows'] = array();
        $result['deleted'] = array();
        
        if($_FILES[$file_name]['error'] != 0)
        {
            $result['error'] = 'Failed to remove employees <strong> Error when uploading : '.$_FILES[$file_name]['error'].'. </strong>'; 
            return $result;
        }
        if($_FILES[$file_name]['type'] != "text/csv")
        {
            $result['error'] = 'Failed to remove employees <strong> File type of uploaded file is '.$_FILES[$file_name]['type'].'. </strong> File type must be <strong>text/csv</strong>'; 
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
                

                

                if($data[0] == "")// check empty rows
                {
                    array_push($result['errpr_rows'], array('row' => $result['row'], 'error' => "EPF number field empty"));
                    $result['errors']++;
                    continue;
                }
                if( !is_numeric($data[0]) )// check invalid EPF number
                {
                    array_push($result['error_rows'], array('row' => $result['row'], 'error' => "EPF number invalid"));
                    $result['errors']++;
                    continue;
                }

                $epf_no = $data[0];
                
                //check locker already in the system
                $query = 'SELECT epf_no FROM employee WHERE epf_no = '.$epf_no;
                $query = $this->db->query($query);
                $query = $query->row();
                if(!isset($query))
                {
                    array_push($result['error_rows'], array('row' => $result['row'], 'error' => "Employee with EPF number <strong>".$epf_no."</strong> in not in the system"));
                    $result['errors']++;
                    continue;
                }

                //check assgined locker
                $query = 'SELECT locker_id FROM employee_has_locker WHERE employee_epf_no = '.$epf_no;
                $query = $this->db->query($query);
                $query = $query->row();
                if(isset($query))
                {   
                    //free assigned locker
                    $locker_id = $query->locker_id;
                    $query = 'UPDATE locker SET status = "free" WHERE id = '.$locker_id;
                    $query = $this->db->query($query);
                    if(!$query) {$result['error']="Failed to update locker status to FREE, ROW : ".$row; return $result;}

                    $query = 'DELETE FROM employee_has_locker WHERE employee_epf_no = '.$epf_no;
                    $query = $this->db->query($query);
                    if(!$query) {$result['error']="Failed to delete record employee locker , ROW : ".$row; return $result;}
                }

                //check employee locker histroy
                $query = 'SELECT locker_id FROM employee_has_locker_history WHERE employee_epf_no = '.$epf_no;
                $query = $this->db->query($query);
                $query = $query->row();
                if(isset($query))
                {
                    //delete employee locker histroy
                    $query = 'DELETE FROM employee_has_locker_history WHERE employee_epf_no = '.$epf_no;
                    $query = $this->db->query($query);
                    if(!$query) {$result['error']="Failed to delete records employee locker history, ROW : ".$row; return $result;}
                }

                //delete employee
                $query = 'DELETE FROM employee WHERE epf_no = '.$epf_no;
                    $query = $this->db->query($query);
                    if(!$query) {$result['error']="Failed to delete, ROW : ".$row; return $result;}

                array_push($result['deleted'], $epf_no);
                $result['entered_rows']++;
                
            }
            fclose($handle);

            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
                    $result['error'] = "Failed to remove employees <strong> Database error </strong>";
                    return $result;
            }
            else
            {
                    $this->db->trans_commit();
                    $result['status'] = "success";
                    return $result;
            }

        } else {
            $result['error'] = 'Failed to remove employees <strong> Cannot open the file </strong>';
        }

        return $result;
    }

    function remove_employee($epf_no)
    {
        $result['status'] = 'failed';
        $result['error'] = 'Failed to remove employees <strong> Unknown error </strong>';

        
        //check locker already in the system
        $query = 'SELECT epf_no FROM employee WHERE epf_no = '.$epf_no;
        $query = $this->db->query($query);
        $query = $query->row();
        if(!isset($query))
        {
            $result['error'] = "Employee with EPF number <strong>".$epf_no."</strong> in not in the system";
            return $result;
        }

        //check assgined locker
        $query = 'SELECT locker_id FROM employee_has_locker WHERE employee_epf_no = '.$epf_no;
        $query = $this->db->query($query);
        $query = $query->row();
        if(isset($query))
        {   
            //free assigned locker
            $locker_id = $query->locker_id;
            $query = 'UPDATE locker SET status = "free" WHERE id = '.$locker_id;
            $query = $this->db->query($query);
            if(!$query) {$result['error']="Failed to update locker status to FREE"; return $result;}

            $query = 'DELETE FROM employee_has_locker WHERE employee_epf_no = '.$epf_no;
            $query = $this->db->query($query);
            if(!$query) {$result['error']="Failed to delete record employee locker"; return $result;}
        }

        //check employee locker histroy
        $query = 'SELECT locker_id FROM employee_has_locker_history WHERE employee_epf_no = '.$epf_no;
        $query = $this->db->query($query);
        $query = $query->row();
        if(isset($query))
        {
            //delete employee locker histroy
            $query = 'DELETE FROM employee_has_locker_history WHERE employee_epf_no = '.$epf_no;
            $query = $this->db->query($query);
            if(!$query) {$result['error']="Failed to delete records employee locker history"; return $result;}
        }

        //delete employee
        $query = 'DELETE FROM employee WHERE epf_no = '.$epf_no;
            $query = $this->db->query($query);
            if(!$query) {$result['error']="Failed to delete employee"; return $result;}
            

        $result['status'] = "success";
        return $result;
    }

    function get_image($employee_id)
    {
        $this->db->where('epf_no', $employee_id);
        $image = $this->db->get('employee_picture');
        return $image->row();
    }

}

?>