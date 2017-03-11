<?php

class Model_User extends \Orm\Model{
	
		protected static $_properties = array(
		'id',
		'username',
		'password',
		'group',
		'email',
		'last_login',
		'login_hash',
		'profile_fields',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_table_name = 'users';
	
	public static function validate($factory){
		$val = Validation::forge($factory);
		$val->add('username', 'Username')
			->add_rule('required')
    	->add_rule('min_length', 4)
    	->add_rule('max_length', 12);
		$val->add('email', 'Email address')->add_rule('required')->add_rule('valid_email');
		return $val;
	}
	
	public static function validatechangepassword($factory)
	{
		$val = Validation::forge($factory);
		$val->add('password', 'Password')
			->add_rule('required');
		$val->add('newpassword', 'New password')
			->add_rule('required')
    	->add_rule('min_length', 8)
    	->add_rule('max_length', 12);
    $val->add('repeatnewpassword','Repeat New password')
    	->add_rule('required')
    	->add_rule('match_field','newpassword');
		return $val;
	}
	public static function validatechangeemail($factory)
	{
		$val = Validation::forge($factory);
		$val->add('email', 'Email address')->add_rule('required')->add_rule('valid_email');
		return $val;
	}
	public static function validatechangeprofile($factory)
	{
		$val = Validation::forge($factory);
		$val->add('username', 'Username')
			->add_rule('required')
    	->add_rule('min_length', 4)
    	->add_rule('max_length', 12);
		$val->add('email', 'Email address')->add_rule('required')->add_rule('valid_email');
		return $val;
	}
}
