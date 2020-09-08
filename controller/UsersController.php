<?php
class UsersController extends Controller {

    /**
     * Vérifier l'existence d'un user et la connexion
     */
    function login(){            
        if($this->request->data) {
            $data = $this->request->data;
            $data->password = sha1($data->password);
            $this->loadModel('User');
            $user = $this->User->findFirst(array(
                'conditions' => array('login' => $data->login, 'password'=> $data->password),
            ));
            if(!empty($user)){
                $this->Session->write('User', $user);
                debug($user);
            }
            $this->request->data->password = '';
        }
        if($this->Session->isLogged()){
            $this->redirect('cockpit/posts/index');
        }
    }

    /**
     * Déconnexion
     */
    function logout(){
        unset($_SESSION['User']);
        $this->Session->setFlash('Vous êtes maintenant déconnecté');
        $this->redirect('/');
    }

}