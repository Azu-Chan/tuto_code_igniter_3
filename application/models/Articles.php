<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends CI_Model {

    protected $_list;

    public function __construct() {
        parent::__construct();
        $this->_list = [];
    }

    public function __get($key) {
        $method_name = 'get_property_' . $key;
        if (method_exists($this, $method_name)) {
            return $this->$method_name();
        } else {
            return parent::__get($key);
        }
    }

    protected function get_property_has_items() {
        return count($this->_list) > 0;
    }

    protected function get_property_items() {
        return $this->_list;
    }

    protected function get_property_num_items() {
        return count($this->_list);
    }

    public function load($show_hidden = FALSE) {
        $this->db->select("article.id, title, alias, SUBSTRING_INDEX(content, ' ', 20) AS content, date, article.status, author_id")
                 ->from('article')
                 ->join('login', 'article.author_id = login.id')
                 -> order_by('date', 'DESC');
        if (!$show_hidden) {
            $this->db->where('article.status', 'P');
        }
        $this->_list = $this->db->get()-> result();
    }
}
