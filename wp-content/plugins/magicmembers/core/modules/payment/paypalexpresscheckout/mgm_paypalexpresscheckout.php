<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');
// -----------------------------------------------------------------------

/**
 * Paypal Express Checkout Payment Module, integrates express checkout method 
 * using API Version 108, 
 * @see https://developer.paypal.com/webapps/developer/docs/classic/release-notes/#MerchantAPI
 * 
 * @author     MagicMembers
 * @copyright  Copyright (c) 2011, MagicMembers 
 * @package    MagicMembers plugin
 * @subpackage Payment Module
 * @category   Module 
 * @version    3.0
 */
class mgm_paypalexpresscheckout extends mgm_payment{	
	// construct
	function __construct(){
		// php4 construct
		$this->mgm_paypalexpresscheckout();
	}
	
	// php4 construct
	function mgm_paypalexpresscheckout(){
		// parent
		parent::__construct();
		// set code
		$this->code = __CLASS__; 
		// set module
		$this->module = str_replace('mgm_', '', $this->code);
		// set name
		$this->name = 'Paypal Express Checkout';	
		// logo
		$this->logo = $this->module_url( 'assets/paypal_express_checkout.jpg' );
		// description
		$this->description = __('Recurring payments and Single Purchase.', 'mgm');
		// supported buttons types
	 	$this->supported_buttons = array('subscription', 'buypost');
		// trial support available ?
		$this->supports_trial= 'Y';		
		// cancellation support available ?
		$this->supports_cancellation= 'Y';		
		// do we depend on product mapping	
		$this->requires_product_mapping = 'N';
		// type of integration
		$this->hosted_payment = 'Y';// html redirect
		// if supports rebill status check	
		$this->supports_rebill_status_check = 'Y';
		// rebill status check delay
		$this->rebill_status_check_delay = true;		
		// endpoints
		$this->_setup_endpoints();		
		// button message
		$this->button_message = 'button message';
		// default settings
		$this->_default_setting();
		// set path
		parent::set_tmpl_path();
		// read settings
		$this->read();	
	}
	
	// MODULE API COMMON HOOKABLE CALLBACKS  //////////////////////////////////////////////////////////////////
	
	// settings
	function settings(){
		global $wpdb;
		// data
		$data = array();		
		// set 
		$data['module'] = $this;
		// load template view
		$this->loader->template('settings', array('data'=>$data));
	}
	
	// settings box api hook
	function settings_box(){
		global $wpdb;
		// data
		$data = array();	
		// set 
		$data['module'] = $this;	
		// load template view
		return $this->loader->template('settings_box', array('data'=>$data), true);		
	}
	
	function settings_update(){
		// form type 
		switch($_POST['setting_form']){
			case 'box':
			// from box			
				switch($_POST['act']){
					case 'logo_update':
						// logo if uploaded
						if(isset($_POST['logo_new_'.$this->code]) && !empty($_POST['logo_new_'.$this->code])){
							$this->logo = $_POST['logo_new_'.$this->code];
							// update
							$this->save();
						}
						// message
						$message = sprintf(__('%s logo updated', 'mgm'), $this->name);			
						$extra   = array();
					break;
					case 'status_update':
					default:
						// enable
						$enable_state = (isset($_POST['payment']) && $_POST['payment']['enable'] == 'Y') ? 'Y' : 'N';
						// enable
						if( bool_from_yn($enable_state) ){
							$this->install();
							$stat = ' enabled.';
						}else{
						// disable
							$this->uninstall();	
							$stat = ' disabled.';
						}							
						// message
						$message = sprintf(__('%s module has been %s', 'mgm'), $this->name, $stat);							
						$extra   = array('enable' => $enable_state);	
					break;
				}							
				// print message
				echo json_encode(array_merge(array('status'=>'success','message'=>$message,'module'=>array('name'=>$this->name,'code'=>$this->code,'tab'=>$this->settings_tab)), $extra));
			break;
			case 'main':
			default:
			// from main				
				// paypalexpress specific
				$this->setting['username']  = $_POST['setting']['username'];
				$this->setting['password']  = $_POST['setting']['password'];
				$this->setting['signature'] = $_POST['setting']['signature'];	
				$this->setting['currency']  = $_POST['setting']['currency'];								
				$this->setting['locale']    = $_POST['setting']['locale'];
				//issue #974
				$this->setting['max_failed_payments']    = $_POST['setting']['max_failed_payments'];
				//issue #2080
				$this->setting['max_retry_num_days']    = $_POST['setting']['max_retry_num_days'];				
				// purchase price
				if(isset($_POST['setting']['purchase_price'])){
					$this->setting['purchase_price']  = $_POST['setting']['purchase_price'];
				}
				// common
				$this->description = $_POST['description'];
				$this->status      = $_POST['status'];
				//$this->rebill_status_check_delay      = $_POST['rebill_status_check_delay'];
				//check
				if($this->rebill_status_check_delay){
					$this->setting['rebill_check_delay'] = $_POST['rebill_check_delay'];	
				}				
				// logo if uploaded
				if(isset($_POST['logo_new_'.$this->code]) && !empty($_POST['logo_new_'.$this->code])){
					$this->logo = $_POST['logo_new_'.$this->code];
				}
				$this->setting['landingpage']    = $_POST['setting']['landingpage'];				
				// fix old data
				$this->hosted_payment = 'N';
				// setup callback messages				
				$this->_setup_callback_messages($_POST['setting']);
				// re setup callback urls
				$this->_setup_callback_urls($_POST['setting']);
				// re setup endpoints
				$this->_setup_endpoints();				
				// update
				$this->save();
				
				mgm_log($this->rebill_status_check_delay,$this->get_context( 'debug', __FUNCTION__ ));
				// message
				echo json_encode(array('status'=>'success','message'=> sprintf(__('%s settings updated','mgm'), $this->name)));
			break;
		}		
	}
	/**
	 * process request when returns from PAYPAL
	 *
	 */
	function process_return() {
		if(!isset($this->response)) $this->response = array();
		
		if(isset($_GET['token']) && !empty($_GET['token'])) {
			$this->response = array();
			$end_point =  $this->_get_endpoint();
			$secure =array(
				'USER'         => $this->setting['username'],	
				'PWD'          => $this->setting['password'],		
				'SIGNATURE'    => $this->setting['signature'],
				'VERSION'      => '65.1',
				);
			//REQUEST AND SHOW PAYMENT DETAILS:
			if(!isset($_POST['confirm_payment'])) { 	
				// security	
				$post_data = array_merge($secure, array('TOKEN' => strip_tags($_GET['token']),'METHOD' => 'GetExpressCheckoutDetails'));
				
				//issue #1508
				$url_parsed = parse_url($end_point);  			
				// domain/host
				$domain = $url_parsed['host'];
				// headers
				$http_headers = array ('POST /cgi-bin/webscr HTTP/1.1\r\n',
									'Content-Type: application/x-www-form-urlencoded\r\n',
									'Host: '.$domain.'\r\n',
									'Connection: close\r\n\r\n');			
				// post				
				//$http_response = mgm_remote_post($end_point, $post_data, array('headers'=>$http_headers,'timeout'=>30,'sslverify'=>false));
				// log
				// mgm_log($http_response, $this->get_context( __FUNCTION__ ) );				
				
				// fields
				$fields = mgm_http_build_query($post_data);
				// log
				mgm_log($fields, $this->get_context( 'debug', __FUNCTION__ ));
				// post					
				$http_response = $this->_pp_http_post($end_point, $fields);
				// log
				mgm_log($http_response, $this->get_context( 'debug', __FUNCTION__ ));				
				
				// reset
				$this->response = array();
				// parse to array
				parse_str($http_response, $this->response);
				// log
				// mgm_log($this->response, $this->get_context( __FUNCTION__ ) );
				// $fields = mgm_http_build_query($data);		
				// post					
				// $this->_curl_post($end_point, $fields);
				//remove:								
				if(isset($this->response['ACK']) && strtoupper($this->response['ACK']) == 'SUCCESS') {
					if($this->response['TOKEN'] == $_GET['token']) { //verified:
						//$this->response['INVNUM']: mgm transaction id;						
						//SHOW PAYMENT DETAILS:												
						$html ='<form action="" method="post" class="mgm_form" name="' . $this->code . '_payment_return_form" id="' . $this->code . '_payment_return_form">
						   		<input type="hidden" name="custom" value="'.$this->response['INVNUM'].'">
						   		<input type="hidden" name="payer_id" value="'.$this->response['PAYERID'].'">
						   		<input type="hidden" name="token" value="'.$this->response['TOKEN'].'">
						   		<input type="hidden" name="confirm_payment" value="1">';
						//show response fields:						   						   						  
						$html .= $this->_get_payment_fields($this->response);					
					  	$html .= '</form>';
					  	
						// return	   
						echo $html;	
					}else {
						//treat as error:
						$errors =  __('Invalid Token', 'mgm');
					}
				}else {
					//treat as error:
					$errors =  __('Unable to find transaction details', 'mgm');					
				}	
			}elseif(!empty($_POST['confirm_payment']) && is_numeric($_POST['custom'])) {
				//PROCESS PAYMENT:
				
				//$_POST['custom']: mgm transaction id
				$transdata = $this->_get_transaction_passthrough($_POST['custom']);	
				$pack_id = (isset($transdata['pack_id'])) ? $transdata['pack_id'] : 0;
				$pack = mgm_get_class('subscription_packs')->get_pack($pack_id);
				$bp_types = array('d'=>'Day', 'w'=>'Week', 'm'=>'Month', 'y'=>'Year');
				$system_obj = mgm_get_class('system');	
				$is_onetime = true;

				// user
				if( isset($transdata['user_id']) && (int)$transdata['user_id']>0){
					$user = get_userdata($transdata['user_id']);
				}				

				$data = array();
				$data['TOKEN'] 	= urlencode($_POST['token']);					
				$data['IPADDRESS'] = mgm_get_client_ip_address();
				$data['PAYMENTREQUEST_0_INVNUM'] = $_POST['custom'];//transaction ref id	

				//issue #974
				if(is_numeric($this->setting['max_failed_payments'])){
					$max_failed_payments = round($this->setting['max_failed_payments']);
				}else {
					$max_failed_payments = 3;
				}
				//issue #2080
				if(is_numeric($this->setting['max_retry_num_days'])){
					$max_retry_num_days = round($this->setting['max_retry_num_days']);
				}else {
					$max_retry_num_days = 2;
				}				
				//mgm_log('max_failed_payments '.$max_failed_payments);
				
				//pack currency over rides genral setting currency - issue #1602
				if(!isset($pack['currency']) || empty($pack['currency'])){
					$pack['currency']=$this->setting['currency'];
				}				
											
				//recurring:
				if($transdata['payment_type'] == 'subscription_purchase' && isset($transdata['num_cycles']) && $transdata['num_cycles'] != 1) {																	
					$data['METHOD'] 			= 'CreateRecurringPaymentsProfile';
					$data['PAYMENTACTION'] 		= 'Sale';					
					$data['PROFILEREFERENCE'] 	= $_POST['custom'];					
					$data['PROFILESTARTDATE'] 	= date(DATE_ATOM);// Mon, 15 Aug 2005 15:12:46 UTC
					$data['DESC'] 				= (isset($transdata['item_name']) ? $transdata['item_name'] : $system_obj->get_subscription_name($transdata));		
					$data['CURRENCYCODE'] 		= $pack['currency'];
					$data['AMT'] 		  		= $transdata['cost'];					
					$data['BILLINGPERIOD'] 		= $bp_types[ $transdata['duration_type'] ];
					$data['BILLINGFREQUENCY'] 	= $transdata['duration'];
					$data['TOTALBILLINGCYCLES'] = $transdata['num_cycles'];
					if($transdata['trial_on']) {
						$data['TRIALBILLINGPERIOD'] 	= $bp_types[ $transdata['trial_duration_type'] ];
						$data['TRIALBILLINGFREQUENCY'] 	= $transdata['trial_duration'];
						$data['TRIALAMT'] 				= $transdata['trial_cost'];
						$data['TRIALTOTALBILLINGCYCLES']= $transdata['trial_num_cycles'];
					}
					$data['NOTIFYURL'] = $this->setting['notify_url'];
					$data['PAYMENTREQUEST_0_NOTIFYURL'] = $this->setting['notify_url'];
					//issue #974
					$data['MAXFAILEDPAYMENTS']  = $max_failed_payments;
					//issue #2080
					$data['RETRYNUMDAYS'] 		= $max_retry_num_days;
					
					$data['INVNUM'] = $_POST['custom'];		
						
					//address fields:	
					if( isset($user) ){
						$data['SUBSCRIBERNAME'] = $user->display_name;
						$data['EMAIL'] = $user->email;
						$this->_set_address_fields($user, $data);
					}							
					// set
					$is_onetime = false;
				//one-time payment/post purchase						
				}else {											
					$data['METHOD'] = 'DoExpressCheckoutPayment';
					$data['PAYERID'] = $_POST['payer_id'];
					$data['PAYMENTREQUEST_0_CURRENCYCODE'] 	= $pack['currency'];
					$data['PAYMENTREQUEST_0_AMT'] 		  	= $transdata['cost'];	
					$data['PAYMENTREQUEST_0_DESC'] 		  	= (isset($transdata['item_name']) ? $transdata['item_name'] : $system_obj->get_subscription_name($transdata));	
					$data['PAYMENTREQUEST_0_NOTIFYURL']  	= $this->setting['notify_url'];
					$data['PAYMENTREQUEST_0_INVNUM'] 		= $_POST['custom'];//transaction ref id	
					$data['PAYMENTREQUEST_0_CUSTOM'] 		= $_POST['custom'];//transaction ref id	
					$data['PAYMENTRREQUEST_0_PAYMENTACTION']= 'Sale';//transaction ref id	
				}
				
				//attach api credentials
				$post_data = array_merge($secure, $data);
				
				//issue #1508
				$url_parsed = parse_url($end_point);  			
				// domain/host
				$domain = $url_parsed['host'];
				// headers
				$http_headers = array ('POST /cgi-bin/webscr HTTP/1.1\r\n',
									'Content-Type: application/x-www-form-urlencoded\r\n',
									'Host: '.$domain.'\r\n',
									'Connection: close\r\n\r\n');
									
				//mgm_log($post_data, $this->get_context( __FUNCTION__ ) );								
				// post				
				//$http_response = mgm_remote_post($end_point, $post_data, array('headers'=>$http_headers,'timeout'=>30,'sslverify'=>false));
				// log
				// mgm_log($http_response, $this->get_context( __FUNCTION__ ) );
				
				// fields
				$fields = mgm_http_build_query($post_data);
				// log
				mgm_log($fields, $this->get_context( 'debug', __FUNCTION__ ));
				// post					
				$http_response = $this->_pp_http_post($end_point, $fields);
				// log
				mgm_log($http_response, $this->get_context( 'debug', __FUNCTION__ ));					
				
				// reset
				$this->response = array();	
				// parse to array
				parse_str($http_response, $this->response);
				// log
				//mgm_log($this->response, $this->get_context( __FUNCTION__ ) );
				// $fields = mgm_http_build_query($data);
				// reset response
				// $this->response = array();
				// make request:
				// $this->_curl_post($end_point, $fields);
				// check
				if(isset($this->response['ACK']) && strtoupper($this->response['ACK']) == 'SUCCESS') {					
					// process 
					$this->process_notify(true);
					// query arg
					$query_arg = array('status'=>'success', 'trans_ref' => mgm_encode_id($_POST['custom']));
					// is a post redirect?
					$post_redirect = $this->_get_post_redirect($_POST['custom']);
					// set post redirect
					if($post_redirect !==false){
						$query_arg['post_redirect'] = $post_redirect;
					}			
					// is a register redirect?
					$register_redirect = $this->_auto_login($_POST['custom']);
					// set register redirect
					if($register_redirect !== false){
						$query_arg['register_redirect'] = $register_redirect;
					}
					// redirect
					mgm_redirect(add_query_arg($query_arg, $this->_get_thankyou_url()));			
				}else{
					// teat as error			
					$errors = urlencode($this->response['L_ERRORCODE0'] . ': ' . $this->response['L_SHORTMESSAGE0'] . ' - ' . $this->response['L_LONGMESSAGE0']); 						
				}
			}
		}else {
			$errors =  __('Invalid Token', 'mgm');
		}
		
		// redirect	if error occured:
		if(isset($errors))		
			mgm_redirect(add_query_arg(array('status'=>'error','errors'=>$errors), $this->_get_thankyou_url()));
	}

