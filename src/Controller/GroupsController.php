<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Groups Controller
 *
 * @property \App\Model\Table\GroupsTable $Groups
 *
 * @method \App\Model\Entity\Group[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

class GroupsController extends AppController
{

  public function beforeFilter(Event $event)
      {
          parent::beforeFilter($event);
          // Allow users to register and logout.
          // You should not add the "login" action to allow list. Doing so would
          // cause problems with normal functioning of AuthComponent.
          $this->Auth->allow(['logout']);
      }


//disable app timeout and log out of Passport session by closing browser
     public function login($id = null)
     {


         //Pitt Passport sets an environment variable with Pitt username on success
         $id= env('REMOTE_USER');
         //run the username through the Ldap component's getInfo method and return whether they are an admin or regular user
         $group=$this->Ldap->getInfo($id);

         //Admin user
         if ($group==='admin'){
           $this->Auth->setUser('admin');
           $this->redirect(array("controller" => "Admin/Logs","action" => "index"));
         }
         //Regular user
         elseif ($group==='user'){
           $this->Auth->setUser('user');
           $this->redirect(array("controller" => "Accounts","action" => "index"));
         }

       

     }

   public function logout()
   {
       $this->Flash->success('You are now logged out.');
       return $this->redirect($this->Auth->logout());
   }
}
