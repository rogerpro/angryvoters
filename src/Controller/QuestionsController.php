<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Questions Controller
 *
 * @property \App\Model\Table\QuestionsTable $Questions
 */
class QuestionsController extends AppController
{

    public function hola($name = null)
    {
        $q = $this->Questions->find();
        $q->where([
            'Questions.id' => 1
        ])
            ->contain([
            'Users',
            'Elections'
        ])
            ->contain('Answers.Users');
        $question = $q->first();
        $this->set('name', $name);
        $this->set('question', $question);
    }

    public function latest()
    {
        $q = $this->Questions->find();
        $q->contain('Users')
            ->limit(5)
            ->order([
            'Questions.created' => 'desc'
        ]);
        $this->set('questions', $q);
    }

    public function repaso()
    {
        $q = $this->Questions->find();
        $q->order([
            'Questions.title' => 'asc'
        ]);
        debug($q->toArray());
        
        // Utilizar la vista de la acción
        // $this->render('index');
        
        // No utilizar ninguna vista
        $this->render(false);
    }

    public function repaso2($userId = null)
    {
        $q = $this->Questions->find();
        $q->where([
            'Questions.user_id' => $userId
        ]);
        debug($q->toArray());
        
        // No utilizar ninguna vista
        $this->render(false);
    }

    public function repaso3($userEmail = null)
    {
        $q = $this->Questions->find();
        $q->contain('Users')->where([
            'Users.email' => $userEmail
        ]);
        debug($q->toArray());
        $this->render(false);
    }

    public function answerYes()
    {
        $q = $this->Questions->find();
        $answersFilter = function (\Cake\ORM\Query $query) {
            return $query->where([
                'answer' => true
            ]);
        };
        
        $q->contain([
            'Answers' => $answersFilter
        ]);
        debug($q->toArray());
        $this->render(false);
    }

    public function onlyAnswerNo()
    {
        $q = $this->Questions->find();
        $answersFilter = function (\Cake\ORM\Query $query) {
            return $query->where([
                'answer' => false
            ]);
        };
        
        $q->matching('Answers', $answersFilter);
        debug($q->toArray());
        $this->render(false);
    }

    public function search()
    {
        $options = $this->request->query;
        $q = $this->Questions->find('search', $options);
        debug($q->toArray());
        $this->render(false);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => [
                'Users',
                'Elections'
            ]
        ];
        $questions = $this->paginate($this->Questions);
        
        $this->set(compact('questions'));
        $this->set('_serialize', [
            'questions'
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id
     *            Question id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => [
                'Users',
                'Elections',
                'Tags',
                'Answers'
            ]
        ]);
        
        $this->set('question', $question);
        $this->set('_serialize', [
            'question'
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $question = $this->Questions->newEntity();
        if ($this->request->is('post')) {
            $question = $this->Questions->patchEntity($question, $this->request->data);
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));
                
                return $this->redirect([
                    'action' => 'index'
                ]);
            } else {
                $this->Flash->error(__('The question could not be saved. Please, try again.'));
            }
        }
        $users = $this->Questions->Users->find('list', [
            'limit' => 200
        ]);
        $elections = $this->Questions->Elections->find('list', [
            'limit' => 200
        ]);
        $tags = $this->Questions->Tags->find('list', [
            'limit' => 200
        ]);
        $this->set(compact('question', 'users', 'elections', 'tags'));
        $this->set('_serialize', [
            'question'
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id
     *            Question id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => [
                'Tags'
            ]
        ]);
        if ($this->request->is([
            'patch',
            'post',
            'put'
        ])) {
            $question = $this->Questions->patchEntity($question, $this->request->data);
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));
                
                return $this->redirect([
                    'action' => 'index'
                ]);
            } else {
                $this->Flash->error(__('The question could not be saved. Please, try again.'));
            }
        }
        $users = $this->Questions->Users->find('list', [
            'limit' => 200
        ]);
        $elections = $this->Questions->Elections->find('list', [
            'limit' => 200
        ]);
        $tags = $this->Questions->Tags->find('list', [
            'limit' => 200
        ]);
        $this->set(compact('question', 'users', 'elections', 'tags'));
        $this->set('_serialize', [
            'question'
        ]);
    }

    /**
     * Delete method
     *
     * @param string|null $id
     *            Question id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod([
            'post',
            'delete'
        ]);
        $question = $this->Questions->get($id);
        if ($this->Questions->delete($question)) {
            $this->Flash->success(__('The question has been deleted.'));
        } else {
            $this->Flash->error(__('The question could not be deleted. Please, try again.'));
        }
        
        return $this->redirect([
            'action' => 'index'
        ]);
    }
}
