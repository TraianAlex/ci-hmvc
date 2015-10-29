<?php

function data_post($fields){

	$CI =& get_instance();
    $data = [];
    foreach ($fields as $field) {
        $data[$field] = $CI->input->post($field);
    }
    return $data;
}