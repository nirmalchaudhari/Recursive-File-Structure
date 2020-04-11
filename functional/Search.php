<?php


class Search {
    protected $db;
    protected $text = '';
    public function __construct($db) {
        $this->db = $db;
    }

    public function locate($text) {
        $this->text = $text;
        $result = $this->query();
        $return = '<h1> No Data Found</h1>';
        if (sizeof($result) > 0) {
            $return = '';
            foreach($result as $val) {
                $return .= "<h2>{$val['path']}</h2>";
            }
        }
        echo $return;
    }

    public function query() {
        return $this->db->query("SELECT path FROM flstruct where name like '%{$this->text}%'")->fetchAll();        
    } 
}