<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Elections Controller
 *
 * @property \App\Model\Table\ElectionsTable $Elections
 */
class ElectionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $elections = $this->paginate($this->Elections);

        $this->set(compact('elections'));
        $this->set('_serialize', ['elections']);
    }

    /**
     * View method
     *
     * @param string|null $id Election id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $election = $this->Elections->get($id, [
            'contain' => ['Questions']
        ]);

        $this->set('election', $election);
        $this->set('_serialize', ['election']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $election = $this->Elections->newEntity();
        if ($this->request->is('post')) {
            $election = $this->Elections->patchEntity($election, $this->request->data);
            if ($this->Elections->save($election)) {
                $this->Flash->success(__('The election has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The election could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('election'));
        $this->set('_serialize', ['election']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Election id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $election = $this->Elections->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $election = $this->Elections->patchEntity($election, $this->request->data);
            if ($this->Elections->save($election)) {
                $this->Flash->success(__('The election has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The election could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('election'));
        $this->set('_serialize', ['election']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Election id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $election = $this->Elections->get($id);
        if ($this->Elections->delete($election)) {
            $this->Flash->success(__('The election has been deleted.'));
        } else {
            $this->Flash->error(__('The election could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
