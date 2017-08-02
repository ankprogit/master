<?php 
class WC_Billecta_Payment_Gateway extends WC_Payment_Gateway{
	public function __construct(){
		$this->id = 'billecta_payment';
		$this->method_title = __('Billecta Payment','woocommerce-billecta-payment-gateway');
		$this->title = __('Billecta Payment','woocommerce-billecta-payment-gateway');
		$this->has_fields = true;
		$this->init_form_fields();
		$this->init_settings();
		$this->enabled = $this->get_option('enabled');
		$this->title = $this->get_option('title');
		$this->description = $this->get_option('description');
		add_action('woocommerce_update_options_payment_gateways_'.$this->id, array($this, 'process_admin_options'));
	}
	public function init_form_fields(){
				$this->form_fields = array(
					'enabled' => array(
					'title' 		=> __( 'Enable/Disable', 'woocommerce-billecta-payment-gateway' ),
					'type' 			=> 'checkbox',
					'label' 		=> __( 'Enable Custom Payment', 'woocommerce-billecta-payment-gateway' ),
					'default' 		=> 'yes'
					),
					'title' => array(
						'title' 		=> __( 'Plugin Title', 'woocommerce-billecta-payment-gateway' ),
						'type' 			=> 'text',
						'description' 	=> __( 'This controls the title', 'woocommerce-billecta-payment-gateway' ),
						'default'		=> __( 'Custom Payment', 'woocommerce-billecta-payment-gateway' ),
						'desc_tip'		=> true,
					),
					'description' => array(
						'title' => __( 'Customer Message', 'woocommerce-billecta-payment-gateway' ),
						'type' => 'textarea',
						'css' => 'width:500px;',
						'default' => 'None of the other payment options are suitable for you? please drop us a note about your favourable payment option and we will contact you as soon as possible.',
						'description' 	=> __( 'The message which you want it to appear to the customer in the checkout page.', 'woocommerce-billecta-payment-gateway' ),
					),
						'Full_payment' => array(
					'title' 		=> __( 'Full Payment', 'woocommerce-billecta-payment-gateway' ),
					'type' 			=> 'checkbox',
					'label' 		=> __( 'Full payment Enable Custom Payment', 'woocommerce-billecta-payment-gateway' ),
					'default' 		=> '0'
					),'inoice_fee' =>
  array(
  'title' 		=> __( 'invoice_fee', 'woocommerce-billecta-payment-gateway' ),
    'desc'    => __( 'This controls the position of the currency symbol.', 'woocommerce-billecta-payment-gateway' ),
    'id'      => 'woocommerce_currency_pos',
    'css'     => 'min-width:150px;',
    'std'     => 'No Fee', // WooCommerce < 2.0
    'default' => 'no', // WooCommerce >= 2.0
    'type'    => 'select',
	'label' 		=> __( 'Invoice fee', 'woocommerce-billecta-payment-gateway' ),
    'options' => array(
 '0'        => __( 'no fee', 'woocommerce-billecta-payment-gateway' ),
      '5'        => __( '5', 'woocommerce-billecta-payment-gateway' ),
      '10'       => __( '10', 'woocommerce-billecta-payment-gateway' ),
      '15'  => __( '15', 'woocommerce-billecta-payment-gateway' ),
      '20' => __( '20', 'woocommerce-billecta-payment-gateway' )
    ),
    'desc_tip' =>  true,
  ),'partial_payment' => array(
					'title' 		=> __( 'Partial Payment', 'woocommerce-billecta-payment-gateway' ),
					'type' 			=> 'checkbox',
					
					'label' 		=> __( 'Partial payment Enable Custom Payment', 'woocommerce-billecta-payment-gateway' ),
					'default' 		=> 'no'
					),
	'num_of days_option1' => array(
					'title' 		=> __( 'Nr of due days per invoice option1:', 'woocommerce-billecta-payment-gateway' ),
					'type' 			=> 'select',
					 'options' => array(
 '2'        => __( '2', 'woocommerce-billecta-payment-gateway' ),
      '3'        => __( '3', 'woocommerce-billecta-payment-gateway' ),
      '4'       => __( '4', 'woocommerce-billecta-payment-gateway' ),
      '5'  => __( '5', 'woocommerce-billecta-payment-gateway' ),
      '6' => __( '6', 'woocommerce-billecta-payment-gateway' ),
	  '7'  => __( '7', 'woocommerce-billecta-payment-gateway' ),
	  '8'  => __( '8', 'woocommerce-billecta-payment-gateway' ),
	  '9'  => __( '9', 'woocommerce-billecta-payment-gateway' ),
	  '10'  => __( '10', 'woocommerce-billecta-payment-gateway' ),
	  '11'  => __( '11', 'woocommerce-billecta-payment-gateway' ),
	  '12'  => __( '12', 'woocommerce-billecta-payment-gateway' ),
	  '13'  => __( '13', 'woocommerce-billecta-payment-gateway' ),
	  '14'  => __( '14', 'woocommerce-billecta-payment-gateway' ),
	  '15'  => __( '15', 'woocommerce-billecta-payment-gateway' ),
	  '16'  => __( '16', 'woocommerce-billecta-payment-gateway' ),
	  '17'  => __( '17', 'woocommerce-billecta-payment-gateway' ),
	  '18'  => __( '18', 'woocommerce-billecta-payment-gateway' ),
	    '19'  => __( '19', 'woocommerce-billecta-payment-gateway' ),
		  '20'  => __( '20', 'woocommerce-billecta-payment-gateway' ),
    ),
					'label' 		=> __( 'Partial payment Enable Custom Payment', 'woocommerce-billecta-payment-gateway' ),
					'default' 		=> 'no'
					),'partial_payment' => array(
					'title' 		=> __( 'Partial Payment', 'woocommerce-billecta-payment-gateway' ),
					'type' 			=> 'checkbox',
					
					'label' 		=> __( 'Partial payment Enable Custom Payment', 'woocommerce-billecta-payment-gateway' ),
					'default' 		=> 'no'
					),
	'num_invoices' => array(
					'title' 		=> __( 'Number Invoices', 'woocommerce-billecta-payment-gateway' ),
					'type' 			=> 'select',
					 'options' => array(
 '2'        => __( '2', 'woocommerce-billecta-payment-gateway' ),
      '3'        => __( '3', 'woocommerce-billecta-payment-gateway' ),
      '4'       => __( '4', 'woocommerce-billecta-payment-gateway' ),
      '5'  => __( '5', 'woocommerce-billecta-payment-gateway' ),
      '6' => __( '6', 'woocommerce-billecta-payment-gateway' ),
	  '7'  => __( '7', 'woocommerce-billecta-payment-gateway' ),
	  '8'  => __( '8', 'woocommerce-billecta-payment-gateway' ),
	  '9'  => __( '9', 'woocommerce-billecta-payment-gateway' ),
	  '10'  => __( '10', 'woocommerce-billecta-payment-gateway' ),
	  '11'  => __( '11', 'woocommerce-billecta-payment-gateway' ),
	  '12'  => __( '12', 'woocommerce-billecta-payment-gateway' ),
    ),
					'label' 		=> __( 'Number of invoices option 1 Enable Custom Payment', 'woocommerce-billecta-payment-gateway' ),
					'default' 		=> 'no'
					),'inoice_fee_partial_option1' =>
  array(
  'title' 		=> __( 'invoice_fee_option', 'woocommerce-billecta-payment-gateway' ),
    'desc'    => __( 'This controls the position of the currency symbol.', 'woocommerce-billecta-payment-gateway' ),
    'id'      => 'woocommerce_currency_pos',
    'css'     => 'min-width:150px;',
    'std'     => 'No Fee', // WooCommerce < 2.0
    'default' => 'no', // WooCommerce >= 2.0
    'type'    => 'select',
	'label' 		=> __( 'Invoice fee Option 1', 'woocommerce-billecta-payment-gateway' ),
    'options' => array(
 '0'        => __( 'no fee', 'woocommerce-billecta-payment-gateway' ),
      '5'        => __( '5', 'woocommerce-billecta-payment-gateway' ),
      '10'       => __( '10', 'woocommerce-billecta-payment-gateway' ),
      '15'  => __( '15', 'woocommerce-billecta-payment-gateway' ),
      '20' => __( '20', 'woocommerce-billecta-payment-gateway' )
    ),
    'desc_tip' =>  true,
  ),
					'registration_fee_option1' => array(
					'title' 		=> __( 'Registration fee:', 'woocommerce-billecta-payment-gateway' ),
					'type' 			=> 'select',
					 'options' => array(
 '2'        => __( '2', 'woocommerce-billecta-payment-gateway' ),
      '3'        => __( '3', 'woocommerce-billecta-payment-gateway' ),
      '4'       => __( '4', 'woocommerce-billecta-payment-gateway' ),
      '5'  => __( '5', 'woocommerce-billecta-payment-gateway' ),
      '6' => __( '6', 'woocommerce-billecta-payment-gateway' ),
	  '7'  => __( '7', 'woocommerce-billecta-payment-gateway' ),
	  '8'  => __( '8', 'woocommerce-billecta-payment-gateway' ),
	  '9'  => __( '9', 'woocommerce-billecta-payment-gateway' ),
	  '10'  => __( '10', 'woocommerce-billecta-payment-gateway' ),
	  '11'  => __( '11', 'woocommerce-billecta-payment-gateway' ),
	  '12'  => __( '12', 'woocommerce-billecta-payment-gateway' ),
    ),
					'label' 		=> __( 'Registration option 1 Enable Custom Payment', 'woocommerce-billecta-payment-gateway' ),
					'default' 		=> 'no'
					),
	'text_on_button' => array(
					'title' 		=> __( 'Text on Button', 'woocommerce-billecta-payment-gateway' ),
					'type' 			=> 'text',
					'label' 		=> __( 'Text on Button Custom Payment', 'woocommerce-billecta-payment-gateway' ),
					'default' 		=> 'Submit'
					),
					
'color_on_button' => array(
					'title' 		=> __( 'color on button', 'woocommerce-billecta-payment-gateway' ),
					'type' 			=> 'text',
					'label' 		=> __( 'Color on button Custom Payment', 'woocommerce-billecta-payment-gateway' ),
					'default' 		=> 'red'
					),
					
	'username' => array(
					'title' 		=> __( 'Username', 'woocommerce-billecta-payment-gateway' ),
					'description' 	=> __( 'Please enter the Username that you used to logged in into the billecta', 'woocommerce-billecta-payment-gateway' ),
					'type' 			=> 'text',
					'label' 		=> __( 'Username Custom Payment', 'woocommerce-billecta-payment-gateway' ),
					'desc_tip'		=> true,
					),
		'password' => array(
					'title' 		=> __( 'Password', 'woocommerce-billecta-payment-gateway' ),
					'type' 			=> 'password',
					'description' 	=> __( 'Please enter the password that you used to logged in into the billecta', 'woocommerce-billecta-payment-gateway' ),
					'label' 		=> __( 'Password Custom Payment', 'woocommerce-billecta-payment-gateway' ),
					'desc_tip'		=> true,
					),
					
	'CreditorPublicId' => array(
					'title' 		=> __( 'CreditorPublicId', 'woocommerce-billecta-payment-gateway' ),
					'type' 			=> 'text',
					'description' 	=> __( 'Please enter the CreditorPublicId', 'woocommerce-billecta-payment-gateway' ),
					'label' 		=> __( 'CreditorPublicId ', 'woocommerce-billecta-payment-gateway' ),
					'desc_tip'		=> true,
					),
	'mode' => array(
					'title' 		=> __( 'Live/Test', 'woocommerce-billecta-payment-gateway' ),
					'type' 			=> 'checkbox',
					'description' 	=> __( 'PLease select the mode fot the api to use', 'woocommerce-billecta-payment-gateway' ),
					'label' 		=> __( 'Check this for live mode', 'woocommerce-billecta-payment-gateway' ),
					'desc_tip'		=> true,
					)
			 );
	}
	/**
	 * Admin Panel Options
	 * - Options for bits like 'title' and availability on a country-by-country basis
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function admin_options() {
		?>
		<h3><?php _e( 'Billecta Payment Settings', 'woocommerce-billecta-payment-gateway' ); ?></h3>
			<div id="poststuff">
				<div id="post-body" class="metabox-holder columns-2">
					<div id="post-body-content">
						<table class="form-table">
							<?php $this->generate_settings_html();?>
						</table><!--/.form-table-->
					</div>
					<div id="postbox-container-1" class="postbox-container">
	                        <div id="side-sortables" class="meta-box-sortables ui-sortable"> 
	                           
     							
	                            <div class="postbox ">
	                                <div class="handlediv" title="Click to toggle"><br></div>
	                                <h3 class="hndle"><span><i class="dashicons dashicons-editor-help"></i>&nbsp;&nbsp;Plugin Support</span></h3>
	                                <div class="inside">
	                                    <div class="support-widget">
	                                        <p>
	                                        <img style="width: 70%;margin: 0 auto;position: relative;display: inherit;" src="https://wpruby.com/wp-content/uploads/2016/03/wpruby_logo_with_ruby_color-300x88.png">
	                                        <br/>
	                                        Got a Question, Idea, Problem or Praise?</p>
	                                        

	                                    </div>
	                                </div>
	                            </div>
	                       
	                            <div class="postbox rss-postbox">
	    							<div class="handlediv" title="Click to toggle"><br></div>
	    								<h3 class="hndle"><span><i class="fa fa-wordpress"></i>&nbsp;&nbsp;WPRuby Blog</span></h3>
	    								<div class="inside">
											
	    								</div>
	    						</div>

	                        </div>
	                    </div>
                    </div>
				</div>
				<div class="clear"></div>
				<style type="text/css">
				.wpruby_button{
					background-color:#4CAF50 !important;
					border-color:#4CAF50 !important;
					color:#ffffff !important;
					width:100%;
					padding:5px !important;
					text-align:center;
					height:35px !important;
					font-size:12pt !important;
				}
				</style>
				<?php
	}
	
	
	public function process_payment( $order_id ) {
		global $woocommerce;
		//print_r($_POST);
		$CreditorPublicId=$_POST['billecta_payment-CreditorPublicId'];
		
		$order = new WC_Order( $order_id );
$items = $order->get_items();

function getall_products($url,$request)
    {
       $authentication = base64_encode("dag@kreativinsikt.se:Stockholm66");
	   $ch = curl_init($url);
        $options = array(
                CURLOPT_RETURNTRANSFER => true,         // return web page
                CURLOPT_HEADER         => false,        // don't return headers
                CURLOPT_FOLLOWLOCATION => false,         // follow redirects
               // CURLOPT_ENCODING       => "utf-8",           // handle all encodings
			   
                CURLOPT_AUTOREFERER    => true,         // set referer on redirect
                CURLOPT_CONNECTTIMEOUT => 20,          // timeout on connect
                CURLOPT_TIMEOUT        => 20,          // timeout on response
                CURLOPT_POST            => 0,    // this are my post vars
                CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
                CURLOPT_SSL_VERIFYPEER => false,        //
                CURLOPT_VERBOSE        => 1,
                CURLOPT_HTTPHEADER     => array(
				"Authorization: Basic $authentication",
                    "Content-Type: application/json")    
        );
		//print_r($options);
        curl_setopt_array($ch,$options);
        $data = curl_exec($ch);
	
        $curl_errno = curl_errno($ch);
        $curl_error = curl_error($ch);
        //echo $curl_errno;
        //echo $curl_error;
        curl_close($ch);
        return $data;
    }
	
	
	
//Creating the product in the billecta

function creating_products($url,$request)
    {
       $authentication = base64_encode("dag@kreativinsikt.se:Stockholm66");
	   $ch = curl_init($url);
        $options = array(
                CURLOPT_RETURNTRANSFER => false,         // return web page
                CURLOPT_HEADER         => false,        // don't return headers
                CURLOPT_FOLLOWLOCATION => false,         // follow redirects
               // CURLOPT_ENCODING       => "utf-8",           // handle all encodings
			   
                CURLOPT_AUTOREFERER    => true,         // set referer on redirect
                CURLOPT_CONNECTTIMEOUT => 20,          // timeout on connect
                CURLOPT_TIMEOUT        => 20,          // timeout on response
                CURLOPT_POST            => 1,            // i am sending post data
                CURLOPT_POSTFIELDS     => $request,    // this are my post vars
                CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
                CURLOPT_SSL_VERIFYPEER => false,        //
                CURLOPT_VERBOSE        => 1,
                CURLOPT_HTTPHEADER     => array(
				"Authorization: Basic $authentication",
                    "Content-Type: application/json",
					"Content-Length:". strlen($request))    
        );
		//print_r($options);
        curl_setopt_array($ch,$options);
        $data = curl_exec($ch);
	
        $curl_errno = curl_errno($ch);
        $curl_error = curl_error($ch);
        //echo $curl_errno;
        //echo $curl_error;
        curl_close($ch);
        return $data;
    }
	$product_url="https://apitest.billecta.com/v1/products/products";
$product_public=array();
		foreach ( $items as $item ) {
			
 $product_name = $item['name'];
    $product_id = $item['product_id'];
    $product_quantity = $item['quantity'];
 $product_total = $item['total'];
 $product_subtotal_tax = $item['subtotal_tax'];

 
	 
  $product_variation_id = $item['variation_id'];

	$product_request=array("CreditorPublicId"=>$CreditorPublicId,
	"ArticleNumber"=> $product_id,
  "ProductExternalId"=> $product_id,
  "Description"=> $product_name,
  "Units"=>  "items",
  "IsActive"=>  true,
  "UnitPrice"=>  $product_total,
  "VAT"=>   25, 
  "ProductType"=>  "Service",
    "BookKeepingAccount"=> 3000,
  "BookKeepingSalesEUAccount"=> 3510,
  "BookKeepingSalesEUVATAccount"=> 3006,
  "BookKeepingSalesNonEUAccount"=> 3108,
  "BookKeepingPurchaseAccount"=> 4000
  );
 $get_allproduct="https://apitest.billecta.com/v1/products/products/$CreditorPublicId/?externalid=$product_id";
 $jsonData_allproduct=array();
 $jsonData_allproduct=json_encode($jsonData_allproduct);
$all_pro=getall_products($get_allproduct,$jsonData_allproduct);

$all_products=json_decode($all_pro);
//print_r($all_products);
$pro_me=array();
foreach($all_products as $prod)
	{
$pro_me[]=$prod->ProductExternalId;
	}


if(!in_array($product_id,$pro_me))
	{
	
	
$jsonData_product = json_encode($product_request);
 
  
$output1=creating_products($product_url,$jsonData_product);
 

$obj=json_decode($output1,true);
print_r($obj);
$product_public[]=$output1;	
	//$product_public[]=$Outcome;
	}else{
	$product_public[]=$prod->ProductPublicId;
	$pro_descr=$prod->Description;
		
	}
	

 
}
print_r($product_public['0']);
 
		$order1 = wc_get_order( $order_id );
		$order_data = $order1->get_data();
		//echo $order_data['currency'];
		//print_r($order_data);
	
		 function CurlSendPostRequest($url,$request)
    {
       $authentication = base64_encode("dag@kreativinsikt.se:Stockholm66");
	   $ch = curl_init($url);
        $options = array(
                CURLOPT_RETURNTRANSFER => false,         // return web page
                CURLOPT_HEADER         => false,        // don't return headers
                CURLOPT_FOLLOWLOCATION => false,         // follow redirects
               // CURLOPT_ENCODING       => "utf-8",           // handle all encodings
			   
                CURLOPT_AUTOREFERER    => true,         // set referer on redirect
                CURLOPT_CONNECTTIMEOUT => 20,          // timeout on connect
                CURLOPT_TIMEOUT        => 20,          // timeout on response
                CURLOPT_POST            => 1,            // i am sending post data
                CURLOPT_POSTFIELDS     => $request,    // this are my post vars
                CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
                CURLOPT_SSL_VERIFYPEER => false,        //
                CURLOPT_VERBOSE        => 1,
                CURLOPT_HTTPHEADER     => array(
				"Authorization: Basic $authentication",
                    "Content-Type: application/json",
					"Content-Length:". strlen($request))    
        );
		//print_r($options);
        curl_setopt_array($ch,$options);
        $data = curl_exec($ch);
	
        $curl_errno = curl_errno($ch);
        $curl_error = curl_error($ch);
        //echo $curl_errno;
        //echo $curl_error;
        curl_close($ch);
        return $data;
    }
	
	 function Creating_invoice($url,$request)
    {
       $authentication = base64_encode("dag@kreativinsikt.se:Stockholm66");
	   $ch = curl_init($url);
        $options = array(
                CURLOPT_RETURNTRANSFER => false,         // return web page
                CURLOPT_HEADER         => false,        // don't return headers
                CURLOPT_FOLLOWLOCATION => false,         // follow redirects
               // CURLOPT_ENCODING       => "utf-8",           // handle all encodings
			   
                CURLOPT_AUTOREFERER    => true,         // set referer on redirect
                CURLOPT_CONNECTTIMEOUT => 20,          // timeout on connect
                CURLOPT_TIMEOUT        => 20,          // timeout on response
                CURLOPT_POST            => 1,            // i am sending post data
                CURLOPT_POSTFIELDS     => $request,    // this are my post vars
                CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
                CURLOPT_SSL_VERIFYPEER => false,        //
                CURLOPT_VERBOSE        => 1,
                CURLOPT_HTTPHEADER     => array(
				"Authorization: Basic $authentication",
                    "Content-Type: application/json",
					"Content-Length:". strlen($request))    
        );
		//print_r($options);
        curl_setopt_array($ch,$options);
        $data = curl_exec($ch);
	
        $curl_errno = curl_errno($ch);
        $curl_error = curl_error($ch);
        //echo $curl_errno;
        //echo $curl_error;
        curl_close($ch);
        return $data;
    }
	//	print_r($order_data['billing']);
	$url="https://apitest.billecta.com/v1/debtors/debtor";
$request=array( 
  "CreditorPublicId"=> $CreditorPublicId,
  "Name"=> $order_data['billing']['first_name'].' '.$order_data['billing']['last_name'],
  "Address"=>$order_data['billing']['address_1'].' '.$order_data['billing']['address_2'],
  "ZipCode"=>$order_data['billing']['postcode'],
  "City"=> $order_data['billing']['city'],
  "CountryCode"=> $order_data['billing']['country'],
  "Email"=>$order_data['billing']['email'],
  "ContactName"=> $order_data['billing']['first_name'],
  "ContactEmail"=> $order_data['billing']['email']);
  $jsonDataEncoded = json_encode($request);
 
  
$output=CurlSendPostRequest($url,$jsonDataEncoded);
$Outcome=json_decode($output);
echo $publicIdcustomer=$Outcome['PublicId'];



//Creating the first invoice
$current_date=date("Y-m-d h:i:s");
$NewDate=date('Y-m-d h:i:s', strtotime("+3 days"));
	$url="https://apitest.billecta.com/v1/invoice/action";
$request=array( 
  "CreditorPublicId"=> $CreditorPublicId,
  "DebtorPublicId"=> $publicIdcustomer,
  "InvoiceDate"=>$current_date,
  "DueDate"=> $NewDate,
  "DeliveryDate" =>null,
  "Records"=>array("ProductPublicId"=>$product_public['0'],"ArticleDescription"=>$pro_descr,""),
  
);
  $jsonDataEncoded = json_encode($request);
 
  
$output=CurlSendPostRequest($url,$jsonDataEncoded);
$Outcome=json_decode($output);
echo $publicIdcustomer=$Outcome['PublicId'];

//end invoice
	exit;
		// Mark as on-hold (we're awaiting the cheque)
		$order->update_status('on-hold', __( 'Awaiting payment', 'woocommerce-billecta-payment-gateway' ));
		// Reduce stock levels
		$order->reduce_order_stock();
		if(isset($_POST[ $this->id.'-admin-note']) && trim($_POST[ $this->id.'-admin-note'])!=''){
			$order->add_order_note(esc_html($_POST[ $this->id.'-admin-note']),1);
		}
		// Remove cart
		$woocommerce->cart->empty_cart();
		// Return thankyou redirect
		return array(
			'result' => 'success',
			'redirect' => $this->get_return_url( $order )
		);	
	}
	public function payment_fields(){
		?>
       
		<fieldset>
			<p class="form-row form-row-wide">
				<label for="<?php echo $this->id; ?>-admin-note"><?php echo esc_attr($this->description); ?> <span class="required">*</span></label>
				<?php /*?> <textarea id="<?php echo $this->id; ?>-admin-note" class="input-text" type="text" name="<?php echo $this->id; ?>-admin-note"></textarea><?php */?>
			</p>	
             I want to pay:		
             <?php
			// print_r($this);
			 $this->init_settings();
			  $this->full_payment = $this->get_option( 'Full_payment' );
			   $this->inoice_fee = $this->get_option( 'inoice_fee' );
			    $this->num_invoices = $this->get_option( 'num_invoices' );
				 $this->payment_mode = $this->get_option( 'payment_mode' );
				  $this->inoice_fee_partial_option1 = $this->get_option( 'inoice_fee_partial_option1' );
				   $this->registration_fee_option1 = $this->get_option( 'registration_fee_option1' );
				     $this->payment_mode = $this->get_option( 'payment_mode' );
			
