<?php
/** set your paypal credential **/
// Email: shp@narola.email
// $config['client_id'] = 'AUQJKMgS2MWkmXqbaSKzk8ov-wiZwpgqdcHe-Fy1OWSE284TWhTnAc0SKZzLoU-iDsf2Z9iZz8mQ8AEv';
// $config['secret'] = 'EDvE9PCFaXyRjJLZzYqr_qUsxFuxvH-qBwfLkvnjCHYQHXWqTPTPVt-2f9FnWelbORA3zH6w41vKMSfo';

// Email: mailfortjones-facilitator@gmail.com
$config['client_id'] = 'AcYZJkYxWSTn2lRu5v2XZfDwXqRORJ0futJqY3M7jAkv-oxmgocPN7kfTwMU2L5KLfn_3mpP8c-Jwxh6';
$config['secret'] = 'ELybsWJ_MTRTqcNyvM8VlE1_A643QbDZj9Kf8DcvEbxWGMMGCBQzF81isHhFatXaQvcqXg560yUPPe1-';

/**
 * SDK configuration
 */
/**
 * Available option 'sandbox' or 'live'
 */
$config['settings'] = array(

    'mode' => 'sandbox',
    /**
     * Specify the max request time in seconds
     */
    'http.ConnectionTimeOut' => 1000,
    /**
     * Whether want to log to a file
     */
    'log.LogEnabled' => true,
    /**
     * Specify the file that want to write on
     */
    'log.FileName' => 'application/logs/paypal.log',
    /**
     * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
     *
     * Logging is most verbose in the 'FINE' level and decreases as you
     * proceed towards ERROR
     */
    'log.LogLevel' => 'FINE'
);
