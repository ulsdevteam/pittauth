<?php
namespace App\Controller\Component;
use Cake\Controller\Component;
use Cake\Core\Configure;
class LdapComponent extends Component{
    /*
     * getInfo method
     *
     * First we connect to the LDAP server by providing the LDAP server name,
     * after which we bind to that connection made by providing the
     * LDAP username and password, after which we pass in the search queries
     * for the particular username, and if found we enter the information in the
     * $info array and return this array.
     *
     * @param String $user , username which has to be searched.
     * @return Array $info , info array which consists of First Name, Last Name,
     *  Email, department.
     *
     */


     public static function getInfo($user){
         //$connection = Configure::read('Security.ldap.host');
         //$ldapcfg = $connection->config();
         //check if user is an object first
       //this works for 4 cases: $user is not in AD, $user is not a PittAuth user or admin, $user is a PittAuth user, $user is a PittAuth admin
       $attributes = array('givenName','sn','memberof');
       $filter = "(cn=$user)";
       $ldapUser = Configure::read('Security.ldap.username');
       $ldappassword = Configure::read('Security.ldap.password');
       $ldapServer = Configure::read('Security.ldap.host');//$ldapcfg['host'];
       $ldapPort = Configure::read('Security.ldap.port');
       $ldap = ldap_connect($ldapServer)
         or die("Could not connect to $ldapServer");
       $ldapbind=ldap_bind($ldap, $ldapUser, $ldappassword);
       $baseDN = Configure::read('Security.ldap.baseDN');
       if (ldap_bind($ldap, $ldapUser, $ldappassword)){
         $result = ldap_search($ldap, $baseDN, $filter,$attributes);
         $array = ldap_get_entries($ldap, $result);
         if ($array['count']>0){
           //are they a regular user?
           $attributes = array('memberof');
           $filter = Configure::read('Security.ldap.userfilter');
           $ldap = ldap_connect($ldapServer)
            or die("Could not connect to $ldapServer");
            $ldapbind=ldap_bind($ldap, $ldapUser, $ldappassword);
            //we are using $user as the starting point for the search, so the preceding query ensures a valid Pitt username for use in this statement
            $baseDN = "cn=$user," . Configure::read('Security.ldap.baseDN');
            if (ldap_bind($ldap, $ldapUser, $ldappassword)){
              $result = ldap_search($ldap, $baseDN, $filter,$attributes);
              $array = ldap_get_entries($ldap, $result);
              if ($array['count']>0){
                return 'user';
              }
            else{
              //or an admin?
              $filter = Configure::read('Security.ldap.adminfilter');
              $ldap = ldap_connect($ldapServer)
                or die("Could not connect to $ldapServer");
              if (ldap_bind($ldap, $ldapUser, $ldappassword)){
                $result = ldap_search($ldap, $baseDN, $filter,$attributes);
                $array = ldap_get_entries($ldap, $result);
                if ($array['count']>0){
                 return 'admin';
                }
              }
            }
           //else return false. $user is a Pitt affiliate, but not a PittAuth user or admin.
            }
         }
       }
     }
   }
?>