	/**
	 * UPDATE member/POST details
	 * WORKS for IPN as well
	 *
	 */
	function process_notify($internal = false) {
		//record POST/GET data
		do_action('mgm_print_module_data', $this->module, __FUNCTION__ );
		if(!isset($this->response)) $this->response = array();		
		//this is to confirm module for IPN POST
		if(!$this->_confirm_notify())
			return;
					
		if(!empty($_POST['rp_invoice_id']) )
			$_POST['custom'] = $_POST['rp_invoice_id'];	
		// check					
		if ($this->_verify_callback()) {						
			// log data before validate
			$tran_id = $this->_log_transaction();
			// payment type
			$payment_type = $this->_get_payment_type($_POST['custom']);
			// custom
			$custom = $this->_get_transaction_passthrough($_POST['custom']);
			// hook for capture
			do_action('mgm_notify_pre_process_'.$this->module, array('tran_id'=>$tran_id,'custom'=>$custom));
			// check			
			switch($payment_type){
				// buypost 
				case 'post_purchase':
				case 'buypost':
					$this->_buy_post(); //run the code to process a purchased post/page
				break;
				// subscription	
				case 'subscription':
					// update payment check
					if( isset($custom['user_id']) ): mgm_update_payment_check_state($custom['user_id'], 'notify'); endif;
					// cancellation
					if(isset($_POST['txn_type']) && in_array($_POST['txn_type'], array('subscr_cancel', 'recurring_payment_profile_cancel','recurring_payment_suspended'))) {	// check this:											
						$this->_cancel_membership($tran_id); //run the code to process a membership cancellation
					}else{						
						$this->_buy_membership($internal); //run the code to process a new/extended membership
					}	
				break;	
				// other		
				default:																
					// error
					// $error = 'error in payment type : '.$payment_type;
					// redirect to error
					// mgm_redirect(add_query_arg(array('status'=>'error','errors'=>$error), $this->_get_thankyou_url()));					
				break;							
			}			
			// after process		
			do_action('mgm_notify_post_process_'.$this->module, array('tran_id'=>$tran_id,'custom'=>$custom));	
		}else {
		// log	
			mgm_log('PAYPALEXPRESS process_notify verify failed');
		}
		// after process unverified		
		do_action('mgm_notify_post_process_unverified_'.$this->module);	
	}

	/**
	 * cancel
	 *
	 */
	function process_cancel(){
		// redirect to cancel page
		mgm_redirect(add_query_arg(array('status'=>'cancel'), $this->_get_thankyou_url()));
	}
	/**
	 * unsubscribe from PAYPAL/MGM
	 *
	 */
	function process_unsubscribe(){
		// get user id
		$user_id = $_POST['user_id'];
		//issue #1521
		$is_admin = (is_super_admin()) ? true : false;		
		// get user
		$user = get_userdata($user_id); 
		// multiple membership level update:
		$member = mgm_get_member($user_id);
		// check multiple membership
		if(isset($_POST['membership_type']) && $member->membership_type != $_POST['membership_type'])
			$member = mgm_get_member_another_purchase($user_id, $_POST['membership_type']);	
					
		// init
		$cancel_account = true;		
		// check
		if(isset($member->payment_info->module) && $member->payment_info->module == $this->code) {// self check
			//echo 'IN';	
			$subscr_id = null;				
			if(!empty($member->payment_info->subscr_id))
				$subscr_id = $member->payment_info->subscr_id;
			elseif (!empty($member->pack_id)) {	
				//check the pack is recurring
				$s_packs = mgm_get_class('subscription_packs');				
				$sel_pack = $s_packs->get_pack($member->pack_id);										
				if($sel_pack['num_cycles'] != 1) 
					$subscr_id = 0;// 0 stands for a lost subscription id
			}
			
			// cancel at paypal
			$cancel_account = $this->cancel_recurring_subscription(null, $user_id, $subscr_id);
		}	

		// cancel in MGM
		if($cancel_account === true) {
			$this->_cancel_membership($member->transaction_id, true); // redirected
		}

		// message
		$message = $this->response['L_SHORTMESSAGE0'].': '.$data['L_LONGMESSAGE0'];					
		// issue #1521
		if( $is_admin ){
			mgm_redirect( add_query_arg(array('user_id'=>$user_id,'unsubscribe_errors'=>urlencode($message)), admin_url('user-edit.php')) );
		}
		// redirect to custom url:
		mgm_redirect(mgm_get_custom_url('membership_details', false,array('unsubscribe_errors'=>urlencode($message))));		
	}
	
