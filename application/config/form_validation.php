<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = [
	'login' => [
		[
		 'field' => 'email', 'label' => 'Email',
		 'rules' => 'trim|required|min_length[8]|max_length[50]|valid_email|callback__validate_credentials'
		 ],
		['field' => 'password', 'label' => 'Password',
		 'rules' => 'trim|required|max_length[50]'
		 ],
	],
	'signup' => [
		[
		 'field' => 'email', 'label' => 'Email',
		 'rules' => 'trim|required|min_length[8]|max_length[50]|valid_email|is_unique[users.email]'
		 ],
		['field' => 'password', 'label' => 'Password',
		 'rules' => 'trim|required|max_length[50]'
		 ],
		[
		'field' => 'confirm_password', 'label' => 'Confirm Password',
		 'rules' => 'trim|required|max_length[50]|matches[password]'
		 ]
	],
	'forgot_pass' => [
		[
		'field' => 'email', 'label' => 'Email',
	 	'rules' => 'trim|required|min_length[8]|max_length[50]|valid_email|callback__validate_email'
		]
	],
	'edit' => [
		[
		'field' => 'email', 'label' => 'Email',
	 	'rules' => 'trim|required|min_length[8]|max_length[50]|valid_email|callback__unique_email'
		]
	],
	'password' => [
		[
		'field' => 'old_password', 'label' => 'Old Password',
	 	'rules' => 'trim|required|max_length[50]|callback__validate_old_pass'
	 	],
		[
		'field' => 'password', 'label' => 'New Password',
	 	'rules' => 'trim|required|max_length[50]'
	 	],
		[
		'field' => 'confirm_password', 'label' => 'Confirm Password',
		 'rules' => 'trim|required|max_length[50]|matches[password]'
		]
	]
];