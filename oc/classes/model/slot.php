<?php defined('SYSPATH') or die('No direct script access.');
/**
 * User Roles
 *
 * @author      Slobodan <slobodan.josifovic@gmail.com>
 * @package     Core
 * @copyright   (c) 2014 Slobodan Josifovic
 * @license     GPL v3
 */

class Model_Slot extends ORM {

    /**
     * @var  string  Table name
     */
    protected $_table_name = 'slots';

    /**
     * @var  string  PrimaryKey field name
     */
    protected $_primary_key = 'id_slot';

    public function form_setup($form)
    {
       
    }
    
    public function exclude_fields()
    {
        return array('id_slot');
    }
}