	/**
	 * Create  a request and redirect to PAYPAL
	 *
	 * @return unknown
	 */
	function process_html_redirect(){
		// read tran id
		if(!$tran_id = $this->_read_transaction_id()){		
			return __('Transaction Id invalid','mgm');
		}
		
		// get trans		
		if(!$tran = mgm_get_transaction($tran_id)){		
			return __('Transaction invalid','mgm');
		}	
					
		// update pack/transaction
		mgm_update_transaction(array('module'=>$this->module), $tran_id);
		// Check user id is set if subscription_purchase. issue #1049
		//issue #1080 - corrected $tran['data']['user_id'] to $tran['user_id']
		if ($tran['payment_type'] == 'subscription_purchase' && 
			(!isset($tran['data']['user_id']) || (isset($tran['data']['user_id']) && (int) $tran['data']['user_id']  < 1))) {
			return __('Transaction invalid . User id field is empty','mgm');		
		}
		// generate
		$post_data = $this->_get_button_code($tran['data'], $tran_id);
		// log
		mgm_log($post_data, $this->get_context( 'debug', __FUNCTION__ ));
		// end point		
		$end_point =  $this->_get_endpoint();
		
		//issue #1508
		$url_parsed = parse_url($end_point);  			
		// domain/host
		$domain = $url_parsed['host'];
		// headers
		$http_headers = array ('POST /cgi-bin/webscr HTTP/1.1\r\n',
							'Content-Type: application/x-www-form-urlencoded\r\n',
							'Host: '.$domain.'\r\n',
							'Connection: close\r\n\r\n');		
		// post				
		//$http_response = mgm_remote_post($end_point, $post_data, array('headers'=>$http_headers,'timeout'=>30,'sslverify'=>false));
		// log
		//mgm_log($http_response, $this->get_context( __FUNCTION__ ) );		
		
		// post					
		$http_response = $this->_pp_http_post($end_point, $post_data);
		// log
		mgm_log($http_response,$this->get_context( 'debug', __FUNCTION__ ));			
		// reset
		$this->response = array();	
		// parse to array
		parse_str($http_response, $this->response);
		// log
		mgm_log($this->response, $this->get_context( 'debug', __FUNCTION__ ));
		// match			
		if(isset($this->response['ACK']) && strtoupper($this->response['ACK']) == 'SUCCESS') {
			// redirect to paypal site for authorization:						
			$authorize_url =  str_replace('[TOKEN_STRING]', $this->response['TOKEN'], $this->_get_endpoint($this->status.'_authorize'));
			// redirect
			mgm_redirect($authorize_url);				
		}else {
			// check response
			if(!empty($this->response)) {
				$errors = sprintf('[code - %s]: %s - %s', $this->response['L_ERRORCODE0'], $this->response['L_SHORTMESSAGE0'],$this->response['L_LONGMESSAGE0'] ); 
			}else {
				$errors = __('An error occured while processing the transaction.', 'mgm');
			}
			// redirect
			mgm_redirect(add_query_arg(array('status'=>'error','errors'=>urlencode($errors)), $this->_get_thankyou_url()));			
		}
				
		// return 	  
		return __('Transaction could not be processed','mgm');
	}
	
	/**
	 * confirm/pay 
	 *
	 * @param unknown_type $data
	 * @param unknown_type $html_type
	 * @return unknown
	 */
	function _get_payment_fields($data, $html_type='div') {					
		$cancel_url =  $this->setting['cancel_url'];
		//description
		$desc = (isset($data['DESC'])) ? $data['DESC'] : $data['PAYMENTREQUEST_0_DESC'];		
		// type
		switch($html_type){
			case 'table':
				$html= "<table border='0' cellpadding='1' cellspacing='0' width='100%'>
							<tr>
								<td valign='top'>
									<label>".__('PAYPAL Email', 'mgm')."</label>
								</td>
								<td valign='top'>
									".$data['EMAIL']."
								</td>
							</tr>
							<tr>
								<td valign='top'>
									<label>".__('Purchase Description','mgm')."</label>
								</td>
								<td valign='top'>	
									".$desc."
								</td>
							</tr>			
							<tr>
								<td valign='top'>
									<label>".__('Amount','mgm')."</label>
								</td>							
								<td valign='top'>	
									".$data['CURRENCYCODE'] ." ".$data['AMT']."
								</td>
							</tr>						
							<tr>
								<td></td>
								<td valign='top'>	
									<input type='submit' class='button' value='".__('Confirm Payment', 'mgm')."'>
									<input type='button' class='button' value='".__('Cancel', 'mgm')."' onClick='window.location.href=\"".$cancel_url."\"'>
								</td>
							</tr>
						</table>";
			break;
			case 'div':
			default:
				$html= "<p>
							<label>".__('PAYPAL Email', 'mgm')."</label><br />
							".$data['EMAIL']."
						</p>
						<p>
							<label>".__('Purchase Description','mgm')."</label><br />
							".$desc."
						</p>	
						<p>
							<label>".__('Amount','mgm')."</label><br />
							".$data['CURRENCYCODE'] ." ".$data['AMT']."
						</p>								
						<p>
							<input type='submit' class='button' value='".__('Confirm Payment', 'mgm')."'>
							<input type='button' class='button' value='".__('Cancel', 'mgm')."' onClick='window.location.href=\"".$cancel_url."\"'>
						</p>";
			break;
		}
		// cc form
		$payment_form = "<div id='" . $this->code . "_form_cc' class='ccfields ccfields_block_left'>{$html}</div>";
		// filter
		$payment_form = apply_filters('mgm_cc_form_html', $payment_form, $this->code);
		// return
		return $payment_form;		
	}
	/**
	 * subscribe form
	 *
	 * @param unknown_type $options
	 * @return unknown
	 */
	function get_button_subscribe($options=array()){		
		$include_permalink = (isset($options['widget'])) ? false : true;
		//echo $this->_get_endpoint('html_redirect',$include_permalink);
		// get html
		$html='<form action="'. $this->_get_endpoint('html_redirect',$include_permalink) .'" method="post" class="mgm_form" name="' . $this->code . '_form" id="' . $this->code . '_form">
				   <input type="hidden" name="tran_id" value="'.$options['tran_id'].'">
				   <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
				   <input class="mgm_paymod_logo" type="image" src="' . mgm_site_url($this->logo) . '" border="0" name="submit" alt="' . $this->button_message . '">
				   <div class="mgm_paymod_description">'. mgm_stripslashes_deep($this->description) .'</div>
			   </form>';
		// return	   
		return $html;
	}
	/**
	 * Buy post form
	 *
	 * @param unknown_type $options
	 * @param unknown_type $return
	 * @return unknown
	 */
	function get_button_buypost($options=array(), $return = false) {
		// get html
		$html = '<form action="'. $this->_get_endpoint('html_redirect') .'" method="post" class="mgm_form" name="' . $this->code . '_form" id="' . $this->code . '_form">
					<input type="hidden" name="tran_id" value="'.$options['tran_id'].'">
					<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
					<input class="mgm_paymod_logo" type="image" src="' . mgm_site_url($this->logo) . '" border="0" name="submit" alt="' . $this->button_message . '">
					<div class="mgm_paymod_description">'. mgm_stripslashes_deep($this->description) .'</div>
			    </form>';				
		// return or print
		if ($return) {
			return $html;
		} else {
			echo $html;
		}
	}
	/**
	 * Unsubscribe form
	 *
	 * @param unknown_type $options
	 * @return unknown
	 */
	function get_button_unsubscribe($options=array()){		
		// action 
		$action = add_query_arg(array('module'=>$this->code,'method'=>'payment_unsubscribe'), mgm_home_url('payments'));
		// message
		$message = sprintf(__('You have subscribed to <span>%s</span> via <span>%s</span>, if you wish to unsubscribe, please click the following link. <br>','mgm'), get_option('blogname'), $this->name);		
		// html
		$html='<div class="mgm_unsubscribe_btn_wrap">
					<span class="mgm_unsubscribe_btn_head">'.__('Unsubscribe','mgm').'</span>
					<div class="mgm_unsubscribe_btn_desc">' . $message . '</div>
			   </div>
			   <form name="mgm_unsubscribe_form" id="mgm_unsubscribe_form" method="post" action="' . $action . '">
					<input type="hidden" name="user_id" value="' . $options['user_id'] . '"/>
					<input type="hidden" name="membership_type" value="' . $options['membership_type'] . '"/>
					<input type="button" name="btn_unsubscribe" value="' . __('Unsubscribe','mgm') . '" onclick="confirm_unsubscribe(this)" class="button" />
			   </form>';	
		// return
		return $html;
	}
	
	// get module transaction info
	function get_transaction_info($member, $date_format){	
		// data
		$subscription_id = $member->payment_info->subscr_id;
		$transaction_id  = $member->payment_info->txn_id;	

		// info
		$info = sprintf('<b>%s:</b><br>%s: %s<br>%s: %s', __('PAYPALEXPRESSCHECKOUT INFO','mgm'), __('SUBSCRIPTION ID','mgm'), $subscription_id, 
						__('TRANSACTION ID','mgm'), $transaction_id);		

		// set
		$transaction_info = sprintf('<div class="overline">%s</div>', $info);
		// return 
		return $transaction_info;
	}
	
