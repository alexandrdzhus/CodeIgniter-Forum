<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function count_all()
    {
        $query = $this->db->get("articles");
        return $query->num_rows();
    }

    function get_articles($limit, $offset, $keyword = '', $sort ='')
    // for pagination
    {
        if( !empty($keyword) ){
            $this->db->like('text', $keyword);
        }
        if( !empty($sort) ){
            $this->db->order_by('id', $sort);
        }
        $query = $this->db->get('articles', $limit, $offset);
        return $query->result();
    }

    function count_search($keyword)
    {
        $this->db->like('text', $keyword);
        $this->db->from('articles');
        $query = $this->db->count_all_results();
        return $query;
    }
    function add_article($data)
    {   
        $this->db->insert('articles', $data);        
    }

    function del_article($article_id)
    {
        $this->db->where('id', $article_id);
        $this->db->delete('articles');
    }

    function get_article($article_id)  
    //for edit post
      {  
           $this->db->where("id", $article_id);  
           $query=$this->db->get('articles');  
           return $query->result();  
      }  

    function edit_article($article_id, $updated_data)
    {
        $this->db->where('id', $article_id);
        $this->db->update('articles',$updated_data);
        return true;
    }
}
