<?php

class Migration_Active_to_users extends CI_Migration {

	public function up()
	{
		$fields = (array(
			'active' => array(
				'type' => 'INT',
				'constraint' => 1,
				'default' => 0
			)
		));
		$this->dbforge->add_column('users', $fields);
	}

	public function down()
	{
		$this->dbforge->drop_column('users', 'active');
	}
}