	/**
	 * Button code wrapper
	 *
	 * @param unknown_type $pack
	 * @param unknown_type $tran_id
	 * @return unknown
	 */
	function _get_button_code($pack, $tran_id=NULL) {	
		// get data
		$data = $this->_get_button_data($pack, $tran_id);
				
		// strip 
		$data = mgm_stripslashes_deep($data);

		// log
		// mgm_log($data, $this->get_context( __FUNCTION__ ) );	

		// return
		return mgm_http_build_query($data);	
	}
	
	/**
	 * set request params
	 *  
	 *
	 * @param array $pack
	 * @param int $tran_id
	 * @return array
	 */
	function _get_button_data($pack, $tran_id=NULL) {
		// system setting
		$system_obj = mgm_get_class('system');	
		// user data
		if( isset($pack['user_id']) && (int)$pack['user_id'] > 0 ){			
			$user_id = $pack['user_id'];
			$user = get_userdata($user_id); 
			$user_email = $user->user_email;
		}		
		
		// secure
		$secure = array(
					'USER'      => $this->setting['username'],	
					'PWD'       => $this->setting['password'],		
					'SIGNATURE' => $this->setting['signature'],
					'VERSION'   => '108.0', //'65.1', @see #top
				 );
		
		// cost
		$cost = $pack['cost'];
		
		// item 		
		$item = $this->get_pack_item($pack);
		
		//pack currency over rides genral setting currency - issue #1602
		if(!isset($pack['currency']) || empty($pack['currency'])){
			$pack['currency']=$this->setting['currency'];
		}
		
		// init		
		$data = array(				
				'METHOD'                     => 'SetExpressCheckout',	
				'PAYMENTREQUEST_0_DESC'      => substr($item['description'], 0, 127),
				'PAYMENTREQUEST_0_AMT'       => $cost,				
				'PAYMENTREQUEST_0_CURRENCYCODE' => $pack['currency'],					
				'PAYMENTREQUEST_0_PAYMENTACTION' =>'Authorize',//Authorize
				'NOSHIPPING'                 => '1',				
				'INVNUM'                     => $tran_id,//this is for reference
				'PAYMENTREQUEST_0_CUSTOM'    => $tran_id,
				'PAYMENTREQUEST_0_INVNUM'    => $tran_id,
				'ALLOWNOTE'                  => 0,
				'ADDROVERRIDE'               => 0,
				'LOCALECODE'                 => $this->setting['locale'],
				'SOLUTIONTYPE'               => 'Sole',
				'RETURNURL'                  => $this->_get_endpoint('return'),		
				'CANCELURL'                  => $this->setting['cancel_url'],		
				'PAYMENTREQUEST_0_NOTIFYURL' => $this->setting['notify_url']
				//'L_PAYMENTTYPE0'             => 'Authorize',		
				//'L_CUSTOM0'                  => $tran_id,
				//'PAYMENTACTION'              =>'Authorize',//check authorize as well
				//'PAYMENTREQUEST_0_ITEMAMT'   => $cost,
				//'ITEMAMT'                  => $cost,
				//'CURRENCYCODE'               => $this->setting['currency'],	
				//'L_NAME0'                  => $item['name'],
				//'L_DESC0'                  => substr($item['description'], 0, 125),
				//'L_AMT0'                   => $cost,
				//'L_QTY0'                   => '1',
				//'AMT'                      => $cost, // as per july 17, 2013 NV API Doc, page 63
			    //'L_PAYMENTREQUEST_0_DESC0'   => $item['name'],
				//'CALLBACK'                   => $this->setting['notify_url'],	
				//'CALLBACKVERSION'            => '61.0',	
				//'BRANDNAME'                  => bloginfo( 'sitename' ),													
			);
			
		//issue #2252
		if($this->setting['landingpage'] =='creditcard') {
			$data['LANDINGPAGE'] = 'Billing';
		}		
		// email
		if( isset($user) ){
			// email
			if( isset($user_email) && ! empty($user_email) ){
				$data['EMAIL'] = $user_email;
			}
			// set other address
			// $this->_set_address_fields($user, $data);	
		}

		// current date, takes 24 hours to activate	
		$data['PROFILESTARTDATE'] = date('c');		
				
		// subscription purchase with ongoing/limited
		if( ! isset($pack['buypost']) && isset($pack['duration_type']) && $pack['num_cycles'] != 1){ // does not support one-time recurring	
			$data['L_BILLINGTYPE0'] = 'RecurringPayments';		
			$data['L_BILLINGAGREEMENTDESCRIPTION0'] = $item['name'];	
			// required in recurrinhg for regular payment
			$data['MAXAMT'] = $cost;// recurring payments only
			// trial
			if ( $pack['trial_on'] ) {	
				// exprs
				$duration_exprs = mgm_get_class('subscription_packs')->get_duration_exprs();//array('d'=>'DAY','w' => 'WEEK', 'm'=>'MONTH', 'y'=>'YEAR' );
				$start_date = date('c', strtotime('+' . (1 * (int)$pack['trial_duration']) . ' ' . $duration_exprs[$pack['trial_duration_type']]));		
				// shift start data
				$data['PROFILESTARTDATE']        = $start_date;
				// $data['PROFILESTARTDATE']     = date('c', (time() + $pack['trial_duration'] * 24 * 3600));
				// set trial data
				$data['TRIALBILLINGPERIOD']      = strtoupper($pack['trial_duration_type']); // D/M/Y
				$data['TRIALBILLINGFREQUENCY']   = $pack['trial_duration'];
				$data['TRIALAMT']                = $pack['trial_cost'];
				$data['TRIALTOTALBILLINGCYCLES'] = (int)$pack['trial_num_cycles'];
				// cost 
				//if trail cost > pack cost not taking trail cost its taking pack cost so commented  condition
				//if( $pack['trial_cost'] <  $data['PAYMENTREQUEST_0_AMT'] ) 
				if(isset($pack['trial_cost'])){
					$data['PAYMENTREQUEST_0_AMT'] = $pack['trial_cost'];// as per july 17, 2013 NV API Doc, page 71
				}				
			}	
		}
		
		// add filter @todo test
		$data = apply_filters('mgm_payment_button_data', $data, $tran_id, $this->module, $pack);
		
		// update pack/transaction
		mgm_update_transaction(array('data'=>json_encode($pack),'module'=>$this->module), $tran_id);
		
		// merge
		$data = array_merge($data, $secure);	

		// return 
		return $data;				
	}
	
	/**
	 * Update buy post response
	 *
	 */
	function _buy_post() {
		global $wpdb;
		
		//skip updates from IPN: {PPP will be an immediate update} 
		if(isset($_POST['ipn_track_id'])) {
			exit;
		}
		// system
		$system_obj = mgm_get_class('system');
		$dge = bool_from_yn($system_obj->get_setting('disable_gateway_emails'));
		$dpne = bool_from_yn($system_obj->get_setting('disable_payment_notify_emails'));

		// get passthrough, stop further process if fails to parse
		$custom = $this->_get_transaction_passthrough($_POST['custom']);
		// local var
		extract($custom);
			
		// set user
		$user = null;
		// check
		if(isset($user_id) && (int)$user_id > 0) $user = get_userdata($user_id);	
		
		$blogname = get_option('blogname');
		$tran_success = false;
		
		//getting purchase post title and & price - issue #981				
		$post_obj = mgm_get_post($post_id);
		$purchase_cost     = mgm_convert_to_currency($post_obj->purchase_cost);
		$post    = get_post($post_id);
		$post_title   = $post->post_title;		

		// errors
		$errors = array();
		// purchase status
		$purchase_status = 'Error';
		// status
		$payment_status = (isset($this->response['PAYMENTINFO_0_PAYMENTSTATUS'])) ? $this->response['PAYMENTINFO_0_PAYMENTSTATUS'] : $this->response['PAYMENTSTATUS'] ;		
		// status
		if($this->status == 'test' && strtoupper($payment_status) == 'PENDING') $payment_status = 'Completed';

		// process on response code
		switch ($payment_status) {
			case 'Completed':		
			case 'Processed':
				// status
				$status_str = __('Last payment was successful','mgm');
				// purchase status
				$purchase_status = 'Success';
				
				// transaction id
				$transaction_id = $this->_get_transaction_id();
				// hook args
				$args = array('post_id'=>$post_id, 'transaction_id'=>$transaction_id);
				// user purchase
				if(isset($user_id) && (int)$user_id > 0){
					$args['user_id'] = $user_id;
				}else{
				// guest purchase	
					$args['guest_token'] = $guest_token;
				}
				// after succesful payment hook
				do_action('mgm_buy_post_transaction_success', $args);// backward compatibility
				do_action('mgm_post_purchase_payment_success', $args);// new organized name
			break;

			case 'Failed':			
			case 'Refunded':			
			case 'Denied':			
			case 'In-Progress':			
				// status
				$status_str = __('Last payment was refunded or denied','mgm');
				// purchase status
				$purchase_status = 'Failure';
				
  				// error
				$errors[] = $status_str;
			break;

			case 'Pending':
				// reason				
				if(isset($this->response['PAYMENTINFO_0_PENDINGREASON'])) {
					$reason = $this->response['PAYMENTINFO_0_PENDINGREASON'];
				}else {
					$reason = $payment_status;
				}	
				// status	
				$status_str = sprintf(__('Last payment is pending. Reason: %s','mgm'), $reason);
				// purchase status
				$purchase_status = 'Pending';	
				
  				// error
				$errors[] = $status_str;	
			break;

			default:
				// status
				$status_str = sprintf(__('Last payment status: %s','mgm'), (isset($payment_status) ? $payment_status : 'Unknown'));
				// purchase status
				$purchase_status = 'Unknown';	
				
  				// error
				$errors[] = $status_str;	
		}
		
		// do action
		do_action('mgm_return_post_purchase_payment_'.$this->module, array('post_id' => $post_id));// new, individual
		do_action('mgm_return_post_purchase_payment', array('post_id' => $post_id));// new, global 
		
		// set as purchase
		$status = __('Failed join', 'mgm'); //overridden on a successful payment
		// check status
		if ( $purchase_status == 'Success' ) {
			// mark as purchased
			if( isset($user->ID) ){	// purchased by user	
				// call coupon action
				do_action('mgm_update_coupon_usage', array('user_id' => $user_id));		
				// set as purchased	
				$this->_set_purchased($user_id, $post_id, NULL, $_POST['custom']);
			}else{
				// purchased by guest
				if( isset($guest_token) ){
					// issue #1421, used coupon
					if(isset($coupon_id) && isset($coupon_code)) {
						// call coupon action
						do_action('mgm_update_coupon_usage', array('guest_token' => $guest_token,'coupon_id' => $coupon_id));
						// set as purchased
						$this->_set_purchased(NULL, $post_id, $guest_token, $_POST['custom'], $coupon_code);
					}else {
						$this->_set_purchased(NULL, $post_id, $guest_token, $_POST['custom']);				
					}
				}
			}	
			
			// status
			$status = __('The post was purchased successfully', 'mgm');
		}		
		
		// transaction status
		mgm_update_transaction_status($_POST['custom'], $status, $status_str);
		
		// blog
		$blogname = get_option('blogname');			
		// post being purchased			
		$post = get_post($post_id);

		// notify user, only if gateway emails on	
		if( ! $dpne ) {			
			// notify user
			if( isset($user->ID) ){
				// mgm post setup object
				$post_obj = mgm_get_post($post_id);
				// check
				if( $this->is_payment_email_sent($_POST['custom']) ) {	
				// check
					if( mgm_notify_user_post_purchase($blogname, $user, $post, $purchase_status, $system_obj, $post_obj, $status_str) ){
					// update as email sent 
						$this->record_payment_email_sent($_POST['custom']);
					}	
				}					
			}			
		}
		
		// notify admin, only if gateway emails on
		if ( ! $dge ) {
			// notify admin, 
			mgm_notify_admin_post_purchase($blogname, $user, $post, $status);
		}

		// if failure:
		if( $purchase_status != 'Success' ) {
			$errors = (isset($this->response['L_ERRORCODE0']) && !empty($this->response['L_ERRORCODE0'])) ? 
					(urlencode($this->response['L_ERRORCODE0'] . ': ' . $this->response['L_SHORTMESSAGE0'] . ' - ' . $this->response['L_LONGMESSAGE0'])) :
					(__('An error occured while porcessing payment.', 'mgm').': ' . $status_str);
					
			mgm_redirect(add_query_arg(array('status'=>'error','errors'=>$errors), $this->_get_thankyou_url())); exit;
		}

		// default error condition redirect
		if(count($errors)>0){
			mgm_redirect(add_query_arg(array('status'=>'error', 'errors'=>implode('|', $errors)), $this->_get_thankyou_url()));
		}
	}
	
