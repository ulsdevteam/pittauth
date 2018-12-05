<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;


/**
 * NightlyCleanup shell command.
 */
class NightlyCleanupShell extends Shell
{
    
      public function initialize()
    {
        parent::initialize();
        $this->loadModel('Accounts');
        $this->loadModel('Logs');
    }

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        $this->out($this->OptionParser->help());
    }
    
    
    
    public function purgeOldLogs()
    {
        //fetch the Logs model so we can reference it with $this
        $this->loadModel('Logs');
        //we want to purge logs older than 1 year, so get today's date
        $now = Time::now();
        //use Cake's built in date manipulation method and then format the date to match the datetime entries in Logs.created 
        $purgeDate = $now->subDays(365)->i18nFormat('yyyy-MM-dd');
        //delete all log records older than the $purgedate
        $this->Logs->deleteAll(['created <'=> $purgeDate]);
        
       
    }
    /*
     * Clear all active accounts; resets account password and clears log entry via helper class
     */
    
    
        public function resetAccounts()
    {
  //send array of log usernames to Clear where log is null
         
         
        $logs = $this->Logs->find('all')
                ->where(['cleared IS' => NULL]);
        $usernameRange = [];
        
        
       //iterate the query object to find accounts to clear and build the array we'll send to Clear
        foreach ($logs as $log){
            $hasAccount=$this->Accounts->find('all')
                    ->where(['username' => $log->username]);
            
            //make sure the log has a corresponding account username in the accounts table
            if ($hasAccount->count()>0){
            $usernameRange[]=$log->username;
            }
                      
                      
        }
        
       \App\Utility\Clear::clear($usernameRange);
        
        
    }
   
  
    
    
    
        public function deleteAllLogs()
    {
        //fetch the Accounts model so we can reference it with $this
        $this->loadModel('Logs');
        
        $this->Logs->deleteAll(['id >'=> 0]);
        
        
    }
    
    
}
