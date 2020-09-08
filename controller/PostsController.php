<?php
class PostsController extends Controller {
    
    /**
	* Blog, liste les articles
	**/
    function index() {
        $perPage = 5;
        $this->loadModel('Post');
        $condition = array('online' => 1, 'type'=>'post');
        $d['posts'] = $this->Post->find(array(
            'conditions' => $condition,
            'order' => 'creationDate DESC',
            'limit' => ($perPage*($this->request->page-1)).','.$perPage,
        ));
        $d['total'] = $this->Post->findCount($condition);
        $d['page'] = ceil($d['total']/ $perPage);
        $this->set($d);
    }

    /**
	* Affiche un article en particulier
	**/
    function view($id, $slug) {
        $this->loadModel('Post');
        $this->loadModel('Comment');
        $d['post'] = $this->Post->findFirst(array(
            'fields' => 'id,slug,content,title,image_name',
            'conditions' => array('online' => 1, 'id'=>$id,'type'=>'post')
        ));
        if(empty($d['post'])){
            $this->e404('Page introuvable');
        }
        if($slug != $d['post']->slug) {
            $this->redirect("posts/view/id:$id/slug:".$d['post']->slug, 301);
        }
        $d['comments'] = $this->Comment->find(array(
            'fields' => 'id,id_post,author,comment_date,content,report',
            'conditions' => array('id_post'=>$id),
            'order' => 'comment_date DESC',
        ));
        $this->set($d);
    }

    /**
	* ADMIN  ACTIONS
	**/
	/**
	* Liste les différents articles
	**/
    function admin_index() {
        $perPage = 10;
        $this->loadModel('Post');
        $condition = array('type'=>'post');
        $d['posts'] = $this->Post->find(array(
            'fields' => 'id,title,online',
            'conditions' => $condition,
            'limit' => ($perPage*($this->request->page-1)).','.$perPage
        ));
        $d['total'] = $this->Post->findCount($condition);
        $d['page'] = ceil($d['total']/ $perPage);
        $this->set($d);
    }

    /**
     * Permet d'éditer un article
     */
    function admin_edit($id = null){
        $this->loadModel('Post');
        $d['id'] = '';
        if($this->request->data){
            if($this->Post->validates($this->request->data) && !empty($_FILES['file']['name'])){
                if(strpos($_FILES['file']['type'], 'image') !== false) {
                    $dir = WEBROOT.DS.'img'.DS.date('Y-m');
                    if(!file_exists($dir)) mkdir($dir);
                    move_uploaded_file($_FILES['file']['tmp_name'], $dir.DS.$_FILES['file']['name']);
                    $this->request->data->image_name = date('Y-m').'/'.$_FILES['file']['name'];
                    $this->request->data->type = 'post';
                    $this->request->data->creationDate = date('Y-m-d h:i:s');
                    
                    $this->Post->save($this->request->data);
                    $this->Session->setFlash('Le contenu a bien été modifié', 'success');
                    $this->redirect('admin/posts/index');
                } else {
                    $this->Form->errors['file'] = "Le fichier n'est pas une image";
                }
               
            } elseif($this->Post->validates($this->request->data) && empty($_FILES['file']['name'])) {
                    $this->request->data->type = 'post';
                    $this->request->data->creationDate = date('Y-m-d h:i:s');
                    
                    $this->Post->save($this->request->data);
                    $this->Session->setFlash('Le contenu a bien été modifié', 'success');
                    $this->redirect('admin/posts/index');
            } else {
                $this->Session->setFlash('Merci de corriger vos informations', 'danger');

            }
        } elseif($id){
                $this->request->data = $this->Post->findFirst(array(
                    'conditions' => array('id'=>$id)
                ));
                $d['id'] = $id;
        }
        
        $this->set($d);
    }

    /**
     * Permet de supprimer un article
     */
    function admin_delete($id){
        $this->loadModel('Post');
        $this->Post->delete($id);
        $this->Session->setFlash('Le contenu a bien été supprimé', 'success');
        $this->redirect('admin/posts/index');
    }

}