	/**
	 * update buy subscription response
	 *
	 */
	function _buy_membership($internal) {	
		$send_email = !$internal;
		// system	
		$system_obj = mgm_get_class('system');		
		$s_packs = mgm_get_class('subscription_packs');
		$dge = bool_from_yn($system_obj->get_setting('disable_gateway_emails'));
		$dpne = bool_from_yn($system_obj->get_setting('disable_payment_notify_emails'));
		
		// get passthrough, stop further process if fails to parse
		$custom = $this->_get_transaction_passthrough($_POST['custom']);
		// local var
		extract($custom);
		
		// currency
		if (!$currency) $currency = $this->setting['currency'];
		
		// find user
		$user = get_userdata($user_id);		
		// multiple subscription level modification
		if(isset($custom['is_another_membership_purchase']) && bool_from_yn($custom['is_another_membership_purchase'])) {
			$member = mgm_get_member_another_purchase($user_id, $custom['membership_type']);			
		}else {
			$member = mgm_get_member($user_id);			
		}
		//init - issue#2384
		$extend_pack_id = $member->pack_id;
		//check 
		if(isset($custom['subscription_option']) && $custom['subscription_option'] == 'extend' ){
			//check
			if(isset($custom['pack_id']) && $custom['pack_id'] != $extend_pack_id)	{
				$member = mgm_get_member_another_purchase($user_id, $custom['membership_type'],$custom['pack_id']);
			}
		}		
		// Get the current AC join date
		if (!$join_date = $member->join_date) $member->join_date = time(); // Set current AC join date		

		// if there is no duration set in the user object then run the following code
		if (empty($duration_type)) {
			//if there is no duration type then use Months
			$duration_type = 'm';
		}
		// membership type default
		if (empty($membership_type)) {
			//if there is no account type in the custom string then use the existing type
			$membership_type = md5($member->membership_type);
		}
		// validate parent method
		$membership_type_verified = $this->_validate_membership_type($membership_type, 'md5|plain');
		// verified
		if (!$membership_type_verified) {
			if (strtolower($member->membership_type) != 'free') {
				// notify admin, only if gateway emails on
				if( ! $dge ) mgm_notify_admin_membership_verification_failed( $this->name );	
				// abort
				return;
			} else {
				$membership_type_verified = $member->membership_type;
			}
		}
		// set
		$membership_type = $membership_type_verified;
		// sub pack
		$subs_pack = $s_packs->get_pack($pack_id);
		// if trial on		
		if ($subs_pack['trial_on']) {
			$member->trial_on            = $subs_pack['trial_on'];
			$member->trial_cost          = $subs_pack['trial_cost'];
			$member->trial_duration      = $subs_pack['trial_duration'];
			$member->trial_duration_type = $subs_pack['trial_duration_type'];
			$member->trial_num_cycles    = $subs_pack['trial_num_cycles'];
		}
		//pack currency over rides genral setting currency - issue #1602
		if(isset($subs_pack['currency']) && $subs_pack['currency'] != $currency){
			$currency =$subs_pack['currency'];
		}		
		// duration
		$member->duration        = $duration;
		$member->duration_type   = strtolower($duration_type);
		$member->amount          = $amount;
		$member->currency        = $currency;
		$member->membership_type = $membership_type;		
		$member->pack_id         = $pack_id;		
		// $member->payment_type    = 'subscription';
		$member->active_num_cycles = (isset($num_cycles) && !empty($num_cycles)) ? $num_cycles : $subs_pack['num_cycles']; 
		$member->payment_type    = ((int)$member->active_num_cycles == 1) ? 'one-time' : 'subscription';
		// payment info for unsubscribe		
		if(!isset($member->payment_info))
			$member->payment_info    = new stdClass;
		$member->payment_info->module = $this->code;		
		// transaction type
		$member->payment_info->txn_type = 'subscription';		
		// subscriber id
		if(isset($this->response['PROFILEID']))
			$member->payment_info->subscr_id = $this->response['PROFILEID'];		
		// refer id
		if(isset($this->response['CORRELATIONID']))
			$member->payment_info->txn_id = $this->response['CORRELATIONID'];	
		// mgm transaction id
		$member->transaction_id = $_POST['custom'];
		// process PayPal response
		$new_status = $update_role = false;
		// status
		$payment_status = 'Error';		
		//if submitted FROM IPN		
		if(isset($_POST['txn_type'])) { 
			//exit if IPN posts after a successful recurring proile creation
			if($_POST['txn_type'] == 'recurring_payment_profile_created' ) {				
				
				exit;
				
			}elseif(in_array($_POST['txn_type'], array('recurring_payment','subscr_payment','express_checkout'))) {				 
				//for sandbox only
				if($this->status == 'test' && $_POST['payment_status'] == 'Pending') 
					$_POST['payment_status'] = 'Completed';
				
				$payment_status = $_POST['payment_status']; 				
			}
		}else {	
			//NORMAL SUBMISSION:
			//if recurring:
			if(isset($this->response['PROFILEID']) && !empty($this->response['PROFILEID'])) {
				$send_email = true;
				$payment_status = 'Completed';
			}else //one-time		
				$payment_status = (isset($this->response['PAYMENTINFO_0_PAYMENTSTATUS'])) ? $this->response['PAYMENTINFO_0_PAYMENTSTATUS'] : $this->response['PAYMENTSTATUS'] ; 
			//if in test mode, treat Pending as Completed
			if($this->status == 'test' && strtoupper($payment_status) == 'PENDING')
				$payment_status = 'Completed';
		}
		// status
		switch ($payment_status) {
			case 'Success':		
			case 'SuccessWithWarning':
			case 'Completed':
			case 'Processed':
				$new_status = MGM_STATUS_ACTIVE;
				$member->status_str = __('Last payment was successful','mgm');					
				
				$time = time();
				$last_pay_date = isset($member->last_pay_date) ? $member->last_pay_date : null;			
				$member->last_pay_date = date('Y-m-d', $time);				
				
				// check subscription_option
				if(isset($subscription_option)){
					// on option
					switch($subscription_option){
						// @ToDo, apply expire date login
						case 'create':
						// expire date will be based on current time					
						case 'upgrade':
						// expire date will be based on current time
							// already on top
						break;
						case 'downgrade':
						// expire date will be based on expire_date if exists, current time other wise					
						case 'extend':
							// expire date will be based on expire_date if exists, current time other wise
							// extend/expire date
							// calc expiry	- issue #1226
							// membership extend functionality broken if we try to extend the same day so removed && $last_pay_date != date('Y-m-d', $time) check
							/*
							issue #2384 -reverted change due to this module we are getting twice IPN notification one is manual api remote post and another direct paypal IPN push notifaction
							so here bug is there if customer try to extend same day multiple times not possible.
							*/	
							if (!empty($member->expire_date) && $last_pay_date != date('Y-m-d', $time) ) {
								$expiry = strtotime($member->expire_date);
								if ($expiry > 0 && $expiry > $time) {
									$time = $expiry;
								}
							}
						break;
					}
				}
				
				// type expanded
				$duration_exprs = $s_packs->get_duration_exprs();
				// if not lifetime/date range
				if(in_array($member->duration_type, array_keys($duration_exprs))) {// take only date exprs
					//consider trial duration if trial period is applicable
					if(isset($trial_on) && $trial_on == 1 ) {
						//Do it only once
						if(!isset($member->rebilled) && isset($member->active_num_cycles) && $member->active_num_cycles != 1 ) {							
							$time = strtotime('+' . $trial_duration . ' ' . $duration_exprs[$trial_duration_type], $time);								
						}					
					} else {
						// time - issue #1068
						$time = strtotime('+' . $member->duration . ' '  . $duration_exprs[$member->duration_type], $time);							
					}
					// formatted
					$time_str = date('Y-m-d', $time);				
					// date extended				
					if (!$member->expire_date || strtotime($time_str) > strtotime($member->expire_date)) {
						$member->expire_date = $time_str;										
					}
				}else{
					//if lifetime:
					if($member->duration_type == 'l'){// el = lifetime
						$member->expire_date = '';
					}
					//issue #1096
					if($member->duration_type == 'dr'){// el = /date range
						$member->expire_date = $duration_range_end_dt;
					}						
				}				
				
				//update rebill: issue #: 489
				if(isset($member->rebilled) && isset($member->active_num_cycles) && $member->active_num_cycles != 1 && (int)$member->rebilled < (int)$member->active_num_cycles) {
					// rebill
					$member->rebilled = (!$member->rebilled) ? 1 : ((int)$member->rebilled+1);		
				}
				
				//cancel previous subscription:
				//This is required only for the transactions initiated by the user				
				$this->cancel_recurring_subscription($_POST['custom'], null, null, $pack_id);
					
				//clear cancellation status if already cancelled:
				if(isset($member->status_reset_on)) unset($member->status_reset_on);
				if(isset($member->status_reset_as)) unset($member->status_reset_as);
								
				// role update
				if ($role) $update_role = true;	
						
				// transaction_id
				$transaction_id = $this->_get_transaction_id();
				// hook args
				$args = array('user_id' => $user_id, 'transaction_id'=>$transaction_id);
				// another membership
				if(isset($custom['is_another_membership_purchase']) && bool_from_yn($custom['is_another_membership_purchase'])) {
					$args['another_membership'] = $custom['membership_type'];
				}
				// after succesful payment hook
				do_action('mgm_membership_transaction_success', $args);// backward compatibility				
				do_action('mgm_subscription_purchase_payment_success', $args);// new organized name	

			break;
			
			case 'Failure':
			case 'FailureWithWarning':
			case 'Failed':
				$new_status = MGM_STATUS_NULL;
				$member->status_str = __('Last paymentis failed','mgm');
				break;
				
			case 'Denied':
			case 'Refunded':
				$new_status = MGM_STATUS_NULL;
				$member->status_str = __('Last payment was refunded or denied','mgm');
				break;	

			case 'Pending':
			case 'In-Progress':
				$new_status = MGM_STATUS_PENDING;

				if(isset($this->response['PAYMENTINFO_0_PENDINGREASON'])) {
					$reason = $this->response['PAYMENTINFO_0_PENDINGREASON'];
				}elseif (isset($_POST['pending_reason']))
					$reason = $_POST['pending_reason'];
				else 
					$reason = $payment_status;
						
				$member->status_str = sprintf(__('Last payment is pending. Reason: %s','mgm'), $reason);
				break;

			default:
				$new_status = MGM_STATUS_ERROR;
				$member->status_str = sprintf(__('Last payment status: %s','mgm'), $payment_status);
				break;
		}

		// handle exceptions from the subscription specific fields
		if ($new_status == MGM_STATUS_ACTIVE && in_array($_POST['txn_type'], array('subscr_failed', 'subscr_eot')) && isset($_POST['txn_type']) ) {
			$new_status = MGM_STATUS_NULL;
			$member->status_str = __('The subscription is not active','mgm');
		}
		
		// old status
		$old_status = $member->status;				
		// set new status
		$member->status = $new_status;
		
		// whether to acknowledge the user - This should happen only once
		$acknowledge_user = $this->is_payment_email_sent($_POST['custom']);
		// whether to subscriber the user to Autoresponder - This should happen only once
		$acknowledge_ar = mgm_subscribe_to_autoresponder($member, $_POST['custom']);
		
		// another_subscription modification
		if(isset($custom['is_another_membership_purchase']) && bool_from_yn($custom['is_another_membership_purchase'])) {			
			//issue #1227
			if($subs_pack['hide_old_content']) $member->hide_old_content = $subs_pack['hide_old_content']; 
			
			// save
			mgm_save_another_membership_fields($member, $user_id);

			// Multiple membership upgrade: first time
			if (isset($custom['multiple_upgrade_prev_packid']) && is_numeric($custom['multiple_upgrade_prev_packid'])) {
				mgm_multiple_upgrade_save_memberobject($custom, $member->transaction_id);	
			}
		}else {
			//check - issue#2384
			if(isset($custom['subscription_option']) && $custom['subscription_option'] == 'extend' ){
				//check
				if(isset($custom['pack_id']) && $custom['pack_id'] != $extend_pack_id)	{			
					mgm_save_another_membership_fields($member, $user_id);
				}else {
					$member->save();
				}
			}else {
				$member->save();
			}			
		}			
		
		// status change event
		do_action('mgm_user_status_change', $user_id, $new_status, $old_status, 'module_' . $this->module, $member->pack_id);	
		
		//update coupon usage
		do_action('mgm_update_coupon_usage', array('user_id' => $user_id));
		
		// role
		if ($update_role) {						
			$obj_role = new mgm_roles();				
			$obj_role->add_user_role($user_id, $role);
		}

		// return action
		do_action('mgm_return_'.$this->module, array('user_id' => $user_id));// backward compatibility
		do_action('mgm_return_subscription_payment_'.$this->module, array('user_id' => $user_id));// new , individual	
		do_action('mgm_return_subscription_payment', array('user_id' => $user_id, 'acknowledge_ar' => $acknowledge_ar, 'mgm_member' => $member));// new, global: pass mgm_member object to consider multiple level purchases as well. 	

		// read member again for internal updates if any
		// another_subscription modification
		if(isset($custom['is_another_membership_purchase']) && bool_from_yn($custom['is_another_membership_purchase'])) {
			$member = mgm_get_member_another_purchase($user_id, $custom['membership_type']);				
		}else {
			$member = mgm_get_member($user_id);			
		}
		//check - issue #2384
		if(isset($custom['subscription_option']) && $custom['subscription_option'] == 'extend' ){
			//check
			if(isset($custom['pack_id']) && $custom['pack_id'] != $extend_pack_id)	{
				$member = mgm_get_member_another_purchase($user_id, $custom['membership_type'],$custom['pack_id']);
			}
		}		
		// transaction status
		mgm_update_transaction_status($member->transaction_id, $member->status, $member->status_str);
		
		// send email notification to client
		$blogname = get_option('blogname');
		
		//let the mail send only for IPN update:
		if($send_email) {			
			if( $acknowledge_user ) {
				// notify user, only if gateway emails on 
				if ( ! $dpne ) {			
					// notify
					if( mgm_notify_user_membership_purchase($blogname, $user, $member, $custom, $subs_pack, $s_packs, $system_obj) ){						
						// update as email sent 
						$this->record_payment_email_sent($_POST['custom']);	
					}				
				}
				// notify admin, only if gateway emails on 
				if ( ! $dge ) {
					// pack duration
					$pack_duration = $s_packs->get_pack_duration($subs_pack);
					// notify admin,
					mgm_notify_admin_membership_purchase($blogname, $user, $member, $pack_duration);
				}
			}
		}
		
		//error redirection:
		if($internal && $member->status != MGM_STATUS_ACTIVE) {			
			$errors = (isset($this->response['L_ERRORCODE0']) && !empty($this->response['L_ERRORCODE0'])) ? 
					(urlencode($this->response['L_ERRORCODE0'] . ': ' . $this->response['L_SHORTMESSAGE0'] . ' - ' . $this->response['L_LONGMESSAGE0'])) :
					(__('An error occured while porcessing payment.', 'mgm').': ' . $member->status_str);
					
			mgm_redirect(add_query_arg(array('status'=>'error','errors'=>$errors), $this->_get_thankyou_url()));
			exit;
		}
	}
	
