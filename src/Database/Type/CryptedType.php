<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace App\Database\Type;

use Cake\Database\Driver;
use Cake\Database\Type;
use Cake\Utility\Security;
use Cake\Core\Configure;



//check for encrypted id_number values and decrypt if found
class CryptedType extends Type
{
   
    //saving data
    public function toDatabase($value, Driver $driver)
    {
        return Security::encrypt($value, Configure::read('Security.id_numberKey'));
    }
//retrieving data
    public function toPHP($value, Driver $driver)
    {
        if ($value === null) {
            return null;
        }
        //try to decrypt
        try{
            $plaintext =  Security::decrypt($value, Configure::read('Security.id_numberKey'));
            if($plaintext == false){$plaintext = $value;}
        }
        //if that fails 
        catch (Exception $e){ 
            //let php know that the value is already plaintext
            $plaintext = $value;
           
        }
        return $plaintext;
    }
    
    
       
    public function marshal($value)
    {
        
        return $value;
    }
     
}