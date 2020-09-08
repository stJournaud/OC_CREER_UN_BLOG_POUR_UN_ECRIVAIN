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

}