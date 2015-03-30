<?php

/**
 * Author: Nishant Raj
*/

require_once 'result.php';
require_once 'leave_constants.php';
class Leave_station_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

    /**
     * @param $emp_id
     * @param $leaving_date
     * @param $leaving_time
     * @param $arrival_date
     * @param $arrival_time
     * @param $purpose
     * @param $addr
     * @return : NONE
     */
    function insert_station_leave_details($emp_id, $leaving_date, $leaving_time, $arrival_date, $arrival_time, $purpose, $addr)
    {

        $leaving_date = strtotime($leaving_date);
        $leaving_date = date('Y-m-d', $leaving_date);


        $arrival_date = strtotime($arrival_date);
        $arrival_date = date('Y-m-d', $arrival_date);

        $current_date = date("Y-m-d");
        $sql = "INSERT INTO " . Leave_constants::$TABLE_STATION_LEAVE .
            " VALUES('','$emp_id','$current_date', '$leaving_date' , '$leaving_time' , '$arrival_date' , '$arrival_time' , '$purpose' , '$addr')";

        $this->db->query($sql);
    }

    /**
     * @param $leave_id
     * @param $current_emp
     * @param $next_emp
     * @param $status
     */
    function insert_station_leave_status($leave_id, $current_emp, $next_emp, $status)
    {

        $sql = "INSERT INTO " . Leave_constants::$TABLE_STATION_LEAVE_STATUS .
            " VALUES($leave_id , '$current_emp','$next_emp',$status,CURRENT_TIMESTAMP)";

        $this->db->query($sql);
    }

    /**
     * @param $emp_id
     * @param $applying_date
     * @param $leaving_date
     * @param $leaving_time
     * @param $arrival_date
     * @param $arrival_time
     * @return mixed
     */
    function get_station_leave_id($emp_id, $applying_date, $leaving_date, $leaving_time, $arrival_date, $arrival_time)
    {

        $leaving_date = strtotime($leaving_date);
        $leaving_date = date('Y-m-d', $leaving_date);

        $arrival_date = strtotime($arrival_date);
        $arrival_date = date('Y-m-d', $arrival_date);

        $applying_date = strtotime($applying_date);
        $applying_date = date('Y-m-d', $applying_date);


        $sql = "SELECT id , emp_id , leaving_date , leaving_time , arrival_date , arrival_time " .
            "FROM " . Leave_constants::$TABLE_STATION_LEAVE .
            " WHERE emp_id = '$emp_id' and leaving_date = '$leaving_date' and leaving_time = '$leaving_time'
                 and arrival_date = '$arrival_date' and arrival_time = '$arrival_time' and applying_date = '$applying_date'";

        $result = $this->db->query($sql)->result_array();

        foreach ($result as $row) {

            return $row['id'];
        }
    }

    /**
     * @param $emp_id
     * @return array
     */
    function get_station_leave_history($emp_id)
    {

        $sql = "SELECT * FROM " . Leave_constants::$TABLE_STATION_LEAVE .
            " WHERE emp_id = '$emp_id'";

        $result = $this->db->query($sql)->result_array();
        $i = 0;
        $data = array();
        $data['data'] = NULL;
        foreach ($result as $row) {
            $data['data'][$i] = array();
            $data['data'][$i]['id'] = $row['id'];
            $data['data'][$i]['applying_date'] = $row['applying_date'];
            $data['data'][$i]['leaving_date'] = $row['leaving_date'];
            $data['data'][$i]['leaving_time'] = $row['leaving_time'];
            $data['data'][$i]['arrival_time'] = $row['arrival_time'];
            $data['data'][$i]['arrival_date'] = $row['arrival_date'];
            $data['data'][$i]['purpose'] = $row['purpose'];
            $data['data'][$i]['addr'] = $row['addr'];
            $temp = $this->get_station_leave_status($row['id']);
            $data['data'][$i]['status'] = $temp['status'];
            $data['data'][$i]['fwd_by'] = $temp['fwd_by'];
            $data['data'][$i]['fwd_to'] = $this->get_user_name_by_id($temp['fwd_to']);
            $data['data'][$i]['fwd_at'] = $temp['fwd_at'];
            $lv_date = strtotime($row['leaving_date']);
            $rt_date = strtotime($row['arrival_date']);
            $period = (($rt_date - $lv_date) / (24 * 60 * 60)) + 1;
            $data['data'][$i]['period'] = $period;
            $i++;
        }
        return $data;
    }

    /**
     * @param $leave_id
     * @return array
     */
    function get_station_leave_status($leave_id)
    {

        $sql = "SELECT * FROM " . Leave_constants::$TABLE_STATION_LEAVE_STATUS .
            " WHERE id = '$leave_id' ORDER BY time DESC";

        $result = $this->db->query($sql)->result_array();

        $data = array();
        foreach ($result as $row) {
            $data['status'] = $row['status'];
            $data['fwd_by'] = $row['current'];
            $data['fwd_to'] = $row['next'];
            $data['fwd_at'] = $row['time'];
            return $data;
        }
    }

    /**
     * @param $emp_id
     * @return string
     */
    function get_user_name_by_id($emp_id)
    {

        $sql = "SELECT * FROM user_details WHERE id = '$emp_id'";

        $result = $this->db->query($sql)->result_array();

        foreach ($result as $row) {
            $salutation = $row['salutation'];
            $f_name = $row['first_name'];
            $m_name = $row['middle_name'];
            $l_name = $row['last_name'];

            $name = "$salutation " . "$f_name " . "$m_name " . "$l_name";
            return $name;
        }
    }

    /**
     * @param $emp_id
     * @return array
     */
    function get_pending_station_leave($emp_id)
    {
        $pending = Leave_constants::$PENDING;
        $forwarded = Leave_constants::$FORWARDED;
        $sql = "SELECT * FROM " . Leave_constants::$TABLE_STATION_LEAVE_STATUS .
            " WHERE next = '$emp_id'";

        $result = $this->db->query($sql)->result_array();
        $data = array();
        $data['data'] = array();
        $data['data'] = NULL;
        $i = 0;
        foreach ($result as $row) {

            $status = $this->get_station_leave_status($row['id']);
            if (($status['status'] == Leave_constants::$PENDING || $status['status'] == Leave_constants::$WAITING_CANCELLATION || $status['status'] == Leave_constants::$FORWARDED) && $status['fwd_to'] == $emp_id) {
                $data['data'][$i] = array();
                if ($status['status'] == Leave_constants::$PENDING)
                    $data['data'][$i]['type'] = Leave_constants::$PENDING;
                else
                    $data['data'][$i]['type'] = Leave_constants::$WAITING_CANCELLATION;
                $temp = array();
                $temp = $this->get_station_leave_by_id($row['id']);
                $data['data'][$i]['status'] = $status['status'];
                $data['data'][$i]['leave_id'] = $row['id'];
                $data['data'][$i]['crt_emp'] = $emp_id;
                $data['data'][$i]['emp_id'] = $temp['emp_id'];
                $data['data'][$i]['name'] = $this->get_user_name_by_id($temp['emp_id']);
                $data['data'][$i]['apl_date'] = $temp['applying_date'];
                $data['data'][$i]['lv_date'] = $temp['leaving_date'];
                $data['data'][$i]['lv_time'] = $temp['leaving_time'];
                $data['data'][$i]['rt_date'] = $temp['arrival_date'];
                $data['data'][$i]['rt_time'] = $temp['arrival_time'];
                $data['data'][$i]['purpose'] = $temp['purpose'];
                $data['data'][$i]['addr'] = $temp['addr'];
                $lv_date = strtotime($temp['leaving_date']);
                $rt_date = strtotime($temp['arrival_date']);
                $period = (($rt_date - $lv_date) / (24 * 60 * 60)) + 1;
                $data['data'][$i]['period'] = $period;
                $i++;
            }
        }
        return $data;
    }

    /**
     * @param $leave_id
     * @return string
     */
    function get_station_leave_by_id($leave_id)
    {
        $sql = "SELECT * FROM " . Leave_constants::$TABLE_STATION_LEAVE .
            " WHERE id = '$leave_id'";

        $result = $this->db->query($sql)->result_array();

        $data = array();
        $data = NULL;
        foreach ($result as $temp) {
            $data['emp_id'] = $temp['emp_id'];
            $data['applying_date'] = $temp['applying_date'];
            $data['leaving_date'] = $temp['leaving_date'];
            $data['leaving_time'] = $temp['leaving_time'];
            $data['arrival_date'] = $temp['arrival_date'];
            $data['arrival_time'] = $temp['arrival_time'];
            $data['purpose'] = $temp['purpose'];
            $data['addr'] = $temp['addr'];
            $status = $this->get_station_leave_status($temp['id']);
            $data['status'] = $status['status'];
            $data['next_emp'] = $status['fwd_to'];
            return $data;
        }

    }

    function getCancellableStationLeave($emp_id)
    {

        $sql = "SELECT * FROM " . Leave_constants::$TABLE_STATION_LEAVE .
            " WHERE emp_id = '$emp_id'";

        $result = $this->db->query($sql)->result_array();
        $i = 0;
        $data = array();
        $data['data'] = NULL;
        foreach ($result as $row) {
            $temp = $this->get_station_leave_status($row['id']);
            if ($temp['status'] == Leave_constants::$APPROVED || $temp['status'] == Leave_constants::$PENDING ||
                $temp['status'] == Leave_constants::$FORWARDED
            ) {
                $data['data'][$i] = array();
                $data['data'][$i]['emp_id'] = $emp_id;
                $data['data'][$i]['id'] = $row['id'];
                $data['data'][$i]['applying_date'] = $row['applying_date'];
                $data['data'][$i]['leaving_date'] = $row['leaving_date'];
                $data['data'][$i]['leaving_time'] = $row['leaving_time'];
                $data['data'][$i]['arrival_time'] = $row['arrival_time'];
                $data['data'][$i]['arrival_date'] = $row['arrival_date'];
                $data['data'][$i]['purpose'] = $row['purpose'];
                $data['data'][$i]['addr'] = $row['addr'];
                $data['data'][$i]['status'] = $temp['status'];
                $data['data'][$i]['fwd_by'] = $temp['fwd_by'];
                $data['data'][$i]['fwd_to'] = $this->get_user_name_by_id($temp['fwd_to']);
                $data['data'][$i]['fwd_at'] = $temp['fwd_at'];
                $lv_date = strtotime($row['leaving_date']);
                $rt_date = strtotime($row['arrival_date']);
                $period = (($rt_date - $lv_date) / (24 * 60 * 60)) + 1;
                $data['data'][$i]['period'] = $period;
                $i++;
            }
        }
        return $data;
    }
}