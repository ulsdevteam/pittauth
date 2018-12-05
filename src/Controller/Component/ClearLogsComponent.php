<?php
namespace App\Controller\Component;
use Cake\Controller\Component;
class ClearLogsComponent extends Component{

//copied from accounts controller.  should take param for which records to clear?

     public static function clear(){ 

      $logsTable = TableRegistry::get('Logs');
        $log = $logsTable->get($id);
        $log->cleared =   Time::now();
        $logsTable->save($log);

    }
   }
?>