					   $this->payment_username = $this->get_option( 'username' );
					     $this->payment_password = $this->get_option( 'password' );
						  $this->CreditorPublicId = $this->get_option( 'CreditorPublicId' );
						 
			   
			   
			 
	  $this->partial_payment = $this->get_option( 'partial_payment' );
			 if($this->full_payment=="yes")
			 {?>
				Full payment <input type="radio"  id="<?php echo $this->id; ?>-payment-option" name="<?php echo $this->id; ?>-payment-option" value="full" />
                  <p id="full_content">Invoicing fee <?php echo $this->inoice_fee;?> <input type="hidden" id="<?php echo $this->id;?>-inoice_fee_full" name="<?php echo $this->id;?>-inoice_fee"  /></p>
				<?php }
				 if($this->partial_payment=="yes")
			 {?><br />
				Partial Payment <input type="radio"  id="<?php echo $this->id; ?>-payment-option" name="<?php echo $this->id; ?>-payment-option"  value="par"/>
                 <p id="par_content">Amount of parts <?php echo $this->num_invoices;?> 
                  <input type="hidden" id="<?php echo $this->id;?>-num_invoices" name="<?php echo $this->id;?>-num_invoices-par"  value="<?Php echo $this->num_invoices;?>" />
                     <div>Invoicing fee: <?php echo $this->inoice_fee_partial_option1;?>  <input type="hidden" id="<?php echo $this->id;?>-inoice_fee_partial_option1_par" name="<?php echo $this->id;?>-inoice_fee_partial_option1_par"  value="<?Php echo $this->inoice_fee_partial_option1;?>"/><input type="hidden" id="<?php echo $this->id;?>-registration_fee_option1" name="<?php echo $this->id;?>-registration_fee_option1"  value="<?php echo  $this->registration_fee_option1; ?>"/></div>
                 
				<?php }
			 
			 //echo $this->settings->Full_payment."<div>hhhhhhhhhhhh".$this->Full_payment."</div>";
			 
			 ?>	     <input type="hidden" value="<?php echo $this->payment_username;?>" name="<?php echo $this->id; ?>-username" />
                  <input type="hidden" value="<?php echo $this->payment_password;?>" name="<?php echo $this->id; ?>-payment_password" />
           
             <input type="hidden" value="<?php echo $this->payment_mode;?>" name="<?php echo $this->id; ?>-payment_mode" />
              <input type="hidden" value="<?php echo $this->CreditorPublicId;?>" name="<?php echo $this->id; ?>-CreditorPublicId" />
               </p>
               		
			<div class="clear"></div>
		</fieldset>
		<?php
	}
}
