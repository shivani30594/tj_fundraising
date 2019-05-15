<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'libraries/PayPal-PHP-SDK/paypal/rest-api-sdk-php/sample/bootstrap.php'); // require paypal files
use PayPal\Api\ItemList;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;

class Customer extends CI_Controller {
    
    public $_api_context;

    public function __construct() {
        parent::__construct();
        //print(APPPATH);
          //print(BASEPATH);
        $this->load->model('customer_m');
        $this->load->model('user_m');
        $this->load->model('product_m');
        $this->load->model('payment_m');
        $this->load->model('order_m');
        $this->load->library('cart');
        $this->load->helper('email_helper'); 
        $this->load->model('fundraisierGroup_m');
        $this->load->model('groupUsers_m');
        if (!$this->session->userdata('user_for_customer'))
        {
            show_404(current_url());
        }
        $this->config->load('paypal');
        $this->_api_context = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $this->config->item('client_id'), $this->config->item('secret')
            )
        );
    }

    public function index($name = '', $code = '')
    {
        if($code)
        {
           $user_infor =  $this->user_m->get_by("referral_code = '$code' AND is_active = 'Yes'");
           if (isset($user_infor) AND count($user_infor) > 0)
           {    
                $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
                $this->data['subview'] = 'customer/init/index';
                $this->data['script'] = 'customer/init/script';
                $this->data['user_id'] = $user_infor[0]->user_id;
                $this->load->view('customer_layout_main', $this->data);
           }
           else{
               echo "your referral code if not valid or may be account is deactived of the user who sends you the link";
           }
        }
    }

    public function save()
    {
        if ($this->input->get())
        {
            $customer_info['first_name'] = $this->input->get('cust_first_name');
            $customer_info['last_name'] = $this->input->get('cust_last_name');
            $customer_info['email_id'] = $this->input->get('cust_email');
            $customer_info['user_id'] = $this->session->userdata('user_for_customer');
            $customer_info['street'] = $this->input->get('cust_street');
            $customer_info['city'] = $this->input->get('cust_city');
            $customer_info['state'] = $this->input->get('cust_state');
            $customer_info['zip'] = $this->input->get('cust_zip');
            // $customer_info['address'] = $this->input->get('cust_address');
            $customer_info['phone_number'] = $this->input->get('full_number');
            $customer_info['unique_id'] = generate_refferal_code(8);
            $found_cust = $this->customer_m->get_by("email_id = '".$customer_info['email_id']."'");
            if (count($found_cust) == 0)
            {
                $result = $this->customer_m->save($customer_info);
                if ($result)
                {
                    $this->session->set_userdata('customer_id', $this->db->insert_id());
                }
            }
            else
            {
                $this->session->set_userdata('customer_id', $found_cust[0]->customer_id);
            }
           
            $this->session->set_userdata('delivery_option', $this->input->get('shipping'));

            $users_group_details = $this->fundraisierGroup_m->get_by("user_id = ".$this->session->userdata("user_for_customer"));
            if (count($users_group_details) > 0)
            {
                if (date('Y-m-d H:i:s') > $users_group_details[0]->project_end)
                {
                    $this->session->set_flashdata("success","Your project was completed before some days. So, you are not able to order the item. Thanks!");
                    redirect("display_product");
                }
            }
            $group_info = $this->groupUsers_m->get_by("user_id = ".$this->session->userdata("user_for_customer")." AND is_accept = 'Yes'");
            if (count($group_info) > 0)
            {
                $group_details = $this->fundraisierGroup_m->get($group_info[0]->group_id);
                if (date('Y-m-d H:i:s') > $group_details->project_end)
                {
                    $this->session->set_flashdata("success","Your project was completed before some days. So, you are not able to order the item. Thanks!");
                    redirect("display_product");
                }
            }
            $fedex_total = 0;
            if ($this->input->get('shipping') == 'delivered_fedex')
            {
                $this->load->library('Fedex');
                $response = $this->fedex->create($customer_info);
                // echo "<pre>";
                // print_r($response);
                // die;
                if ($response->error != '')
                {
                    $this->session->set_flashdata('success', $response->error['message']);
                    redirect("display_product");
                }
                $serviceArray = array();
                $i = 0;
                foreach($response->rates as $key=>$value)
                {
                    if ($value['carrier'] == 'FedEx')
                    {
                        $serviceArray[$i]['service'] = $value['service'];
                        $serviceArray[$i]['rate'] = $value['rate'];
                        if ($value['delivery_date'] == null)
                        {
                            $serviceArray[$i]['delivery_date'] = date('Y-m-d H:i:s', strtotime('+1 day'));
                        }
                        else{
                            $serviceArray[$i]['delivery_date'] = $value['delivery_date'];
                        }
                        $i++;
                    }
                }

                foreach($response->fees as $key=>$value)
                {
                    if ($value['type'] == 'PostageFee')
                    {
                       $postage_fee = $value['amount'];
                    }
                }
                // print_r($serviceArray);
                $fedex_rate = min(array_column($serviceArray, 'rate'));
                // echo $fedex_rate;
                
                $key  = array_search($fedex_rate,array_column($serviceArray, 'rate'));
                // echo $key;
                // echo date('Y-m-d H:i:s',strtotime($serviceArray[$key]['delivery_date']));
                // die;

                $updated_fees = $fedex_rate + $postage_fee;

                $this->session->set_userdata('delivery_date', date('Y-m-d H:i:s',strtotime($serviceArray[$key]['delivery_date'])));
            }
            else{
                $this->session->set_userdata('delivery_date', date('Y-m-d H:i:s',strtotime($this->input->get('delivery_date'))));
            }
            $this->create_payment_with_paypal($updated_fees);
        }
        // redirect('display_product');
    }

    public function create_payment_with_paypal($fedex_total = 0)
    {
        // setup PayPal api context
        $this->_api_context->setConfig($this->config->item('settings'));
        // ### Payer
        // A resource representing a Payer that funds a payment For direct credit card payments, set payment method to 'credit_card' and add an array of funding instruments.
        $payer['payment_method'] = 'paypal';
    
        $cart_info = $this->cart->contents();
        $itemList = new ItemList();
        $Subtotal = 0;
        $i = 0;
        foreach($cart_info as $key=>$cart)
        {
            $item[$i]["name"]= $cart['name'];
            $item[$i]["sku"]= $cart['id'];  
            $item[$i]["description"]= $cart['description'];  
            $item[$i]["currency"] ="USD";
            $item[$i]["quantity"]= $cart['qty'];  
            $item[$i]["price"]= number_format((float)$cart['price'], 2, '.', ''); 
            $i++;
            $Subtotal = $Subtotal + $cart['subtotal'];
        }
        $itemList->setItems($item);
       
        // ### Additional payment details Use this optional field to set additional payment information such as tax, shipping charges etc.
        $details['tax'] = 0;
        $details['shipping'] = number_format((float)$fedex_total, 2,'.','');
        // $details['postagefee'] = 2.90;
        $details['subtotal'] =  number_format((float)$Subtotal, 2, '.', ''); 

        // ### Amount Lets you specify a payment amount. You can also specify additional details such as shipping, tax.
        $amount['currency'] = "USD";
        $amount['total'] = number_format((float)(number_format((float)$details['tax'], 2,'.','') + number_format((float)$fedex_total, 2,'.','') +number_format((float)$Subtotal, 2,'.','')) , 2,'.',''); 
        $amount['details'] = $details;

        // ### Transaction A transaction defines the contract of a payment - what is the payment for and who is fulfilling it.
        $transaction['description'] ='Payment description';
        $transaction['amount'] = $amount;
        $transaction['invoice_number'] = uniqid();
        $transaction['item_list'] = $itemList;

        // ### Redirect urls Set the urls that the buyer must be redirected to after payment approval/ cancellation.

        $baseUrl = base_url();
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(BASE_URL."customer/customer/getPaymentStatus")
            ->setCancelUrl($baseUrl."customer/customer/getPaymentStatus");

        // ### Payment A Payment Resource; create one using the above types and intent set to sale 'sale'
        $payment = new Payment();
        // print_r($transaction);
        // die;
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        
        try {
            $payment->create($this->_api_context);
            $payment_id = $payment->id;
            $payment_info["payment_id"] = $payment_id;
            $this->payment_m->save($payment_info);
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $ex);
            exit(1);
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        if(isset($redirect_url)) {
            /** redirect to paypal **/
            redirect($redirect_url);
        }
        $this->session->set_flashdata('success_msg','Unknown error occurred');
        redirect('checkout');
    }

    public function display_product()
    {
        $search_text = "";
        if($this->input->post('submit') != NULL ){
            $search_text = $this->input->post('search_keyword');
            $this->session->set_userdata(array("search_text"=>$search_text));
        }else{
            if($this->session->userdata('search_text') != NULL){
                $search_text = $this->session->userdata('search_text');
            }
        }
        $total_row = count($this->product_m->get_by("product_name LIKE '%$search_text%' OR product_description LIKE '%$search_text%' OR nutrition_facts LIKE '%$search_text%'"));
        $config["base_url"] = base_url() . "display_product";
        $config["total_rows"] = $total_row;
        $config["per_page"] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 2;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = '&gt;';
        $config['prev_link'] = '&lt;';
        $config['first_link'] = '&lt;&lt;';
        $config['last_link'] = '&gt;&gt;';

        $this->pagination->initialize($config);

        if($this->uri->segment(2)){
            $page = ($this->uri->segment(2) - 1) ;
        }
        else{
             $page = 0;
        }

        $this->session->set_userdata('search_text', $search_text);
        $relation = array(
            "fields" => "*",
            "conditions" => "product_name LIKE '%$search_text%' OR product_description LIKE '%$search_text%' OR nutrition_facts LIKE '%$search_text%'"
        );
        $this->data['search_keyword'] = $search_text;
        $relation['LIMIT']['start'] = $config["per_page"];
        $relation['LIMIT']['end'] =   $config["per_page"] * $page;
        $this->data["product_details"] = $this->product_m->get_relation('', $relation, false);
        // echo $this->db->last_Query();
        // die;
        $str_links = $this->pagination->create_links();
        $this->data["links"] = explode('&nbsp;',$str_links );
        // cart details
        $this->calculate_info();
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'customer/product_list/index';
        $this->data['script'] = 'customer/product_list/script';
        $this->load->view('customer_layout_main', $this->data);  
    }


    public function getPaymentStatus()
    {
        $payment_id = $this->input->get("paymentId") ;
        $PayerID = $this->input->get("PayerID") ;
        $token = $this->input->get("token") ;
       
        if (empty($PayerID) || empty($token)) {
            $this->session->set_flashdata('success_msg','Payment failed');
            redirect("checkout");
        }
        $payment = Payment::get($payment_id,$this->_api_context);

        /** PaymentExecution object includes information necessary to execute a PayPal account payment.The payer_id is added to the request query parameters  when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId($this->input->get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution,$this->_api_context);

        //  DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') 
        {
            $trans = $result->getTransactions();
            $this->db->set('payment_id',$payment_id);
            $this->db->set('payer_id',$PayerID);
            $this->db->set('token',$token);
            $this->db->set('subtotal',$trans[0]->getAmount()->getDetails()->getSubtotal());
            $this->db->set('tax',$trans[0]->getAmount()->getDetails()->getTax());
            $payer = $result->getPayer();
            $this->db->set('payment_method',$payer->getPaymentMethod());
            $this->db->set('payment_status',$payer->getStatus());
            $this->db->set('payer_mail',$payer->getPayerInfo()->getEmail());
            $relatedResources = $trans[0]->getRelatedResources();
            $sale = $relatedResources[0]->getSale();
            $this->db->set('sale_id',$sale->getId());
            $this->db->set('created_time',$sale->getCreateTime());
            $this->db->set('updated_time',$sale->getUpdateTime());
            $this->db->set('state',$sale->getState());
            $this->db->set('total',$sale->getAmount()->getTotal());
            $this->db->where('payment_id',$payment_id);
            $result = $this->db->update('tj_payment');
            if ($result == 1)
            {
                $payment_info = $this->payment_m->get_by("payment_id = '$payment_id'");
                $order_id = $this->place_order($payment_info[0]->transaction_id);
                $this->cart->destroy();
                // $this->send_mail_to_admin();
                $this->send_mail($order_id, $this->session->userdata("delivery_option"));
                $this->session->unset_userdata("delivery_option");
            }

            $this->session->set_flashdata('success','Payment will successfully done. You will get order as soon as possible.Happy Fundraising !!!');
            redirect('display_product');
        }
        $this->session->set_flashdata('danger','Payment failed');
    }

    public function place_order($transaction_id)
    {
        $this->calculate_info();
        $cart_info = $this->cart->contents();
        $order_info['order_id'] = 'ORD'.strtotime("now");
        $order_info['order_status'] = 'pending';
        $order_info['order_total'] = $this->data['total_amount'];
        $order_info['order_quantity'] =  $this->data['total_product'];
        $order_info['customer_id'] = $this->session->userdata("customer_id");
        $order_info['transaction_id'] = $transaction_id;
        $order_info['user_id'] = $this->session->userdata("user_for_customer");
        $order_info['order_details'] = json_encode($cart_info);
        $order_info['order_date'] = date('Y-m-d H:i:s', strtotime("now"));
        $order_info['delivery_date'] = date('Y-m-d H:i:s', strtotime($this->session->userdata("delivery_date")));
        $order_info['delivery_option'] = $this->session->userdata("delivery_option");
        $this->order_m->save($order_info);
        $this->session->unset_userdata("delivery_date");
        return $order_info['order_id'];
    }
    
    public function calculate_info()
    {
        $cart_info = $this->cart->contents();
        $total_amount = 0;
        $total_product = 0;
        if (count($cart_info) > 0)
        {
            foreach( $cart_info as $id => $cart)
            {	
                $total_amount = $total_amount + $cart['subtotal'];
                $total_product = $total_product + $cart['qty'];
            }
        }
        $this->data['total_amount'] =  number_format((float)$total_amount, 2, '.', '');
        $this->data['total_product'] = $total_product;
    }

    public function view($id = '')
    {
        if ($id)
        {
            $this->calculate_info();
            $this->data['product_details'] = $this->product_m->get($id);
            $relation = array(
                "fields" => "*",
                "conditions" => " order_details LIKE '%". $this->data['product_details']->product_name."%' AND (ratings != 0 OR comment != '')"
            );
            $this->data['total_reviews'] = $this->order_m->get_relation('',$relation, true);
            $relation = array(
                "fields" => "avg(ratings) as star_ratings",
                "conditions" => "order_details LIKE '%". $this->data['product_details']->product_name."%' AND (ratings != 0)"
            );
            $this->data['starNumber'] = $this->order_m->get_relation('',$relation)[0]['star_ratings'];
            // $this->data['starNumber'] = 3.5;
            $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
            $this->data['subview'] = 'customer/product_list/view';
            $this->data['script'] = 'customer/product_list/script';
            $this->load->view('customer_layout_main', $this->data);  
        }
    }

    public function cart_details()
    {
        $this->data['cart_info'] = $this->cart->contents();
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'customer/product_list/cart_details';
        $this->data['script'] = 'customer/product_list/script';
        $this->calculate_info();
        $this->load->view('customer_layout_main', $this->data);  
    }

    public function add_prod()
	{
        $name = preg_replace('/[^A-Za-z0-9\-]/', ' ',$this->input->post('name')); // Removes special chars.
        $insert_data = array(
            'id' => $this->input->post('id'),
            'name' =>$name ,
            'price' => $this->input->post('price'),
            'qty' => $this->input->post('quantity'),
            'description' => "dsfsf",
        );
        // echo "<pre>";
        // print_r($insert_data);
        $this->cart->insert($insert_data);
        $cart_info = $this->cart->contents();
        // print_r($cart_info);
        // die;
        redirect('display_product');
    }
    
    public function delete_prod($id = '')
    {
        if ($id)
        {
            $this->cart->remove($id);
            redirect('cart_details');
        }
    }

    public function checkout()
    {
        $this->calculate_info();
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'customer/init/index';
        $this->data['script'] = 'customer/init/script';
        $this->load->view('customer_layout_main', $this->data);  
    }

    public function send_mail($order_id, $delivery_option)
    {
        $customer_id = $this->session->userdata('customer_id');
        $customer_info = $this->customer_m->get($customer_id);
        $order_details = $this->order_m->get($order_id);
        $relation = array(
            "fields" => "*",
            "conditions" => "order_id ='".$order_id."'"
        );
        $order_details = $this->order_m->get_relation('',$relation);
        $order_details_array = json_decode($order_details[0]['order_details']);
        $product_details = '';
        $Subtotal = 0;
        foreach($order_details_array as $order){
               $product_details .=  "Product Name:". $order->name."<br />";
               $product_details .=  "Quantity:". $order->qty."<br />";
               $product_details .=  "Price:". $order->price."<br /><br />";
               $Subtotal = $Subtotal + $order->subtotal;
        }
        $subject = "Our Order ".$order_id." has been successfully placed";
        $body = "<p>Hello ".$customer_info->first_name.",</p>";
        if ($delivery_option == "pickup")
        {
            $body .= "<p>Thank you for your order. We&rsquo;ll pickup the product on and after delivery date (".date('j, F Y',strtotime($order_details[0]['delivery_date'])).").To view the order details, please visit <a href='".BASE_URL.'my_orders/'.$customer_info->unique_id."'>Your Orders</a>.";
        }
        else
        {
            $body .= "<p>Thank you for your order. We&rsquo;ll deliver the product before delivery date.To view the order details, please visit <a href='".BASE_URL.'my_orders/'.$customer_info->unique_id."'>Your Orders</a>.";
        }
        $body .="<br /><br />
                Order Details:<br />
                Order #".$order_id."<br />
                Placed on ".date('j, F Y',strtotime($order_details[0]['order_date']))."<br /><br />
               ".$product_details."
                --------------------------------<br />
                Item Total: $ ".$Subtotal."<br />
                Shipping &amp; Handling : $ 0.00<br />
                Promotion Applied : $ 0.00<br />
                --------------------------------<br />
                Order Total : $ ".$Subtotal."</p>
                <p>You may contact to salesperson for order cancellation by clicking on <a href='".BASE_URL.'cancel/'.$order_id."'>Cancel order</a></p>";
        if ($delivery_option == "pickup")
        {
            $body .="<p>You can pickup the order on ".date('j, F Y',strtotime($order_details[0]['delivery_date'])).".<br /><br />We hope to see you again soon. <br /><strong>TJ's Fundraising Company</strong><br /><br /></p>";
        }
        else
        {
            $body .= "<p>Your order will be delivered on ".date('j, F Y',strtotime($order_details[0]['delivery_date'])).".<br /><br />We hope to see you again soon. <br /><strong>TJ's Fundraising Company</strong><br /><br /></p>";
        }
        send_mail_to_admin($customer_info->email_id, $subject, $body);
        $subject = "Order ".$order_id." has been successfully placed";
        $body = "<p>Hello Admin,</p>
                <p>New order is placed by ".$customer_info->first_name.".<br /><br />
                Order Details:<br />Order #".$order_id."<br />
                Placed on ".date('l, F Y',strtotime($order_details[0]['order_date']))."<br /><br />
                ".$product_details."
                --------------------------------<br />
                Item Total: $  ".$Subtotal."<br />
                Shipping &amp; Handling : $ 0.00<br />
                Promotion Applied : $  ".$Subtotal."<br />
                --------------------------------<br />
                Order Total : $ ".$Subtotal."</p>
                <p>We have to delivered the order on ".date('l, F Y',strtotime($order_details[0]['delivery_date'])).".<br /><br />
                Thanks<br /><br /></p>";
        send_mail_to_admin(ADMIN_MAIL, $subject, $body);

    }


}