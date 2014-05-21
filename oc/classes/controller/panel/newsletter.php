<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller Translations
 */


class Controller_Panel_Newsletter extends Auth_Controller {



    public function action_index()
    {
        Breadcrumbs::add(Breadcrumb::factory()->set_title(__('Newsletter')));  
        $this->template->title = __('Newsletter');

        //count all users
        $user = new Model_User();
        $user->where('status','=',Model_User::STATUS_ACTIVE);
        $count_all_users = $user->count_all();
        
        //orders per product, not accuarate since 1 user could buy more than 1 product but will do
        $query = DB::select(DB::expr('COUNT(id_order) count'))
                        ->select('p.title')
                        ->select('p.id_product')
                        ->from(array('products','p'))
                        ->join(array('orders','o'))
                        ->using('id_product')
                        ->where('o.status','=',Model_Order::STATUS_PAID)
                        ->group_by('p.id_product')
                        ->execute();
        $products = $query->as_array();

        //post done sending newsletter
        if($this->request->post() AND Core::post('subject')!=NULL)
        {
            $users = array();

            if (core::post('send_all')=='on')
            {
                $query = DB::select('email')->select('name')
                        ->from('users')
                        ->where('status','=',Model_User::STATUS_ACTIVE)
                        ->execute();

                $users = array_merge($users,$query->as_array());
            }
            
            if (Theme::get('premium')==1)
            {
                if (core::post('send_expired_support')=='on')
                {
                    $query = DB::select('email')->select('name')
                            ->from(array('users','u'))
                            ->join(array('orders','o'))
                            ->using('id_user')
                            ->where('o.status','=',Model_Order::STATUS_PAID)
                            ->group_by('u.id_user')
                            ->execute();

                    $users = array_merge($users,$query->as_array());
                }

                if (is_numeric(core::post('send_product')))
                {
                    $query = DB::select('email')->select('name')
                            ->from(array('users','u'))
                            ->join(array('orders','o'))
                            ->using('id_user')
                            ->where('o.id_product','=',core::post('send_product'))
                            ->where('o.status','=',Model_Order::STATUS_PAID)
                            ->group_by('u.id_user')
                            ->execute();

                    $users = array_merge($users,$query->as_array());
                }
            }
            //NOTE $users may have duplicated emails, but phpmailer takes care of not sending the email 2 times to same recipient
            
            //sending!
            if (count($users)>0)
            {
                if ( !Email::send($users,'',Core::post('subject'),Core::post('description'),Core::post('from'), Core::post('from_email') ) )
                    Alert::set(Alert::ERROR,__('Error on mail delivery, not sent'));
                else 
                    Alert::set(Alert::SUCCESS,__('Email sent'));
            }
            else
            {
                Alert::set(Alert::ERROR,__('Mail not sent'));
            }

        }

        $this->template->content = View::factory('oc-panel/pages/newsletter',array( 'count_all_users'       => $count_all_users,
                                                                                    'products' => $products
                                                                                    )
                                                                                );

    }




}//end of controller