<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
use App\Utility\Clear;
use Cake\Core\Configure;
/**
 * Accounts Controller
 *
 * @property \App\Model\Table\AccountsTable $Accounts
 *
 * @method \App\Model\Entity\Account[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AccountsController extends AppController
{

  //allow regular users to use any action in this controller
  public function isAuthorized($user)
  {
    if (isset($user)) {
        return true;}
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->loadModel('Logs');
          $accounts = $this->paginate($this->Logs
           ->find()
           ->select()
           ->where(['cleared IS' => NULL])

         );

         $this->set(compact('accounts'));
         //new
         $user=$this->Auth->user();
         $this->set('user',$user);
    }

    /**
     * View method
     *
     * @param string|null $id Account id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {$this->loadModel('Logs');
      $account = $this->Logs->get($id, [
          'contain' => ['Accounts']
      ]);

      $this->set('account', $account);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
      if (Configure::read('Security.SuspendService')) {
        $this->Flash->error(__('The PittAuth Service is currently disabled.'));
        return $this->redirect(['action' => 'index']);
      }
      $this->loadModel('Logs');
        $subquery = $this->Logs->find()
          ->select(['username'])
          ->distinct()
          ->where(function (QueryExpression $exp, Query $q) {
            return $exp->isNull('cleared');});
   //return account usernames that are still in commission, but not already in use
        $this->loadModel('Accounts');
        $availableusernames = $this->Accounts
          ->find()
          ->select(['username','id'])
          ->distinct()
          ->where(['username NOT IN' => $subquery]);
   //we only need one
        $availableusernames = $availableusernames->first();
        //perhaps only useful if we are displaying the proposed username to the assigner.  if it's sniped it will be wrong
        $this->set(compact('availableusernames'));
   //Warn the user if there aren't any accounts available to assign before we let them fill out the form
   //Send them back to the index page where they can clear an account, freeing it up for a new assignment
        if ($availableusernames === null){
          $this->Flash->error(__('All accounts assigned. Clear an account to proceed'));
          return $this->redirect(['action' => 'index']);}
   //Tell the attached template, add.ctp, to get ready to take info for a new row in the Accounts table
        $account = $this->Logs->newEntity();
        //'log' is $log
        
   // use IdTypes table to populate choices for that field
        $this->loadModel('Idtypes');

        $idtypesarray=$this->Idtypes->find('list',[
            'keyField' => 'id',
            'valueField' => 'idtype'])
                ->where(['id >' => 0]);
        $this->set(compact('idtypesarray'));


    $this->set(compact('account'));
   //If and when the data is posted back from the form, splice in an available username if one is still free
        if ($this->request->is('post')) {
          $data = array_merge ($this->request->getData(),array('username'=>$availableusernames['username']),array('assigned_by'=>env('givenName').' '.env('sn').' ('.env('REMOTE_USER').')'));
          $account = $this->Logs->patchEntity($account, $data);
          //generate and set a password for the selected account
          $accountsTable = TableRegistry::get('Accounts');
          $accountupdate=$accountsTable->get($availableusernames['id']);
          //use the Password component to generate a new password for this account
          $this->loadComponent('Password');
          $pwd=$this->Password->generate();
          $accountupdate->password= $pwd;
          $accountsTable->save($accountupdate);




   //save the info as a new row in the account logs table
   //if it's successful, send the user back to the main screen
          if ($this->Logs->save($account)) {
            return $this->redirect(['action' => 'view',$account['id']]);

          }
            else {
              $this->Flash->error(__('The account could not be saved. Please, try again.'));
              debug($account->getErrors());}
            }
    }

    /*
     * @param $username string Username to clear
     * @return \Cake\Http\Response
     **/
    public function clear($username = null){  
//insert 'cleared' value into logs table with Clear utility
        
        //take the account username from the template
        //find all accounts that contain logs with a matching username where cleard == null
        //return a query object with the log id, log username if found
        $accounts = $this->Accounts->find('all')->where(['username' => $username])->contain('Logs', function (Query $q) {
            return $q
                ->select(['Logs.id', 'Logs.username'])
                ->where(['cleared IS' => null]);
            }
        );
        //ensure we're only getting one result.  
        $account = $accounts->first();
        
        //as long as there is a matching account name, send an array of log usernames to the Clear utility
        if ($account){
            Clear::clear([$account->username]);
        } else {
              $this->Flash->error(__('The account could not be cleared. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }



}
