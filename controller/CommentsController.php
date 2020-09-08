<?php
class CommentsController extends Controller {

    /**
     * Récupère les commentaires
     */
    function admin_index() {
        $this->loadModel('Comment');
        $condition = array('report'=>1);
        $d['comments'] = $this->Comment->find(array(
            'fields' => 'id,id_post,author,comment_date,content,report',
            'conditions' => $condition,
        ));
        $d['total'] = $this->Comment->findCount($condition);
        $this->set($d);
    }

    /**
     * Passer le commentaire en désirable
     */
    function admin_desirable($id){
        $this->loadModel('Comment');
        $d['id'] = '';
        if($id) {
            $this->request->data = $this->Comment->findFirst(array(
                'conditions' => array('id'=>$id)
            ));
            $this->request->data->report = 0;
            $this->Comment->save($this->request->data);
            $d['id'] = $id;
            $this->redirect('admin/comments/index');
        }
    }

    /**
     * Supprimer un commentaire
     */
    function admin_delete($id){
        $this->loadModel('Comment');
        $this->Comment->delete($id);
        $this->Session->setFlash('Le contenu a bien été supprimé', 'success');
        $this->redirect('admin/comments/index');
    }
}
