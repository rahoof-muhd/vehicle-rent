<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload {

    public function __construct() {
        // Get the instance to use CodeIgniter's functionalities
        $this->CI = &get_instance();
        $this->CI->load->library('upload');
    }

    public function do_upload($field_name, $upload_path = './upload/', $allowed_types = 'gif|jpg|png|jpeg', $max_size = 2048) {
        // Configure upload settings
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = $allowed_types;
        $config['max_size'] = $max_size;
        $config['encrypt_name'] = TRUE; // To rename the file automatically

        $this->CI->upload->initialize($config);

        // Perform the upload
        if (!$this->CI->upload->do_upload($field_name)) {
            // Return the error if the upload fails
            return ['error' => $this->CI->upload->display_errors()];
        } else {
            // Return the uploaded data if successful
            return ['data' => $this->CI->upload->data()];
        }
    }
}
