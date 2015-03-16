<?php

/**
 * Author: Majeed Siddiqui (samsidx)
*/

class Result {
    private $result;
    private $errors;
    
    function __construct() {
        $this->result = TRUE;
        $this->errors = array();
    }
    
    function setResult($result) {
        $this->result = $result;
    }
    
    function getResult() {
        return $this->result;
    }
    
    function addError($error) {
        array_push($this->errors, $error);
    }
    
    function getNumErrors() {
        return array_count_values($this->errors);
    }
    
    function getErrors() {
        return $this->errors;
    }
    
    function updateResult($new_result) {
        if ($this->result) {
            $this->result = $new_result->getResult();
        }
        $new_errors = $new_result->getErrors();
        foreach($new_errors as $error) {
            $this->addError($error);
        }
    }
}
