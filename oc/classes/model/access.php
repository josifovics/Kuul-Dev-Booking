<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Controllers user access
 *
 * @author      Chema <chema@open-classifieds.com>
 * @package     Core
 * @copyright   (c) 2009-2013 Open Classifieds Team
 * @license     GPL v3
 */

class Model_Access extends ORM {

    /**
     * @var  string  Table name
     */
    protected $_table_name = 'access';

    /**
     * @var  string  PrimaryKey field name
     */
    protected $_primary_key = 'id_access';


    /**
     * get all the controllers and the actions that can be used
     * @return array 
     */
    public static function list_controllers()
    {
        $list_controllers = array();

        $controllers = Kohana::list_files('classes/controller/panel');

        foreach ($controllers as $controller) 
        {
            $controller = basename($controller,'.php');

            $class      = new ReflectionClass('Controller_Panel_'.$controller);
            $methods    = $class->getMethods();
            foreach ($methods as $obj => $val) 
            {
                if (strpos( $val->name , 'action_') !== FALSE )
                {
                    $list_controllers[$controller][] = str_replace('action_', '', $val->name);
                }
            }
        }

        return $list_controllers;
    }


    public function form_setup($form)
    {
       
    }

    public function exclude_fields()
    {
    
    }


 protected $_table_columns =     
array (
  'id_access' => 
  array (
    'type' => 'int',
    'min' => '0',
    'max' => '4294967295',
    'column_name' => 'id_access',
    'column_default' => NULL,
    'data_type' => 'int unsigned',
    'is_nullable' => false,
    'ordinal_position' => 1,
    'display' => '10',
    'comment' => '',
    'extra' => 'auto_increment',
    'key' => 'PRI',
    'privileges' => 'select,insert,update,references',
  ),
  'id_role' => 
  array (
    'type' => 'int',
    'min' => '0',
    'max' => '4294967295',
    'column_name' => 'id_role',
    'column_default' => NULL,
    'data_type' => 'int unsigned',
    'is_nullable' => false,
    'ordinal_position' => 2,
    'display' => '10',
    'comment' => '',
    'extra' => '',
    'key' => '',
    'privileges' => 'select,insert,update,references',
  ),
  'access' => 
  array (
    'type' => 'string',
    'column_name' => 'access',
    'column_default' => NULL,
    'data_type' => 'varchar',
    'is_nullable' => false,
    'ordinal_position' => 3,
    'character_maximum_length' => '100',
    'collation_name' => 'utf8_general_ci',
    'comment' => '',
    'extra' => '',
    'key' => '',
    'privileges' => 'select,insert,update,references',
  ),
);

}