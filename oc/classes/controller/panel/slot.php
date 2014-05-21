<?php 

class Controller_Panel_Slot extends Auth_Crud {

	/**
	 * @var $_index_fields ORM fields shown in index
	 */
	protected $_index_fields = array('id_slot', 'spaces', 'extra_price');

	/**
	 * @var $_orm_model ORM model name
	 */
	protected $_orm_model = 'slot';

    protected $_belongs_to = array(
        'product' => array(
                'model'       => 'product',
                'foreign_key' => 'id_product',
            ),
    );
    /**
     *
     * Loads a basic list info
     * @param string $view template to render 
     */
    public function action_index($view = NULL)
    {
        $slot = new Model_Slot();
        parent::action_index('oc-panel/pages/slots/index');
    } 

    /**
     * CRUD controller: UPDATE
     */
    public function action_create()
    {
        $product = new Model_Product();
        $product = $product->find_all();
        
        $obj_slot = new Model_Slot();
        if ($slot = $this->request->post())
        {
            foreach ($slot as $field => $value) 
            {   
                if($field != 'submit')
                    $obj_slot->$field = $value;
            }

            try 
            {
                $obj_slot->save();
                Alert::set(Alert::SUCCESS, __('Slot is created.'));
            } 
            catch (Exception $e) 
            {
                throw new HTTP_Exception_500($e->getMessage());
            }

            $this->request->redirect(Route::url('oc-panel', array('controller'=>'slot','action'=>'index')));
        }
        return $this->render('oc-panel/pages/slots/create', array('product'=>$product));
    }
    /**
     * CRUD controller: UPDATE
     */
    public function action_update()
    {
        $id_role = $this->request->param('id');

        $this->template->title = __('Update').' '.__($this->_orm_model).' '.$id_role;
    
        $role = new Model_Role($id_role);
        
        if ($this->request->post() AND $role->loaded())
        {
            //delete all the access
            DB::delete('access')->where('id_role','=',$role->id_role)->execute();
            //set all the access where post = on
            foreach ($_POST as $key => $value) 
            {
                if ($value == 'on')
                {
                   DB::insert('access', array('id_role','access' ))->values(array($role->id_role, str_replace('|', '.', $key)))->execute();
                }
            }

            //saving the role params
            $role->name = core::post('name');
            $role->description = core::post('description');
            $role->save();            

            Alert::set(Alert::SUCCESS, __('Item updated'));
           
            $this->request->redirect(Route::get($this->_route_name)->uri(array('controller'=> Request::current()->controller())));
           
        }

        //getting controllers actions
        $controllers = Model_Access::list_controllers();

        //get all the access this user has
        $query = DB::select('access')
                        ->from('access')
                        ->where('id_role','=',$id_role)                        
                        ->execute();

        $access_in_use = array_keys($query->as_array('access'));
    
   // d(in_array('access_index',$access_in_use));
//d($access_in_use);

        return $this->render('oc-panel/pages/role/update', array('role' => $role, 
                                                                'controllers' => $controllers,
                                                                'access_in_use'=>$access_in_use));
    }

	
}
