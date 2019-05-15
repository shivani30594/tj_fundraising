<?php
if (!function_exists('generate_referal_code')) {
    
    function generate_refferal_code($size = 12) {
        $seed = str_split('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'); // and any other characters
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $rand = '';
        foreach (array_rand($seed, $size) as $k)
            $rand .= $seed[$k];
        return $rand.config_item('encryption_key');
    }
}

if ( ! function_exists('save_notification'))
{    
    function save_notification($type, $description) 
    {
        $CI = & get_instance();
        $array = array(
            'type' => $type,
            'description' => $description
            );
        $result = $CI->db->insert('tj_notification',$array);
        return $result;
    }
}