	// cancel membership
	function _cancel_membership($tran_id, $redirect = false) {
		// system	
		$system_obj  = mgm_get_class('system');		
		$s_packs = mgm_get_class('subscription_packs');
		$dge     = bool_from_yn($system_obj->get_setting('disable_gateway_emails'));
		$dpne    = bool_from_yn($system_obj->get_setting('disable_payment_notify_emails'));
		//issue #1521
		$is_admin = (is_super_admin()) ? true : false;
		// get passthrough, stop further process if fails to parse
		$custom = $this->_get_transaction_passthrough($tran_id);
		// local var
		extract($custom);
		
		// find user
		$user = get_userdata($user_id);	
		$member = mgm_get_member($user_id);
			
		// multiple membership level update:
		$multiple_update = false;	
		// check	
		if( (isset($_POST['membership_type']) && $member->membership_type != $_POST['membership_type'] ) || (isset($is_another_membership_purchase) && $is_another_membership_purchase == 'Y' )){
			$multiple_update = true;
			$multi_memtype = (isset($_POST['membership_type'])) ? $_POST['membership_type'] : $membership_type;
			$member = mgm_get_member_another_purchase($user_id, $multi_memtype);		
		}
		
		//Don't save if it is cancel request with an upgrade:		
		if(isset($_POST['recurring_payment_id']) && isset($member->payment_info->subscr_id) && $_POST['recurring_payment_id'] != $member->payment_info->subscr_id) {			
			return;
		}
		
		// get pack
		if($member->pack_id){
			$subs_pack = $s_packs->get_pack($member->pack_id);
		}else{
			$subs_pack = $s_packs->validate_pack($member->amount, $member->duration, $member->duration_type, $member->membership_type);
		}
				
		// tracking fields module_field => post_field
		$tracking_fields = array('txn_id'=>'CORRELATIONID');
		// save tracking fields
		$this->_save_tracking_fields($tracking_fields, $member, $this->response);
		
		// types
		$duration_exprs = $s_packs->get_duration_exprs();
						
		// default expire date				
		$expire_date = $member->expire_date;	
		// if lifetime:
		if($member->duration_type == 'l') $expire_date = date('Y-m-d');				
		
		// if trial on 
		if ($subs_pack['trial_on'] && isset($duration_exprs[$subs_pack['trial_duration_type']])) {			
			// if cancel data is before trial end, set cancel on trial expire_date
			$trial_expire_date = strtotime('+' . $subs_pack['trial_duration'] . ' ' . $duration_exprs[$subs_pack['trial_duration_type']], $member->join_date);
			
			// if lower
			if(time() < $trial_expire_date){
				$expire_date = date('Y-m-d',$trial_expire_date);
			}
		}	
		
		// transaction_id
		$trans_id = $member->transaction_id;
		// old status
		$old_status = $member->status;		
		// if today 
		if($expire_date == date('Y-m-d')){
			// status
			$new_status          = MGM_STATUS_CANCELLED;
			$new_status_str      = __('Subscription cancelled','mgm');
			// set
			$member->status      = $new_status;
			$member->status_str  = $new_status_str;					
			$member->expire_date = date('Y-m-d');	
																																							
			// reassign expiry membership pack if exists: issue#: 535			
			$member = apply_filters('mgm_reassign_member_subscription', $user_id, $member, 'CANCEL', true);		
		}else{
			// date
			$date_format = mgm_get_date_format('date_format');
			// status
			$new_status     = MGM_STATUS_AWAITING_CANCEL;	
			$new_status_str = sprintf(__('Subscription awaiting cancellation on %s','mgm'), date($date_format, strtotime($expire_date)));			
			// set
			$member->status      = $new_status;
			$member->status_str  = $new_status_str;	
			// set reset date
			$member->status_reset_on = $expire_date;
			$member->status_reset_as = MGM_STATUS_CANCELLED;
		}
		
		// multiple membership level update:	
		if($multiple_update) {
			mgm_save_another_membership_fields($member, $user_id);
		}else{				
			$member->save();
		}	
		
		// transaction status
		mgm_update_transaction_status($trans_id, $new_status, $new_status_str);
		
		// status change event
		do_action('mgm_user_status_change', $user_id, $new_status, $old_status, 'member_unsubscribe', $member->pack_id);

		// send email notification to client
		$blogname = get_option('blogname');

		//let the email send only from IPN POST
		if( ! $redirect ) {
			// notify user
			if( ! $dpne ) {
				// notify user
				mgm_notify_user_membership_cancellation($blogname, $user, $member, $new_status, $system_obj);			
			}
			// notify admin
			if ( ! $dge ) {
				// notify admin	
				mgm_notify_admin_membership_cancellation($blogname, $user, $member, $new_status);
			}
		}
				
		// after cancellation hook
		do_action('mgm_membership_subscription_cancelled', array('user_id' => $user_id));	

		// redirect 
		if( $redirect ) {
			$lformat = mgm_get_date_format('date_format_long');
			// message
			$message = sprintf(__("You have successfully unsubscribed. Your account has been marked for cancellation on %s", "mgm"), 
			                   ($expire_date == date('Y-m-d') ? 'Today' : date($lformat, strtotime($expire_date))));
			//issue #1521
			if( $is_admin ){
				mgm_redirect( add_query_arg(array('user_id'=>$user_id,'unsubscribe_errors'=>urlencode($message)), admin_url('user-edit.php')) );
			}			
			// redirect 		
			mgm_redirect(mgm_get_custom_url('membership_details', false,array('unsubscribed'=>'true','unsubscribe_errors'=>urlencode($message))));
		}
	}
	
