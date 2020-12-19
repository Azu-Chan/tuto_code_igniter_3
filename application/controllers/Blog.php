<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

    function index() {
        $this->load->helper('date');
        $this->load->model('articles');
        $this->load->model('article_status');
        $this->articles->load($this->auth_user->is_connected);

        $data['title'] = "Blog";

        $this->load->view('common/header', $data);
        $this->load->view('blog/index', $data);
        $this->load->view('common/footer', $data);
    }

    public function nouvel_article() {
        if (!$this->auth_user->is_connected) {
            redirect('blog/index');
        }
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('article_status');
        $this->set_blog_post_validation();

        $data['title'] = "Nouvel article";

        if ($this->form_validation->run() == TRUE) {
            $this->load->model('article');
            $this->article->author_id = $this->auth_user->id;
            $this->article->content = $this->input->post('content');
            $this->article->status = $this->input->post('status');
            $this->article->title = $this->input->post('title');
            $this->article->save();
            if ($this->article->is_found) {
                redirect('blog/index');
            }
        }
        $this->load->view('common/header', $data);
        $this->load->view('blog/form', $data);
        $this->load->view('common/footer', $data);
    }

    protected function set_blog_post_validation() {
        $list = join(',', $this->article_status->codes);
        $this->form_validation->set_rules('title', 'Titre', array('required', 'max_length[64]'));
        $this->form_validation->set_rules('content', 'Contenu', 'required');
        $this->form_validation->set_rules('status', 'Statut', array('required', 'in_list[' . $list . ']'));
    }
}