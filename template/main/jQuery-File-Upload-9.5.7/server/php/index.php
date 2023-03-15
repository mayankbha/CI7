<?php
//print_r($_SERVER);
//exit;
//include($_SERVER['DOCUMENT_ROOT'].'/application/config/config.php');
if($_SERVER['HTTP_HOST']=='www.dumpflings.com'){
	$options = array(
		'delete_type' => 'POST',
		'db_host' => 'localhost',
		'db_user' => 'westda6_user',
		'db_pass' => '!xbgG12345',
		'db_name' => 'westda6_dating'
	);
} else {
	$options = array(
		'delete_type' => 'POST',
		'db_host' => 'localhost',
		'db_user' => 'root',
		'db_pass' => '',
		'db_name' => 'dating'
	);
}	

if(isset($_POST['save'])&&$_POST['save']=='ID'){

	$options['db_table']='submitted_id';
	$options['user_id']=$_POST['user_id'];
	$options['upload_dir']=$_SERVER['DOCUMENT_ROOT'].'/uploads/id/';
	$options['uploaded_url']='http://'.$_SERVER['HTTP_HOST'].'uploads/id/';
			
			
	error_reporting(E_ALL | E_STRICT);
	require('UploadHandler.php');
	class CustomUploadHandler extends UploadHandler {

		protected function initialize() {
			$this->db = new mysqli(
				$this->options['db_host'],
				$this->options['db_user'],
				$this->options['db_pass'],
				$this->options['db_name']
			);
			parent::initialize();
			$this->db->close();
		}

		protected function handle_form_data($file, $index) {
			$file->title = @$_REQUEST['title'][$index];
			$file->description = @$_REQUEST['description'][$index];
		}

		protected function handle_file_upload($uploaded_file, $name, $size, $type, $error,
				$index = null, $content_range = null) {
			$file = parent::handle_file_upload(
				$uploaded_file, $name, $size, $type, $error, $index, $content_range
			);
			if (empty($file->error)) {
				$sql = 'INSERT INTO `'.$this->options['db_table']
					.'` (`name`, `size`, `type`, `title`, `description`, `user_id`)'
					.' VALUES (?, ?, ?, ?, ?, ?)';
				$query = $this->db->prepare($sql);
				$isss = 'ssssss';
				$query->bind_param(
					$isss,
					$file->name,
					$file->size,
					$file->type,
					$file->title,
					$file->description,
					$this->options['user_id']
				);
				$query->execute();
				$file->id = $this->db->insert_id;
			}
			return $file;
		}

		protected function set_additional_file_properties($file) {
			parent::set_additional_file_properties($file);
			if ($_SERVER['REQUEST_METHOD'] === 'GET') {
				$sql = 'SELECT `id`, `type`, `title`, `description` FROM `'
					.$this->options['db_table'].'` WHERE `name`=?';
				$query = $this->db->prepare($sql);
				$query->bind_param('s', $file->name);
				$query->execute();
				$query->bind_result(
					$id,
					$type,
					$title,
					$description
				);
				while ($query->fetch()) {
					$file->id = $id;
					$file->type = $type;
					$file->title = $title;
					$file->description = $description;
				}
			}
		}

		public function delete($print_response = true) {
			$response = parent::delete(false);
			foreach ($response as $name => $deleted) {
				if ($deleted) {
					$sql = 'DELETE FROM `'
						.$this->options['db_table'].'` WHERE `name`=?';
					$query = $this->db->prepare($sql);
					$query->bind_param('s', $name);
					$query->execute();
				}
			} 
			return $this->generate_response($response, $print_response);
		}

	}

	$upload_handler = new CustomUploadHandler($options);
} elseif (isset($_POST['save'])&&$_POST['save']=='profile'){

	$options['db_table']='profile_pics';
	$options['user_id']=$_POST['user_id'];
	$options['upload_dir']=$_SERVER['DOCUMENT_ROOT'].'/uploads/profile/';
	$options['uploaded_url']='http://'.$_SERVER['HTTP_HOST'].'uploads/profile/';
		
	error_reporting(E_ALL | E_STRICT);
	require('UploadHandler.php');
	class CustomUploadHandler extends UploadHandler {

		protected function initialize() {
			$this->db = new mysqli(
				$this->options['db_host'],
				$this->options['db_user'],
				$this->options['db_pass'],
				$this->options['db_name']
			);
			parent::initialize();
			$this->db->close();
		}

		protected function handle_form_data($file, $index) {
			$file->title = @$_REQUEST['title'][$index];
			$file->description = @$_REQUEST['description'][$index];
		}

		protected function handle_file_upload($uploaded_file, $name, $size, $type, $error,
				$index = null, $content_range = null) {
			$file = parent::handle_file_upload(
				$uploaded_file, $name, $size, $type, $error, $index, $content_range
			);
			if (empty($file->error)) {
				$sql = 'INSERT INTO `'.$this->options['db_table']
					.'` (`name`, `size`, `type`, `title`, `description`, `user_id`)'
					.' VALUES (?, ?, ?, ?, ?, ?)';
				$query = $this->db->prepare($sql);
				$isss = 'ssssss';
				$query->bind_param(
					$isss,
					$file->name,
					$file->size,
					$file->type,
					$file->title,
					$file->description,
					$this->options['user_id']
				);
				$query->execute();
				$file->id = $this->db->insert_id;
			}
			return $file;
		}

		protected function set_additional_file_properties($file) {
			parent::set_additional_file_properties($file);
			if ($_SERVER['REQUEST_METHOD'] === 'GET') {
				$sql = 'SELECT `id`, `type`, `title`, `description` FROM `'
					.$this->options['db_table'].'` WHERE `name`=?';
				$query = $this->db->prepare($sql);
				$query->bind_param('s', $file->name);
				$query->execute();
				$query->bind_result(
					$id,
					$type,
					$title,
					$description
				);
				while ($query->fetch()) {
					$file->id = $id;
					$file->type = $type;
					$file->title = $title;
					$file->description = $description;
				}
			}
		}

		public function delete($print_response = true) {
			$response = parent::delete(false);
			foreach ($response as $name => $deleted) {
				if ($deleted) {
					$sql = 'DELETE FROM `'
						.$this->options['db_table'].'` WHERE `name`=?';
					$query = $this->db->prepare($sql);
					$query->bind_param('s', $name);
					$query->execute();
				}
			} 
			return $this->generate_response($response, $print_response);
		}

	}

	$upload_handler = new CustomUploadHandler($options);

}
