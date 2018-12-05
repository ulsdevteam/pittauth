<?php
namespace App\Controller\Component;
use Cake\Controller\Component;
class PasswordComponent extends Component{



     public static function generate(){ 

       return bin2hex(openssl_random_pseudo_bytes(4));

    }
   }
?>
