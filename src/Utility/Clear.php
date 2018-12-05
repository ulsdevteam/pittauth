<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Utility;
use Cake\ORM\TableRegistry;
use Cake\ORM\Query;
use Cake\I18n\Time;

class Clear{
	/*
	 * @param $range array() Array of usernames to clear
	 */
    public static function clear($range = null)
    {
        if (!$range) {
            return;
        }
   //clear each password RANGE COMES FROM LOGS SO THOSE IDS ARE NOT THE ACCOUNTS ONES MAP THEM
    
      $accountsTable = TableRegistry::get('Accounts');
        
        $accountsToResetPassword = $accountsTable->find()->where(['username' => $range], ['username' => 'string[]'])->contain('Logs', function (Query $q) {
            return $q
                ->select(['Logs.id', 'Logs.username'])
                ->where(['cleared IS' => null]);
        });
                
        foreach ($accountsToResetPassword as $account) {
            //generate a random password       
            $pwd=bin2hex(openssl_random_pseudo_bytes(4));
            $account->password =   $pwd;
            if ($accountsTable->save($account)) {
                //fetch the Logs model 
                $logsTable = TableRegistry::get('Logs');
                $accountsToClear=$logsTable->find('all')
                     ->where(['id' => $account->logs[0]->id]);
                $log = $accountsToClear->first();
                $log->cleared =   Time::now();
                $logsTable->save($log);
            }
            
        }
  }
} 
