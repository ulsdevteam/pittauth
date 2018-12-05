<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Idtypes Controller
 *
 * @property \App\Model\Table\IdtypesTable $Idtypes
 *
 * @method \App\Model\Entity\Idtype[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class IdtypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $idtypes = $this->paginate($this->Idtypes);

        $this->set(compact('idtypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Idtype id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $idtype = $this->Idtypes->get($id, [
            'contain' => []
        ]);

        $this->set('idtype', $idtype);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $idtype = $this->Idtypes->newEntity();
        if ($this->request->is('post')) {
            $idtype = $this->Idtypes->patchEntity($idtype, $this->request->getData());
            if ($this->Idtypes->save($idtype)) {
                $this->Flash->success(__('The idtype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The idtype could not be saved. Please, try again.'));
        }
        $this->set(compact('idtype'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Idtype id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $idtype = $this->Idtypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $idtype = $this->Idtypes->patchEntity($idtype, $this->request->getData());
            if ($this->Idtypes->save($idtype)) {
                $this->Flash->success(__('The idtype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The idtype could not be saved. Please, try again.'));
        }
        $this->set(compact('idtype'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Idtype id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $idtype = $this->Idtypes->get($id);
        if ($this->Idtypes->delete($idtype)) {
            $this->Flash->success(__('The idtype has been deleted.'));
        } else {
            $this->Flash->error(__('The idtype could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