	/**
	 * Cancel Recurring Subscription
	 *
	 * @param int/string $trans_ref	
	 * @param int $user_id	
	 * @param int/string $subscr_id	
	 * @return boolean
	 */			
	function cancel_recurring_subscription($trans_ref = null, $user_id = null, $subscr_id = null, $pack_id = null) {
		//if coming form process return after a subscription payment
		if(!empty($trans_ref)) {
			$transdata = $this->_get_transaction_passthrough($trans_ref);
			if($transdata['payment_type'] != 'subscription_purchase')
				return false;				
					
			$user_id = $transdata['user_id'];
							
			if(isset($transdata['is_another_membership_purchase']) && $transdata['is_another_membership_purchase'] == 'Y') {
				$member = mgm_get_member_another_purchase($user_id, $transdata['membership_type']);			
			}else {
				$member = mgm_get_member($user_id);			
			}
			
			if(isset($member->payment_info->module) && !empty($member->payment_info->module)) {			 
				$subscr_id = null;				
				if(!empty($member->payment_info->subscr_id))
					$subscr_id = $member->payment_info->subscr_id;
				elseif (!empty($member->pack_id)) {	
					//check the pack is recurring
					$s_packs = mgm_get_class('subscription_packs');				
					$sel_pack = $s_packs->get_pack($member->pack_id);										
					if($sel_pack['num_cycles'] != 1) 
						$subscr_id = 0;// 0 stands for a lost subscription id
				}
												
				//check for same module: if not call the same function of the applicale module.
				if(str_replace('mgm_','' , $member->payment_info->module) != str_replace( 'mgm_','' , $this->code ) ) {					
					// mgm_log('RECALLing '. $member->payment_info->module .': cancel_recurring_subscription FROM: ' . $this->code);
					return mgm_get_module($member->payment_info->module, 'payment')->cancel_recurring_subscription($trans_ref, null, null, $pack_id);				
				}
				
				//skip if same pack is updated
				if(empty($member->pack_id) || (is_numeric($pack_id) && $pack_id == $member->pack_id) )
					return false;
				
			}else 
				return false;
		}
		//ony for subscription_purchase
		if($subscr_id) {						
			$user = get_userdata($user_id);
			$format = mgm_get_date_format('date_format');
			// compose post body 			
			$post_data = array(
								'USER'      => $this->setting['username'],	
								'PWD'       => $this->setting['password'],		
								'SIGNATURE' => $this->setting['signature'],
								'VERSION'   => '64.0',//'52.0'
								'METHOD'    => 'ManageRecurringPaymentsProfileStatus',
								'PROFILEID' => $subscr_id,
								'ACTION'    => 'Cancel', 
								'NOTE'      => sprintf('Cancellation selected by member on UPGRADE: "%s", ID: %d on: %s', $user->user_email, $user->ID, date($format))
							);		
			// end point url
			$end_point =  $this->_get_endpoint();	
			
			//issue #1508
			$url_parsed = parse_url($end_point);  			
			// domain/host
			$domain = $url_parsed['host'];
			// headers
			$http_headers = array ('POST /cgi-bin/webscr HTTP/1.1\r\n',
								'Content-Type: application/x-www-form-urlencoded\r\n',
								'Host: '.$domain.'\r\n',
								'Connection: close\r\n\r\n');		
			// post				
			//$http_response = mgm_remote_post($end_point, $post_data, array('headers'=>$http_headers,'timeout'=>30,'sslverify'=>false));			
			// log
			//mgm_log($http_response, $this->get_context( __FUNCTION__ ) );				
			
			// fields
			$fields = mgm_http_build_query($post_data);
			// log
			mgm_log($fields, $this->get_context( 'debug', __FUNCTION__ ));
			// post					
			$http_response = $this->_pp_http_post($end_point, $fields);
			// log
			mgm_log($http_response, $this->get_context( 'debug', __FUNCTION__ ));	
			
			// sleep
			sleep(1);
			// parse
			$this->response = array();
			// parse to array
			parse_str($http_response, $this->response);
			// log
			mgm_log($this->response,$this->get_context( __FUNCTION__ ));
						
			// cancel				
			return ((isset($this->response['ACK']) && $this->response['ACK'] == 'Success') ? true : false);
			
		}elseif($subscr_id === 0) {			
			//send email to admin if subscription Id is absent		
			$system_obj = mgm_get_class('system');
			$dge = bool_from_yn($system_obj->get_setting('disable_gateway_emails'));
			//send email only if setting enabled
			if( ! $dge ) {
				// blog
				$blogname = get_option('blogname');
				// user
				$user = get_userdata($user_id);
				// notify admin
				mgm_notify_admin_membership_cancellation_manual_removal_required($blogname, $user, $member);				
			}
								
			return true;
		}
		
		return false;
	}

