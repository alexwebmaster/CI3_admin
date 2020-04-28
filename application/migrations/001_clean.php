<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Clean extends CI_Migration {


    public function __construct()
    {   
        parent::__construct();
    }
    
    public function up()
    {
        $this->_table_clean();
    }
    
    public function down()
    {
        $this->_table_clean();
    }

    /********************************************
    *
    * Clean all tables
    *
    *********************************************/
    private function _table_clean()
    {
        // Migration 1 clean all tables
        if ($this->db->table_exists('admin')) 
        {
            $this->dbforge->drop_table('admin');
        }
        if ($this->db->table_exists('banners')) 
        {
            $this->dbforge->drop_table('banners');
        }
        if ($this->db->table_exists('banner_collections')) 
        {
            $this->dbforge->drop_table('banner_collections');
        }
        if ($this->db->table_exists('boxes')) 
        {
            $this->dbforge->drop_table('boxes');
        }
        if ($this->db->table_exists('canned_messages')) 
        {
            $this->dbforge->drop_table('canned_messages');
        }
        if ($this->db->table_exists('categories')) 
        {
            $this->dbforge->drop_table('categories');
        }
        if ($this->db->table_exists('countries')) 
        {
            $this->dbforge->drop_table('countries');
        }
        if ($this->db->table_exists('country_zones')) 
        {
            $this->dbforge->drop_table('country_zones');
        }
        if ($this->db->table_exists('country_zone_areas')) 
        {
            $this->dbforge->drop_table('country_zone_areas');
        }
        if ($this->db->table_exists('pages')) 
        {
            $this->dbforge->drop_table('pages');
        }
        if ($this->db->table_exists('posts')) 
        {
            $this->dbforge->drop_table('posts');
        }
        if ($this->db->table_exists('post_categories')) 
        {
            $this->dbforge->drop_table('post_categories');
        }
        if ($this->db->table_exists('routes')) 
        {
            $this->dbforge->drop_table('routes');
        }
        if ($this->db->table_exists('search')) 
        {
            $this->dbforge->drop_table('search');
        }
        if ($this->db->table_exists('sessions')) 
        {
            $this->dbforge->drop_table('sessions');
        }
        if ($this->db->table_exists('settings')) 
        {
            $this->dbforge->drop_table('settings');
        }
    }
}