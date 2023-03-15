<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends CI_Controller {

    private $data;
    private $profile;

    public function __construct() {
        parent::__construct();
        $this->data = array();

        $this->load->library('ion_auth');
        $this->load->library('form_validation');

        $this->load->model('product_model');
        $this->load->model('productcat_model');
        $this->load->model('member_model');
        $this->load->model('orders_model');
        $this->load->model('registration_model');
        $this->load->helper('url');
        $this->load->database();
        $this->db->reconnect();
        $this->load->helper('language');
        $this->load->helper('form');
        $this->load->helper('login');
        $this->lang->load('base', 'english');
        $this->lang->load('store', 'english');
        $this->lang->load('checkout', 'english');
		
		$this->lang->load('_header_navigation', $this->config->item('language'));   
		
        $this->session->set_userdata(array('current_template' => 'asian'));
        $this->data['logged'] = check_login($this->session->userdata, 'member');
        //Set Data
        $this->data['title'] = $this->lang->line('store_meta_title');
        $this->data['description'] = $this->lang->line('store_meta_description');

        //Get member 
        $this->profile = $this->member_model->get_profile($this->session->userdata['email']);
        //creadit card
        $this->load->helper('creditcard');

        // Load PayPal library
        $this->config->load('paypal');
		


        $config = array(
            'Sandbox' => $this->config->item('Sandbox'), // Sandbox / testing mode option.
            'APIUsername' => $this->config->item('APIUsername'), // PayPal API username of the API caller
            'APIPassword' => $this->config->item('APIPassword'), // PayPal API password of the API caller
            'APISignature' => $this->config->item('APISignature'), // PayPal API signature of the API caller
            'APISubject' => '', // PayPal API subject (email address of 3rd party user that has granted API permission for your app)
            'APIVersion' => $this->config->item('APIVersion')
                // API version you'd like to use for your call.  You can set a default version in the class and leave this blank if you want.
        );

        // Show Errors
        if ($config['Sandbox']) {
            error_reporting(E_ALL);
            ini_set('display_errors', '1');
        }
		
		
		//fetch login user list
		$this->data['login_user'] = $this->member_model->login_user();
		
		foreach($this->data['login_user'] as $value)
		{
			// get thread user data
			$this->data['users'][$value['id']]['avatar'] = $this->member_model->get_profile_pic($value['id']);
			$this->data['users'][$value['id']]['block_user'] = $this->mail_model->get_block_user_data($value['id']);//block user list
			$this->data['users'][$value['id']]['busy_status'] = $this->member_model->get_login_busystatus($value['id']);//login busy status
			$this->data['users'][$value['id']]['available_status'] = $this->member_model->get_login_availablestatus($value['id']);//login available status 
			$this->data['users'][$value['id']]['invisible_status'] = $this->member_model->get_login_invisiblestatus($value['id']);//login invisible status
		}
		//end login user list
		
        $this->load->library('paypal/Paypal_pro', $config);
		
		
		//same for all
		 if (!$this->ion_auth->logged_in())
        {
            $this->data['logged']	=	check_login($this->session->userdata, 'member');
        }
		$this->data['donate_user']	=	$this->member_model->donate_user($this->session->userdata['user_id']);
		//get newest member
		$this->data['newest_member'] = $this->member_model->get_newest_member_list();
		foreach($this->data['newest_member'] as $value)
			{
				$this->data['users'][$value['id']]['avatar'] = $this->member_model->get_profile_pic($value['id']);
				$this->data['users'][$value['id']]['age_between'] = $this->member_model->age_between($value['id']);  //age_between
			}
		//get profile pic at header
		$this->data['profile'] = $this->member_model->get_profile($this->session->userdata['email']);
		
		foreach($this->data['profile'] as $value)
			{
				//get thread user profile pic
				$this->data['users']['avatar'] = $this->member_model->get_profile_pic($this->session->userdata['user_id']);
			}
    }

    public function index($catId = 0) {
        if ($this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('checkout/billing', 'refresh');
        }

        $this->load->shop_template('checkout-type', $this->session->userdata['current_template'], $this->data, $return = FALSE);
    }

    public function _check_phone($phone) {
        if (preg_match('/^([0-9]( |-)?)?(\(?[0-9]{3}\)?|[0-9]{3})( |-)?([0-9]{3}( |-)?[0-9]{4}|[a-zA-Z0-9]{7})$/', $phone)) {
            return true;
        } else {
            $this->form_validation->set_message('_check_phone', '%s ' . $phone . ' is invalid format');
            return false;
        }
    }

    public function billing($catId = 0) {
        //echo '<pre>';print_r($this->profile);die;
        //echo "<pre>"; print_r($this->input->post()); 
        $paypal_flag = 0;
        $items = array();
        $counter = 0;
        $quantity = $this->input->post('quantity');
        $unit_price = $this->input->post('unit_price');
        $unit_total = $this->input->post('unit_total');
        $product_amount = $this->input->post('product_amount');
        $product_title = $this->input->post('product_title');
        $this->data['countries'] = $this->product_model->get_country_list();

        if ($this->input->post('product_id')) {
            foreach ($this->input->post('product_id') as $data => $product_id) {
                $temp = array(
                    'product_id' => $product_id,
                    'quantity' => $quantity[$counter],
                    'unit_price' => $unit_price[$counter],
                    'unit_total' => $unit_total[$counter],
                    'product_title' => $product_title[$counter],
                );
                $items[$data] = $temp;
                $counter++;
            }
        }

        $final_items = array(
            'tax_amount' => $this->input->post('tax_amount'),
            'total' => $this->input->post('total'),
            'product_amount' => $this->input->post('product_amount')
        );
        $this->session->set_userdata('final_items', $final_items);
        $this->session->set_userdata('items', $items);

        $this->data['items'] = $this->session->userdata('items');
        $this->data['final_items'] = $this->session->userdata('final_items');

        if ($this->input->post('place_order')) {

            //validate form input

            $this->form_validation->set_rules('b_first_name', 'First Name', 'required|xss_clean');
            $this->form_validation->set_rules('b_last_name', 'Last Name', 'required|xss_clean');
            $this->form_validation->set_rules('b_phone', 'Phone number', 'trim|xss_clean|required|numeric');
            $this->form_validation->set_rules('b_address_1', 'Address', 'required|xss_clean');
            $this->form_validation->set_rules('b_country_id', 'Country', 'required|xss_clean');
            $this->form_validation->set_rules('b_state', 'State', 'required|xss_clean');
            $this->form_validation->set_rules('b_city', 'City', 'required|xss_clean');
            $this->form_validation->set_rules('b_zip', 'Zip', 'required|xss_clean');
            $this->form_validation->set_rules('s_first_name', 'First Name', 'required|xss_clean');
            $this->form_validation->set_rules('s_last_name', 'Last Name', 'required|xss_clean');
            $this->form_validation->set_rules('s_phone', 'Phone number', 'trim|xss_clean|required|numeric');
            $this->form_validation->set_rules('s_address_1', 'Address', 'required|xss_clean');
            $this->form_validation->set_rules('s_country_id', 'Country', 'required|xss_clean');
            $this->form_validation->set_rules('s_state', 'State', 'required|xss_clean');
            $this->form_validation->set_rules('s_city', 'City', 'required|xss_clean');
            $this->form_validation->set_rules('member_id', 'Member ID', 'required|xss_clean');
            $this->form_validation->set_rules('s_zip', 'Zip', 'required|xss_clean');

            if ($this->input->post('payment-method') == "credit") {
                $this->load->helper('creditcard');
                $this->form_validation->set_rules('credit_card_type', 'Credit Card', 'required|xss_clean');
                $this->form_validation->set_rules('credit_card_number', 'Credit Card Number', 'required|xss_clean|numeric');
                $this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
                $this->form_validation->set_rules('month', 'Month', 'required|xss_clean');
                $this->form_validation->set_rules('year', 'Year', 'required|xss_clean');
                $this->form_validation->set_rules('cvv', 'Year', 'required|xss_clean');
            }
            if ($this->input->post('payment-method') == "paypal") {
                $paypal_flag = 1;
                $this->form_validation->set_rules('paypal_email', 'Paypal Email', 'required|xss_clean');
                $this->form_validation->set_rules('paypal_password', 'Paypal Password', 'required|xss_clean');
            }
            $this->form_validation->set_rules('confirm', 'Checkbox', 'required|xss_clean');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

            if ($this->form_validation->run() == FALSE) {
                $this->data['paypal_error'] = "";
                $this->data['profile'] = $this->profile;
                $this->data['countries'] = $this->product_model->get_country_list();
                $this->data['items'] = $this->session->userdata('items');
                $this->data['final_items'] = $this->session->userdata('final_items');
                $this->data['paypal_flag'] = $paypal_flag;
                $this->load->shop_template('checkout-billing', $this->session->userdata['current_template'], $this->data, $return = FALSE);
            } else {
                if ($this->input->post('payment-method') == "paypal") { // if post paypal details
                    $SECFields = array(
                        'token' => '',
                        //'maxamt' => '300', 					
                        'returnurl' => $this->config->item('returnurl'),
                        'cancelurl' => $this->config->item('cancelurl'),
                        'LOGOIMG' => $this->config->item('LOGOIMG'),
                        'pagestyle' => '',
                        'hdrimg' => '',
                        'hdrbordercolor' => '',
                        'hdrbackcolor' => '',
                        'payflowcolor' => '',
                        'skipdetails' => '',
                        'email' => $this->input->post('paypal_email'),
                        'solutiontype' => '',
                        'landingpage' => '',
                        'channeltype' => '',
                        'giropaysuccessurl' => '',
                        'giropaycancelurl' => '',
                        'banktxnpendingurl' => '',
                        'brandname' => '',
                        'customerservicenumber' => '',
                        'giftmessageenable' => '1',
                        'giftreceiptenable' => '1',
                        'giftwrapenable' => '1',
                        'giftwrapname' => 'gifts',
                        'giftwrapamount' => '',
                        'buyeremailoptionenable' => '1',
                        'surveyquestion' => '',
                        'surveyenable' => '',
                        'totaltype' => '',
                        'notetobuyer' => '',
                        'buyerid' => '',
                        'buyerusername' => '',
                        'buyerregistrationdate' => '',
                        'allowpushfunding' => ''
                    );

                    /* $SurveyChoices = array('Choice 1', 'Choice2', 'Choice3', 'etc'); */
                    $bill = $this->session->userdata('final_items');
                    $Payments = array();
                    $Payment = array(
                        'amt' => $bill['product_amount'],
                        'currencycode' => 'USD',
                        'itemamt' => $bill['total'],
                        'shippingamt' => '',
                        'shipdiscamt' => '',
                        'handlingamt' => '',
                        'taxamt' => $bill['tax_amount'],
                        'desc' => '',
                        'custom' => '',
                        'invnum' => '',
                        'notifyurl' => $this->config->item('notifyurl')
                    );



                    $PaymentOrderItems = array();
                    foreach ($this->session->userdata('items') as $res2) {

                        $Item = array(
                            'name' => $res2['product_title'],
                            'desc' => $res2['product_title'],
                            'amt' => $res2['unit_price'],
                            'qty' => $res2['quantity'],
                            'taxamt' => '',
                            'itemcategory' => '',
                        );

                        array_push($PaymentOrderItems, $Item);
                        $Payment['order_items'] = $PaymentOrderItems;
                    }
                    array_push($Payments, $Payment);

                    $BuyerDetails = array(
                        'buyerid' => '',
                        'buyerusername' => '',
                        'buyerregistrationdate' => ''
                    );


                    $PayPalRequestData = array(
                        'SECFields' => $SECFields,
                        /* 'SurveyChoices' => $SurveyChoices, */
                        'Payments' => $Payments,
                        'BuyerDetails' => $BuyerDetails
                    );

                    //echo "<pre>"; print_r($PayPalRequestData); die;	
                    $PayPalResult = $this->paypal_pro->SetExpressCheckout($PayPalRequestData);
                    //} //foreach
                    if (!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])) {

                        $this->data['items'] = $this->session->userdata('items');
                        $this->data['final_items'] = $this->session->userdata('final_items');
                        $this->data['profile'] = $this->profile;
                        $this->data['paypal_error'] = array('Errors' => $PayPalResult['ERRORS']);
                        $this->data['paypal_flag'] = 1;
                        $this->data['paypal_err'] = "Error occured the Transaction could not be loaded. Please try again";

                        $this->load->shop_template('checkout-billing', $this->session->userdata['current_template'], $this->data, $return = FALSE);


                        //redirect("/store/");
                    } else {

                        $final_amt = $this->session->userdata('final_items');
                        $insert_data = array(
                            'user_id' => $this->session->userdata['user_id'],
                            'b_first_name' => $this->input->post('b_first_name'),
                            'b_last_name' => $this->input->post('b_last_name'),
                            'b_phone' => $this->input->post('b_phone'),
                            'b_address_1' => $this->input->post('b_address_1'),
                            'b_address_2' => $this->input->post('b_address_2'),
                            'b_company' => $this->input->post('b_company'),
                            'b_state' => $this->input->post('b_state'),
                            'b_country_id' => $this->input->post('b_country_id'),
                            'b_city' => $this->input->post('b_city'),
                            'b_zip' => $this->input->post('b_zip'),
                            'b_city' => $this->input->post('b_city'),
                            's_first_name' => $this->input->post('s_first_name'),
                            's_last_name' => $this->input->post('s_last_name'),
                            's_phone' => $this->input->post('s_phone'),
                            's_address_1' => $this->input->post('s_address_1'),
                            's_address_2' => $this->input->post('s_address_2'),
                            's_company' => $this->input->post('s_company'),
                            's_country_id' => $this->input->post('s_country_id'),
                            's_state' => $this->input->post('s_state'),
                            's_city' => $this->input->post('s_city'),
                            's_zip' => $this->input->post('s_zip'),
                            'shipping_method' => $this->input->post('payment-method'),
                            'product_amount' => $final_amt['product_amount'],
                            'ship_amount' => $final_amt['total'],
                            'tax_amount' => $final_amt['tax_amount'],
                            'created_date' => date("Y-m-d H:i:s")
                        );

                        $tbl_name = "order";
                        $insert_id = $this->product_model->add_order($tbl_name, $insert_data);

                        // add order_details of users 

                        if ($insert_id) {
                            $tbl_name = "order_details";
                            //print_r($items); die;
                            foreach ($this->session->userdata('items') as $res) {

                                $data2['order_id'] = $insert_id;
                                $data2['product_id'] = $res['product_id'];
                                $data2['quantity'] = $res['quantity'];
                                $data2['unit_price'] = $res['unit_price'];
                                $data2['total'] = $res['unit_total'];

                                $insert_sec = $this->product_model->add_order($tbl_name, $data2);
                            }
                            if ($insert_sec) {
                                $ord_id = $this->session->set_userdata("order_id", $insert_id);
                                $this->confirmation_mail();
                                header('Location: ' . $PayPalResult['REDIRECTURL']);
                                exit();
                            }
                        }
                    }
                } else { 
					// if post credit card details
                    if ($this->session->userdata('items')) {
                        //foreach($this->session->userdata('items') as $result){

                        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

                        $DPFields = array(
                            'paymentaction' => 'Sale',
                            'ipaddress' => $_SERVER['REMOTE_ADDR'],
                            'returnfmfdetails' => '1'
                        );

                        $CCDetails = array(
                            'creditcardtype' => $this->input->post('credit_card_type'),
                            'acct' => str_replace(' ', '', $this->input->post('credit_card_number')), // 4482559397974316 
                            'expdate' => $this->input->post('month') . "" . $this->input->post('year'),
                            'cvv2' => $this->input->post('cvv'),
                            'startdate' => '', // Month and year that Maestro or Solo card was issued.  MMYYYY
                            'issuenumber' => ''       // Issue number of Maestro or Solo card.  Two numeric digits max.
                        );



                        $PayerInfo = array(
                            'email' => $this->session->userdata('email'),
                            'payerid' => '',
                            'payerstatus' => '',
                            //'business' => 'Testers, LLC'
                        );


                        $PayerName = array(
                            'salutation' => 'Mr.',
                            'firstname' => $this->session->userdata('first_name'),
                            'middlename' => '',
                            'lastname' => $this->session->userdata('last_name'),
                            'suffix' => ''
                        );

                        $BillingAddress = array(
                            'street' => $this->input->post('b_address_1'),
                            'street2' => '',
                            'city' => $this->input->post('b_city'),
                            'state' => $this->input->post('b_state'),
                            'countrycode' => 'US',
                            'zip' => $this->input->post('b_zip'),
                            'phonenum' => $this->input->post('b_phone'),
                        );


                        $ShippingAddress = array(
                            'shiptoname' => $this->input->post('s_first_name') . " " . $this->input->post('s_last_name'),
                            'shiptostreet' => '',
                            'shiptostreet2' => '',
                            'shiptocity' => $this->input->post('s_city'),
                            'shiptostate' => $this->input->post('s_city'),
                            'shiptozip' => $this->input->post('s_zip'),
                            'shiptocountry' => 'US',
                            'shiptophonenum' => $this->input->post('s_phone')
                        );


                        $bill = $this->session->userdata('final_items');
                        //echo '<pre>'; print_r($bill);die('<br>'.__FILE__.__LINE__);
                        $PaymentDetails = array(
                            'amt' => $bill['product_amount'],
                            'currencycode' => 'USD',
                            'itemamt' => $bill['total'],
                            'shippingamt' => '',
                            'shipdiscamt' => '',
                            'handlingamt' => '',
                            'taxamt' => $bill['tax_amount'],
                            'desc' => 'Web Order',
                            'custom' => '',
                            'invnum' => '',
                            'notifyurl' => ''
                        );



                        $PayPalRequestData = array(
                            'DPFields' => $DPFields,
                            'CCDetails' => $CCDetails,
                            'PayerInfo' => $PayerInfo,
                            'PayerName' => $PayerName,
                            'BillingAddress' => $BillingAddress,
                            'ShippingAddress' => $ShippingAddress,
                            'PaymentDetails' => $PaymentDetails,
                        );
                        //echo "<pre>"; print_r($PayPalRequestData);die(__LINE__.__DIR__);

                        $PayPalResult = $this->paypal_pro->DoDirectPayment($PayPalRequestData);
                        //echo '<pre>'; print_r($PayPalResult); die;
                        // }
                        //print_r($PayPalResult); die; 
                    }


                    $cardtype = $this->input->post('credit_card_number');
                    $cardnumber = $this->input->post('credit_card_type');
                    $err_msg = validateCC($cardtype, $cardnumber);
                    if ($err_msg == 0) {
                        $this->data['err_msg'] = "Please Enter a valid card number";
                    }


                    if (empty($PayPalResult['RAWRESPONSE']) || !($this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))) {
                        $this->data['paypal_error'] = "";
                        $this->data['items'] = $this->session->userdata('items');
                        $this->data['final_items'] = $this->session->userdata('final_items');
                        $this->data['profile'] = $this->profile;
                        //$this->data['countries'] 	   =  $this->product_model->get_country_list();
                        $this->data['paypal_error'] = array('Errors' => $PayPalResult['ERRORS']);
                        if (empty($PayPalResult)) {
                            $this->data['paypal_error'] = "The Transaction could not be loaded";
                        }
                        //echo "<pre>"; print_r($this->data['paypal_error']); die;
                        $this->load->shop_template('checkout-billing', $this->session->userdata['current_template'], $this->data, $return = FALSE);
                    } else {
                        $final_amt = $this->session->userdata('final_items');
                        $insert_data = array(
                            'user_id' => $this->session->userdata['user_id'],
                            'b_first_name' => $this->input->post('b_first_name'),
                            'b_last_name' => $this->input->post('b_last_name'),
                            'b_phone' => $this->input->post('b_phone'),
                            'b_address_1' => $this->input->post('b_address_1'),
                            'b_address_2' => $this->input->post('b_address_2'),
                            'b_company' => $this->input->post('b_company'),
                            'b_state' => $this->input->post('b_state'),
                            'b_country_id' => $this->input->post('b_country_id'),
                            'b_city' => $this->input->post('b_city'),
                            'b_zip' => $this->input->post('b_zip'),
                            'b_city' => $this->input->post('b_city'),
                            's_first_name' => $this->input->post('s_first_name'),
                            's_last_name' => $this->input->post('s_last_name'),
                            's_phone' => $this->input->post('s_phone'),
                            's_address_1' => $this->input->post('s_address_1'),
                            's_address_2' => $this->input->post('s_address_2'),
                            's_company' => $this->input->post('s_company'),
                            's_country_id' => $this->input->post('s_country_id'),
                            's_state' => $this->input->post('s_state'),
                            's_city' => $this->input->post('s_city'),
                            's_zip' => $this->input->post('s_zip'),
                            'shipping_method' => $this->input->post('payment-method'),
                            'product_amount' => $final_amt['product_amount'],
                            //'ship_amount' => $final_amt['total'],
                            'total_amount' => $final_amt['total'],
                            'tax_amount' => $final_amt['tax_amount'],
                            'created_date' => date("Y-m-d H:i:s")
                        );

                        $tbl_name = "order";
                        $insert_id = $this->product_model->add_order($tbl_name, $insert_data);
						
						//echo $insert_id; die('<br>'.__FILE__ .' AT '. __LINE__);
						
                        // add order_details of users 
						if ($insert_id) {
							$this->session->set_userdata("order_id", $insert_id);
                            $tbl_name = "order_details";

                            foreach ($this->session->userdata('items') as $res) {

                                $data2['order_id'] = $insert_id;
                                $data2['product_id'] = $res['product_id'];
                                $data2['quantity'] = $res['quantity'];
                                $data2['unit_price'] = $res['unit_price'];
                                $data2['total'] = $res['unit_total'];

                                $insert_sec = $this->product_model->add_order($tbl_name, $data2);
                            }
						
                            if ($insert_sec) {
								
                                $data = array('PayPalResult' => $PayPalResult);
                                $datas['order_id'] = $insert_id;
                                $datas['email'] = $PayPalResult['REQUESTDATA']['EMAIL'];
                                $datas['purchased_at'] = date("Y-m-d H:i:s");
                                $datas['paypal_txn_id'] = $PayPalResult['TRANSACTIONID'];
                                $datas['pay_type'] = 2;
								
                                $tbl_name = "purchases";
                                $insert_purchase = $this->product_model->add_order($tbl_name, $datas);
								//echo '<pre>'; print_r(PayPalResult); die('<br>'.__FILE__ .' AT '. __LINE__);
								
                                $this->confirmation_mail($PayPalResult['TRANSACTIONID']);
                                
                                $this->order_details['message'] = "Thank you. Your paymeny is successful please quote your reciept for any queries relating to this transaction in future. Please note that this reciept is valid subject to the realisation of your payment.";
                                $oid = $this->session->userdata("order_id");
                                $this->order_details['user_details'] = $this->orders_model->get_member_by_id($oid);
                                $this->order_details['order_details'] = $this->orders_model->orders($oid);
                                //echo "<pre>"; print_r($this->order_details['user_details']); die;
                                $this->session->unset_userdata('store_cart');
								$this->order_details['transactionId'] = $PayPalResult['TRANSACTIONID'];
                                $this->load->shop_template('success', $this->session->userdata['current_template'], $this->order_details, $return = FALSE);
                            }
                        }
                    }// else end not paypal error
                } // if post credit cared end	
            }// else form validatation ruu  
            //if not post data 
        } else {
            $this->data['paypal_error'] = "";
            $this->data['profile'] = $this->profile;
            $this->data['items'] = $this->session->userdata('items');
            $this->data['final_items'] = $this->session->userdata('final_items');
            $this->data['countries'] = $this->product_model->get_country_list();
            $this->load->shop_template('checkout-billing', $this->session->userdata['current_template'], $this->data, $return = FALSE);
        }
    }

    public function get_member_by_id() {
        $member_id = $this->input->post('member_id');
        $results['user'] = $this->member_model->get_member_by_id($member_id);
        $this->load->view('json_view', array('data' => $results));
    }

    public function confirmation_mail($transaction_id = "") {
        $email = $this->session->userdata('email');
        $config = array();
        $config['useragent'] = "CodeIgniter";
        $config['mailpath'] = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "localhost";
        $config['smtp_port'] = "25";
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
        //$this->email->set_mailtype("html");
        $this->email->initialize($config);
        $this->email->from("sitsdeveloper@gmail.com");
        $this->email->to($email);
        $this->email->subject('Your payment is successfully done');
        $message = '<p>Thank You for using our services.</p>
		<p>Your payment is successfuil.</p>
		<p>Your Tranbsaction ID is ' . $transaction_id . ' .Please note your this id to refer your transaction in future.(whether Successful,Incomplete or Failed.';
        $this->email->message($message);
        $this->email->send();
    }

    // http://stackoverflow.com/questions/10310590/paypal-gettransactiondetails-requires-transactionid-how-do-i-obtain-it
    //this is the method call when user return after payment on success page now get transaction id

    public function success() {
        $this->order_details['message'] = "Thank you. Your paymeny is successful please quote your reciept for any queries relating to this transaction in future. Please note that this reciept is valid subject to the realisation of your payment.";
        $oid = $this->session->userdata("order_id");
        $this->order_details['user_details'] = $this->orders_model->get_member_by_id($oid);
        $this->order_details['order_details'] = $this->orders_model->orders($oid);

        //to get transaction id 

        $this->session->set_userdata('token', $_REQUEST['token']);

        $PayPalResult = $this->paypal_pro->GetExpressCheckoutDetails($this->session->userdata('token'));

        $DECPFields = array(
            'token' => $PayPalResult['TOKEN'],
            'payerid' => $PayPalResult['PAYERID'],
        );

        $Payments = array();
        $Payment = array(
            'amt' => $PayPalResult['AMT'],
        );
        array_push($Payments, $Payment);

        $PayPalRequestData = array(
            'DECPFields' => $DECPFields,
            'Payments' => $Payments,
        );

        $PayResult = $this->paypal_pro->DoExpressCheckoutPayment($PayPalRequestData);
        $this->order_details['transactionId'] = $PayResult['PAYMENTS'][0]['TRANSACTIONID'];
		
		/* SAVE PAYPAL DATA*/
		$datas['order_id'] = $oid;
		//$datas['email'] = $PayPalResult['REQUESTDATA']['EMAIL'];
		$datas['purchased_at'] = date("Y-m-d H:i:s");
		$datas['paypal_txn_id'] = $PayResult['PAYMENTS'][0]['TRANSACTIONID'];
		$datas['pay_type'] = 1;
		$datas['payer_id'] = $PayPalResult['PAYERID'];
		$this->confirmation_mail($PayResult['PAYMENTS'][0]['TRANSACTIONID']);
		$tbl_name = "purchases";
		$insert_purchase = $this->product_model->add_order($tbl_name, $datas);
		
        $this->session->unset_userdata('store_cart');
        $this->load->shop_template('success', $this->session->userdata['current_template'], $this->order_details, $return = FALSE);
    }
	
	public function donation()
	{  
	    if ($this->input->post('donate')) {

            //validate form input

            $this->form_validation->set_rules('b_first_name', 'First Name', 'required|xss_clean');
            $this->form_validation->set_rules('b_last_name', 'Last Name', 'required|xss_clean');
            $this->form_validation->set_rules('b_phone', 'Phone number', 'trim|xss_clean|required|numeric');
            $this->form_validation->set_rules('b_address_1', 'Address', 'required|xss_clean');
            $this->form_validation->set_rules('b_country_id', 'Country', 'required|xss_clean');
            $this->form_validation->set_rules('b_state', 'State', 'required|xss_clean');
            $this->form_validation->set_rules('b_city', 'City', 'required|xss_clean');
            $this->form_validation->set_rules('b_zip', 'Zip', 'required|xss_clean');
         
		    //if user select credit card
			
            if ($this->input->post('payment-method') == "credit") {
                $this->load->helper('creditcard');
				$paypal_flag = 0;
                $this->form_validation->set_rules('credit_card_type', 'Credit Card', 'required|xss_clean');
                $this->form_validation->set_rules('credit_card_number', 'Credit Card Number', 'required|xss_clean|numeric');
                $this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
                $this->form_validation->set_rules('month', 'Month', 'required|xss_clean');
                $this->form_validation->set_rules('year', 'Year', 'required|xss_clean');
                $this->form_validation->set_rules('cvv', 'Year', 'required|xss_clean');
            }
			
			//if user select paypal
			
            if ($this->input->post('payment-method') == "paypal") {
                $paypal_flag = 1;
                //$this->form_validation->set_rules('paypal_email', 'Paypal Email', 'required|xss_clean');
                //$this->form_validation->set_rules('paypal_password', 'Paypal Password', 'required|xss_clean');
            }
			
            $this->form_validation->set_rules('confirm', 'Checkbox', 'required|xss_clean');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            
			//if form validation fails
			   
            if ($this->form_validation->run() == FALSE) {
			    
				$this->data['paypal_error'] = "";
                $this->data['profile'] = $this->profile;
                $this->data['countries'] = $this->product_model->get_country_list();
                $this->data['paypal_flag'] = $paypal_flag;
                $this->load->shop_template('donation', $this->session->userdata['current_template'], $this->data, $return = FALSE);
			  
			
			}
			//if form validation success 
			else 
			{
			   if($this->input->post('donation-plan') == 1.00)
			   {
			   $invalid_date = date('Y-m-d H:i:s', strtotime("+3 day"));
			   }if($this->input->post('donation-plan') == 2.00)
			   {
			     $invalid_date = date('Y-m-d H:i:s', strtotime("+7 day"));
			   }if($this->input->post('donation-plan') == 3.00)
			   {
			     $invalid_date = date('Y-m-d H:i:s', strtotime("+12 day"));
			   }
			   
			   $insert_data = array(
                            'user_id'         => $this->session->userdata['user_id'],
                            'b_first_name'    => $this->input->post('b_first_name'),
                            'b_last_name'     => $this->input->post('b_last_name'),
                            'b_phone'         => $this->input->post('b_phone'),
                            'b_address_1'     => $this->input->post('b_address_1'),
                            'b_address_2'     => $this->input->post('b_address_2'),
                            'b_company'       => $this->input->post('b_company'),
                            'b_state'         => $this->input->post('b_state'),
                            'b_country_id'    => $this->input->post('b_country_id'),
                            'b_city'          => $this->input->post('b_city'),
                            'b_zip'           => $this->input->post('b_zip'),
                            'b_city'          => $this->input->post('b_city'),
                            'shipping_method' => $this->input->post('payment-method'),
                            'plan_amount'     => $this->input->post('donation-plan'),
							'email'           => $this->session->userdata['email'],
                            'activate_date'   => date("Y-m-d H:i:s"),
							'inactivate_date' => $invalid_date,
							'status' => '0'
                        );

                        $tbl_name = "message_donation"; 
                        $insert_id = $this->product_model->add_order($tbl_name, $insert_data);
                        $donate_id = $this->session->set_userdata("donate_id", $insert_id);
			
			
			    if ($this->input->post('payment-method') == "paypal") { // if post paypal details
                    $SECFields = array(
                        'token' => '',
                        'returnurl'  => $this->config->item('returnurl'),
                        'cancelurl'  => $this->config->item('cancelurl'),
                        'LOGOIMG'    => $this->config->item('LOGOIMG'),
                        'email'      => $this->input->post('paypal_email'),
						'surveyquestion' => '',
                    );

                   
                    $Payments = array();
                    $Payment = array(
                        'amt'          => $this->input->post('donation-plan'),
                        'currencycode' => 'USD',
                        'itemamt'      => $this->input->post('donation-plan'),
                        'notifyurl'    => $this->config->item('notifyurl')
                    );



                    $PaymentOrderItems = array();
                    
                        $Item = array(
                            'name'   => 'Message Plan Donation',
                            'desc'   => 'Get message plan in small donation',
                            'amt'    => $this->input->post('donation-plan'),
                            'qty'    => '1',
                            'taxamt' => '',
                            'itemcategory' => '',
                        );

                        array_push($PaymentOrderItems, $Item);
                        $Payment['order_items'] = $PaymentOrderItems;
                  
                    array_push($Payments, $Payment);

                    $BuyerDetails = array(
                        'buyerid' => '',
                        'buyerusername' => '',
                        'buyerregistrationdate' => ''
                    );


                    $PayPalRequestData = array(
                        'SECFields' => $SECFields,
                        /* 'SurveyChoices' => $SurveyChoices, */
                        'Payments' => $Payments,
                        'BuyerDetails' => $BuyerDetails
                    );

                   // echo "<pre>"; print_r($PayPalRequestData); die;	
                    $PayPalResult = $this->paypal_pro->SetExpressCheckout($PayPalRequestData);
                    // echo "<pre>"; print_r($PayPalResult); die;
                    if (!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])) {

                        $this->data['profile'] = $this->profile;
                        $this->data['paypal_error'] = array('Errors' => $PayPalResult['ERRORS']);
                        $this->data['paypal_flag'] = 1;
                        $this->data['paypal_err'] = "Error occured the Transaction could not be loaded. Please try again";

                        $this->load->shop_template('donation', $this->session->userdata['current_template'], $this->data, $return = FALSE);


                        //redirect("/store/");
                    } else {

                                header('Location: ' . $PayPalResult['REDIRECTURL']);
                                exit();
                         }// if not paypal error
						 
                } else { 
					// if post credit card details
                  
                        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

                        $DPFields = array(
                            'paymentaction'    => 'Sale',
                            'ipaddress'        => $_SERVER['REMOTE_ADDR'],
                            'returnfmfdetails' => '1'
                        );

                        $CCDetails = array(
                            'creditcardtype'     => $this->input->post('credit_card_type'),
                            'acct'               => str_replace(' ', '', $this->input->post('credit_card_number')), // 4482559397974316 
                            'expdate'            => $this->input->post('month') . "" . $this->input->post('year'),
                            'cvv2'               => $this->input->post('cvv'),
                        );



                        $PayerInfo = array(
                            'email' => $this->session->userdata('email'),
                        );


                        $PayerName = array(
                            'salutation' => 'Mr.',
                            'firstname' => $this->session->userdata('first_name'),
                            'lastname' => $this->session->userdata('last_name')
                        );

                        $BillingAddress = array(
                            'street'      => $this->input->post('b_address_1'),
                            'street2'     => $this->input->post('b_address_2'),
                            'city'        => $this->input->post('b_city'),
                            'state'       => $this->input->post('b_state'),
                            'countrycode' => 'US',
                            'zip' 		  => $this->input->post('b_zip'),
                            'phonenum'    => $this->input->post('b_phone')
                        );

                        $PaymentDetails = array(
                            'amt' => $this->input->post('donation-plan'),
                            'currencycode' => 'USD',
                            'itemamt' => $this->input->post('donation-plan'),
                            'desc' => 'Get message plan on donation',
                        );



                        $PayPalRequestData = array(
                            'DPFields' => $DPFields,
                            'CCDetails' => $CCDetails,
                            'PayerInfo' => $PayerInfo,
                            'PayerName' => $PayerName,
                            'BillingAddress' => $BillingAddress,
                            'PaymentDetails' => $PaymentDetails,
                        );
                        //echo "<pre>"; print_r($PayPalRequestData);die(__LINE__.__DIR__);

                        $PayPalResult = $this->paypal_pro->DoDirectPayment($PayPalRequestData);
                        //echo '<pre>'; print_r($PayPalResult); die;
                      
						$cardtype        = $this->input->post('credit_card_number');
						$cardnumber      = $this->input->post('credit_card_type');
						$err_msg         = validateCC($cardtype, $cardnumber);
					   
						if ($err_msg == 0) {
							$this->data['err_msg'] = "Please Enter a valid card number";
						}
	
	
						if (empty($PayPalResult['RAWRESPONSE']) || !($this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))) {
						   
							$this->data['paypal_error'] = "";
							$this->data['profile'] = $this->profile;
							$this->data['paypal_error'] = array('Errors' => $PayPalResult['ERRORS']);
							if (empty($PayPalResult)) {
								$this->data['paypal_error'] = "The Transaction could not be loaded";
							}
							$this->load->shop_template('donation', $this->session->userdata['current_template'], $this->data, $return = FALSE);
						 } 
				     	
						else {
					 
					            $this->data['paypalrs']            = array('PayPalResult' => $PayPalResult);
                                $this->datas['paypal_txn_id']      = $PayPalResult['TRANSACTIONID'];
								$this->datas['status']             = 1;
                               
                                $tbl_name = "message_donation";
								$update= $this->product_model->update_donation_status($tbl_name, $this->datas);
								
                                $this->confirmation_mail($PayPalResult['TRANSACTIONID']);
                                
                                $this->data['message'] = "Thank you. Your paymeny is successful please quote your reciept for any queries relating to this transaction in future. Please note that this reciept is valid subject to the realisation of your payment.";
                                
								$this->data['donation_details'] = $this->product_model->get_donation_detail(); 
								
                                $this->load->shop_template('donation_success', $this->session->userdata['current_template'], $this->data, $return = FALSE);
					
					
					}// else end not paypal error
                } // if post credit cared end	 
				  
			}
		}
		else {	
		$this->data['user_data'] = $this->product_model->get_userinfo();
	    $this->data['profile'] = $this->profile;
        $this->data['countries'] = $this->product_model->get_country_list();
		$this->data['country'] = $this->product_model->get_country($this->data['user_data'][0]->country);
	    $this->load->shop_template('donation', $this->session->userdata['current_template'], $this->data, $return = FALSE);
	   }
	}
	
	
	
	
	
	
	public function donation_success() {
	
        $this->order_details['message'] = "Thank you. Your paymeny is successful please quote your reciept for any queries relating to this transaction in future. Please note that this reciept is valid subject to the realisation of your payment.";
      
	    //to get transaction id 

        $this->session->set_userdata('token', $_REQUEST['token']);

        $PayPalResult = $this->paypal_pro->GetExpressCheckoutDetails($this->session->userdata('token'));

        $DECPFields = array(
            'token' => $PayPalResult['TOKEN'],
            'payerid' => $PayPalResult['PAYERID'],
        );

        $Payments = array();
        $Payment = array(
            'amt' => $PayPalResult['AMT'],
        );
        array_push($Payments, $Payment);

        $PayPalRequestData = array(
            'DECPFields' => $DECPFields,
            'Payments' => $Payments,
        );

        $PayResult = $this->paypal_pro->DoExpressCheckoutPayment($PayPalRequestData);
	    
		/* SAVE PAYPAL DATA*/
		$this->datas['paypal_txn_id'] = $PayResult['PAYMENTS'][0]['TRANSACTIONID'];
		$this->datas['payer_id']      = $PayResult['REQUESTDATA']['PAYERID'];
		$this->datas['status']        = '1'; 
		$tbl_name                     = "message_donation";
		if($this->session->userdata('donate_id') == "" )
		{
		  redirect('checkout/donation');
		}
		$update= $this->product_model->update_donation_status($tbl_name, $this->datas);
		
		$this->confirmation_mail($PayResult['PAYMENTS'][0]['TRANSACTIONID']);
		$this->data['message'] = "Thank you. Your paymeny is successful please quote your reciept for any queries relating to this transaction in future. Please note that this reciept is valid subject to the realisation of your payment.";
		$this->data['donation_details'] = $this->product_model->get_donation_detail(); 
        $this->load->shop_template('donation_success', $this->session->userdata['current_template'], $this->data, $return = FALSE);
    }
	
	

}

/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */
