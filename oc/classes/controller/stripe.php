<?php defined('SYSPATH') or die('No direct script access.');

/**
* Stripe class
*
* @package Open Classifieds
* @subpackage Core
* @category Helper
* @author Chema Garrido <chema@open-classifieds.com>
* @license GPL v3
*/

class Controller_Stripe extends Controller{
	
	/**
	 * [action_form] generates the form to pay at paypal
	 */
	public function action_pay()
	{ 
		$this->auto_render = FALSE;

        $seotitle = $this->request->param('id');

        $product = new Model_product();
        $product->where('seotitle','=',$seotitle)
            ->where('status','=',Model_Product::STATUS_ACTIVE)
            ->limit(1)->find();

        if ($product->loaded())
        {

            if ( isset( $_POST[ 'stripeToken' ] ) ) 
            {
                // include class vendor
                require Kohana::find_file('vendor/stripe/lib', 'Stripe');

                // Set your secret key: remember to change this to your live secret key in production
                // See your keys here https://manage.stripe.com/account
                Stripe::setApiKey(Core::config('payment.stripe_private'));

                // Get the credit card details submitted by the form
                $token = Core::post('stripeToken');

                // email
                $email = Core::post('stripeEmail');

                // Create the charge on Stripe's servers - this will charge the user's card
                try 
                {
                    $charge = Stripe_Charge::create(array(
                                                        "amount"    => StripeKO::money_format($product->final_price()), // amount in cents, again
                                                        "currency"  => $product->currency,
                                                        "card"      => $token,
                                                        "description" => $product->title)
                                                    );

                    if (!Auth::instance()->logged_in())
                    {
                        //create user if doesnt exists and send email to user with password
                        $user = Model_User::create_email($email,core::post('stripeBillingName',$email));
                    }
                    else//he was loged so we use his user
                        $user = Auth::instance()->get_user();

                    //create order
                    $order = Model_Order::sale(NULL,$user,$product,Core::post('stripeToken'),'stripe');
                    
                    //redirect him to the thanks page
                    $this->request->redirect(Route::url('product-goal', array('seotitle'=>$product->seotitle,
                                                                              'category'=>$product->category->seoname,
                                                                              'order'   =>$order->id_order)));
                }
                catch(Stripe_CardError $e) 
                {
                    // The card has been declined
                    Kohana::$log->add(Log::ERROR, 'Stripe The card has been declined');
                    Alert::set(Alert::ERROR, 'Stripe The card has been declined');
                    $this->request->redirect(Route::url('product', array('seotitle'=>$product->seotitle,'category'=>$product->category->seoname)));
                }
                
            }
            else
            {
                Alert::set(Alert::INFO, __('Please fill your card details.'));
                $this->request->redirect(Route::url('product', array('seotitle'=>$product->seotitle,'category'=>$product->category->seoname)));
            }
			
		}
		else
		{
			Alert::set(Alert::INFO, __('Product could not be loaded'));
            $this->request->redirect(Route::url('product', array('seotitle'=>$product->seotitle,'category'=>$product->category->seoname)));
		}
	}


    /**
     * [action_form] generates the js for stripe
     */
    public function action_javascript()
    { 
        $this->auto_render = FALSE;

        $seotitle = $this->request->param('id');

        $product = new Model_product();
        $product->where('seotitle','=',$seotitle)
            ->where('status','=',Model_Product::STATUS_ACTIVE)
            ->limit(1)->find();

        if ($product->loaded())
        {
            $this->template = View::factory('js');
            $this->template->content = View::factory('pages/stripe/js',array('product'=>$product));
        }
        else
        {
            Alert::set(Alert::INFO, __('Product could not be loaded'));
            $this->request->redirect(Route::url('product', array('seotitle'=>$product->seotitle,'category'=>$product->category->seoname)));
        }
    }

}