	/**
	 * Specifically check recurring status of each rebill for an expiry date
	 * ALong with IPN post mechanism for rebills, the module will need to specifically request for the rebill status
	 * @param int $user_id
	 * @param object $member
	 * @return boolean
	 */
	function query_rebill_status($user_id, $member=NULL) {	
		// check	
		if (isset($member->payment_info->subscr_id) && !empty($member->payment_info->subscr_id)) {			
			//issue #1602
			$pack_id  = (int)$member->pack_id;
			if($pack_id) $currency = mgm_get_pack_currency($pack_id);
			
			// post data
			$post_data = array();			
			// add internal vars
			$secure =array(
				'USER'         => $this->setting['username'],	
				'PWD'          => $this->setting['password'],		
				'SIGNATURE'    => $this->setting['signature'],
				'VERSION'      => '64.0',
				'IPADDRESS'    => mgm_get_client_ip_address(),
				'CURRENCYCODE' => ($currency) ? $currency : $this->setting['currency']);
			// merge
			$post_data = array_merge($post_data, $secure); // overwrite post data array with secure params		
			// method
			$post_data['METHOD']     = 'GetRecurringPaymentsProfileDetails';
			$post_data['PROFILEID']  = $member->payment_info->subscr_id;			
			
			// endpoint	url
			$end_point = $this->_get_endpoint();		
			
			//issue #1508
			$url_parsed = parse_url($end_point);  			
			// domain/host
			$domain = $url_parsed['host'];
			// headers
			$http_headers = array ('POST /cgi-bin/webscr HTTP/1.1\r\n',
								'Content-Type: application/x-www-form-urlencoded\r\n',
								'Host: '.$domain.'\r\n',
								'Connection: close\r\n\r\n');			
			// post				
			//$http_response = mgm_remote_post($end_point, $post_data, array('headers'=>$http_headers,'timeout'=>30,'sslverify'=>false));
			// log
			//mgm_log($http_response, $this->get_context( __FUNCTION__ ));
			
			// fields
			$fields = mgm_http_build_query($post_data);
			// log
			mgm_log($fields, $this->get_context( __FUNCTION__ ) );
			// post					
			$http_response = $this->_pp_http_post($end_point, $fields);
			// log
			mgm_log($http_response, $this->get_context( 'debug', __FUNCTION__ ));			
				
			// reset
			$this->response = array();	
			// parse to array
			parse_str($http_response, $this->response);
			// log
			mgm_log($this->response, $this->get_context( __FUNCTION__ ));
			
			// check		
			if (isset($this->response['STATUS'])) {
				// old status
				$old_status = $member->status;	
				// set status
				switch($this->response['STATUS']){
					case 'Active':
						// check
						if( isset($this->response['FAILEDPAYMENTCOUNT']) && isset($this->response['MAXFAILEDPAYMENTS']) 
							&& ($this->response['FAILEDPAYMENTCOUNT'] >= 1 && 
								$this->response['FAILEDPAYMENTCOUNT'] <= $this->response['MAXFAILEDPAYMENTS']) ){
							// set new status
							$member->status = $new_status = MGM_STATUS_NULL;
							// status string
							$member->status_str = __('Last payment cycle failed. Customer has failed payment attempts.','mgm');							
						}else{
							// set
							$member->status = $new_status = MGM_STATUS_ACTIVE;
							// status string
							$member->status_str = __('Last payment cycle processed successfully','mgm');	
							// last pay date						
							$member->last_pay_date = (isset($this->response['LASTPAYMENTDATE'])) ? date('Y-m-d', strtotime($this->response['LASTPAYMENTDATE'])) : date('Y-m-d');	
							// expire date
							if(isset($this->response['LASTPAYMENTDATE']) && !empty($member->expire_date)){							
								// date to add
							 	$date_add = mgm_get_pack_cycle_date((int)$member->pack_id, $member);		
								// check 
								if($date_add !== false){
									// new expire date should be later than current expire date, #1223
									$new_expire_date = date('Y-m-d', strtotime($date_add, strtotime($member->last_pay_date)));
									// apply on last pay date so the calc always treat last pay date form gateway	
									if(strtotime($new_expire_date) > strtotime($member->expire_date)){							
										$member->expire_date = $new_expire_date;
									}
								}else{
								// set last pay date if greater than expire date
									if(strtotime($member->last_pay_date) > strtotime($member->expire_date)){
										$member->expire_date = $member->last_pay_date;
									}
								}				
							} 
						}
						
						// save
						$member->save();

						// set new status
						if( isset($new_status) && $new_status != MGM_STATUS_NULL ){
							// only run in cron, other wise too many tracking will be added
							// if( defined('DOING_QUERY_REBILL_STATUS') && DOING_QUERY_REBILL_STATUS != 'manual' ){
							// transaction_id
							$transaction_id = $member->transaction_id;
							// hook args
							$args = array('user_id' => $user_id, 'transaction_id' => $transaction_id);
							// after succesful payment hook
							do_action('mgm_membership_transaction_success', $args);// backward compatibility				
							do_action('mgm_subscription_purchase_payment_success', $args);// new organized name	
						}		
					break;
					case 'Cancelled':
					case 'Suspended':
						// if expire date in future, let as awaiting
						if(!empty($member->expire_date) && strtotime($member->expire_date) > time()){
							// date format
							$date_format = mgm_get_date_format('date_format');				
							// status				
							$member->status = $new_status = MGM_STATUS_AWAITING_CANCEL;	
							// status string	
							$member->status_str = sprintf(__('Subscription awaiting cancellation on %s','mgm'), date($date_format, strtotime($member->expire_date)));							
							// set reset date				
							$member->status_reset_on = $member->expire_date;
							// reset as
							$member->status_reset_as = MGM_STATUS_CANCELLED;
						}else{
						// set cancelled
							// status
							$member->status = $new_status = MGM_STATUS_CANCELLED;
							// status string
							$member->status_str = __('Last payment cycle cancelled','mgm');	
						}
						// save
						$member->save();

						// only run in cron, other wise too many tracking will be added
						// if( defined('DOING_QUERY_REBILL_STATUS') && DOING_QUERY_REBILL_STATUS != 'manual' ){
						// after cancellation hook
						do_action('mgm_membership_subscription_cancelled', array('user_id' => $user_id));	
						// }
					break;
					case 'Expired':
						// set new status
						$member->status = $new_status = MGM_STATUS_EXPIRED;
						// status string
						$member->status_str = __('Last payment cycle expired','mgm');	
						// save
						$member->save();
					break;	
				}			
				// action
				if( isset($new_status)  && $new_status != $old_status){
					// user status change
					do_action('mgm_user_status_change', $user_id, $new_status, $old_status, 'module_' . $this->module, $member->pack_id);	
					// rebill status change
					do_action('mgm_rebill_status_change', $user_id, $new_status, $old_status, 'query');// query or notify
				}				
				// return as a successful rebill
				return true;
			}			
		}
		// return
		return false;//default to false to skip normal modules
	}
	
	/**
	 * set default settings
	 *
	 */
	function _default_setting(){
		// paypalexpress specific		
		$this->setting['username']  = '';
		$this->setting['password']  = '';
		$this->setting['signature'] = '';	
		$this->setting['locale']    = 'US';	
		$this->setting['currency']  = mgm_get_class('system')->setting['currency'];
		//issue #974
		$this->setting['max_failed_payments'] = 3;		
		//issue #2080
		$this->setting['max_retry_num_days'] = 2;		
		// purchase price
		if(in_array('buypost', $this->supported_buttons)){
			$this->setting['purchase_price']  = 4.00;		
		}
		$this->setting['landingpage']    = 'login';
		$this->setting['rebill_check_delay'] = 0;			
		// callback messages				
		$this->_setup_callback_messages();
		// callback urls
		$this->_setup_callback_urls();
	}
	/**
	 * record transaction details
	 *
	 * @return unknown
	 */
	function _log_transaction(){
		// check
		if($this->_is_transaction($_POST['custom'])){	
			// tran id
			$tran_id = (int)$_POST['custom'];			
			// return data				
			if(isset($this->response['TRANSACTIONTYPE'])){
				$option_name = $this->module.'_'.strtolower($this->response['TRANSACTIONTYPE']).'_return_data';
			}else{
				$option_name = $this->module.'_return_data';
			}
			// set			
			mgm_add_transaction_option(array('transaction_id'=>$tran_id,'option_name'=>$option_name,'option_value'=> json_encode($this->response)));
			
			// options 
			$options = array('PROFILEID','CORRELATIONID','TRANSACTIONID'); 
			// loop
			foreach($options as $option){
				if(isset($this->response[$option])){
					mgm_add_transaction_option(array('transaction_id'=>$tran_id,'option_name'=>strtolower($this->module.'_'.$option),'option_value'=> (isset($this->response[$option]) ? $this->response[$option] : '' )));
				}
			}
			// return transaction id
			return $tran_id;
		}	
		// error
		return false;
	}
	
	function _setup_endpoints($end_points = array()){
		// define defaults
		$end_points_default = array('test'           => 'https://api-3t.sandbox.paypal.com/nvp',
									'live'           => 'https://api-3t.paypal.com/nvp',
									'test_authorize' => 'https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&useraction=commit&token=[TOKEN_STRING]',	
									'live_authorize' => 'https://www.paypal.com/webscr&cmd=_express-checkout&useraction=commit&token=[TOKEN_STRING]');	
		// merge
		$end_points = (is_array($end_points)) ? array_merge($end_points_default, $end_points) : $end_points_default;
		// set
		$this->_set_endpoints($end_points);
	}
	
	/**
	 * sets required address fields: need to check
	 *
	 * @param unknown_type $user
	 * @param unknown_type $data
	 */
	function _set_address_fields($user, &$data){
		// mappings
		$mappings = array('first_name'=>'FIRSTNAME','last_name'=>'LASTNAME','address'=>'STREET',
		                 'city'=>'CITY','state'=>'STATE','zip'=>'ZIP','country'=>'COUNTRYCODE');
						 
		// parent
		parent::_set_address_fields($user, $data, $mappings, array($this,'_address_fields_filter'));				 
	}
	
	// filter
	function _address_fields_filter($name, $value){
		// reuse parent filter unless needed
		switch($name){
			default:
				 $value = parent::_address_field_filter($name, $value);		
			break;
		}	
		// return 
		return $value;
	}
	
	
	//verify request
	function _verify_callback() {
		return (isset($_POST['custom']) && !empty($_POST['custom'])) ? true : false ;	
	}		
	// MODULE SPECIFIC PRIVATE HELPERS /////////////////////////////////////////////////////////////////
	 /**
      * get rebill status check delay
	  *
	  * @param string $time
	  * @return string 
	  */
	 function get_rebill_status_check_delay( $time=null ){
	 	// delayed
	 	if( $this->is_rebill_status_check_delayed() ){
	 		// time
	 		if( is_null($time) ) $time = time();
	 		// delay
	 		$time = strtotime($this->setting['rebill_check_delay'], $time);// '-24 HOUR'
	 	}

	 	// return
	 	return $time; 
	 }
	/**
	 * fetch remote data via http POST
	 *
	 * @param string $url
	 * @param string $data
	 * @return mixed $response
	 */	 

	function _pp_http_post($end_point, $nvpreq) {
					
		// Set the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $end_point);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		//curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'TLSv1');
		
		// Turn off the server and peer verification (TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		
		// Set the API operation, version, and API signature in the request.
		//$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
				
		// Set the request as a POST FIELD for curl.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
		
		// Get response from the server.
		$httpResponse = curl_exec($ch);
		//check
		if(!$httpResponse) {
			mgm_log(mgm_pr(curl_errno($ch),true),$this->get_context( 'debug', __FUNCTION__ ));
			mgm_log(mgm_pr(curl_error($ch),true),$this->get_context( 'debug', __FUNCTION__ ));
			//exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
		}
		
		//return
		return $httpResponse;
		
		/*			
		// Extract the response details.
		$httpResponseAr = explode("&", $httpResponse);
		
		$httpParsedResponseAr = array();
		foreach ($httpResponseAr as $i => $value) {
		
			$tmpAr = explode("=", $value);
			
			if(sizeof($tmpAr) > 1) {
			
				$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
			}
		}
		
		if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {		
			exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
		}
		
		return $httpParsedResponseAr;
		
		*/
	}	 	
}

// end file