<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fedex {
	//public function My_PHPMailer()
	public function __construct()
    {
        require_once('Easypost/easypost.php');
        // \EasyPost\EasyPost::setApiKey('EZAKb04666e2920f4285bdb32173e7557e5fF3fGOwKLu3Wr6YkvtyGX9g'); // client account live key
        // \EasyPost\EasyPost::setApiKey('EZTKb04666e2920f4285bdb32173e7557e5fRYU1y0a48NUshiLZZEaHAg'); // client account test key
        // \EasyPost\EasyPost::setApiKey('EZTK3366ec9a8850485fb773917e4aff471a3LSqKWNUooT93Kisad8nZA'); // <shp@narola class="email"></shp@narola>
        \EasyPost\EasyPost::setApiKey('EZTKb04666e2920f4285bdb32173e7557e5fRYU1y0a48NUshiLZZEaHAg'); // <leith tumer test account class="email"></shp@narola>
    
      }

    public function create($customer_info)
    {
        $shipment = \EasyPost\Shipment::create(array(
            'to_address' => array(
              "name"    => $customer_info['first_name'].' '.$customer_info['last_name'],
              "street1" => $customer_info['street'],
              "city"    => $customer_info['city'],
              "state"   => $customer_info['state'],
              "zip"     => $customer_info['zip'],
              "phone"   => $customer_info['phone_number']
            ),
            // 'to_address' => array(
            //   "name"    => "Dr. Steve Brule",
            //   "street1" => "2000 Freight LTL Testing",
            //   "city"    => "Harrison",
            //   "state"   => "AR",
            //   "zip"     => "72601",
            //   "phone" => "9899798798"
            // ),
            'from_address' => array(
              "company" => FROM_COMPANY,
              "street1" => FROM_STREET1,
              "street2" => FROM_STREET2,
              "city"    => FROM_CITY,
              "state"   => FROM_STATE,
              "zip"     => FROM_ZIP,
              "phone"   => FROM_PHONE
            ),
            // 'from_address' => array(
            //   "company" => "EasyPost",
            //   "street1" => "1202 Chalet Ln",
            //   "street2" => "Do Not Delete - Test Account",
            //   "city"    => "Harrison",
            //   "state"   => "AR",
            //   "zip"     => "72601",
            //   "phone" => '90909999900'
            // ),
            'parcel' => array(
              'length' => 5,
              'width' => 4,
              'height' => 4,
              'weight' => 200
            ),
          ));
          return $shipment->buy($shipment->lowest_rate("FedEx"));
    }
}