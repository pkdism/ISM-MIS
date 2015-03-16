<?php

class Feedback_faculty_model extends CI_Model
{

        function __construct()
        {
                // Call the Model constructor
                parent::__construct();
        }

        function get_faculty_info($emp_id = '')
        {
		$fb = $this->load->database('feedback', TRUE);
                $query = $fb->query("select first_name, salutation, middle_name, last_name, design, email, ph_no, research_int, sex, category, physically_challenged from feedback_faculty where emp_id = '$emp_id'");
                if($query->num_rows() == 1)
                        return $query->row_array();
                else
                        return FALSE;
        }
}

/* End of file feedback_faculty_model.php */
/* Location: Codeigniter/application/models/employee/feedback_faculty_model.php */



