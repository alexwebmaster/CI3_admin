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
        if ($this->db->table_exists('canned_messages')) 
        {
            $this->dbforge->drop_table('canned_messages');
        }
        if ($this->db->table_exists('categories')) 
        {
            $this->dbforge->drop_table('categories');
        }
        if ($this->db->table_exists('products')) 
        {
            $this->dbforge->drop_table('products');
        }
        if ($this->db->table_exists('category_products')) 
        {
            $this->dbforge->drop_table('category_products');
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
        if ($this->db->table_exists('coupons')) 
        {
            $this->dbforge->drop_table('coupons');
        }
        if ($this->db->table_exists('coupons_products')) 
        {
            $this->dbforge->drop_table('coupons_products');
        }
        if ($this->db->table_exists('customer_groups')) 
        {
            $this->dbforge->drop_table('customer_groups');
        }
        if ($this->db->table_exists('customers')) 
        {
            $this->dbforge->drop_table('customers');
        }
        if ($this->db->table_exists('customers_address_bank')) 
        {
            $this->dbforge->drop_table('customers_address_bank');
        }
        if ($this->db->table_exists('digital_products')) 
        {
            $this->dbforge->drop_table('digital_products');
        }
        if ($this->db->table_exists('download_package_files')) 
        {
            $this->dbforge->drop_table('download_package_files');
        }
        if ($this->db->table_exists('download_packages')) 
        {
            $this->dbforge->drop_table('download_packages');
        }
        if ($this->db->table_exists('gift_cards')) 
        {
            $this->dbforge->drop_table('gift_cards');
        }
        if ($this->db->table_exists('options')) 
        {
            $this->dbforge->drop_table('options');
        }
        if ($this->db->table_exists('option_values')) 
        {
            $this->dbforge->drop_table('option_values');
        }
        if ($this->db->table_exists('orders')) 
        {
            $this->dbforge->drop_table('orders');
        }
        if ($this->db->table_exists('order_items')) 
        {
            $this->dbforge->drop_table('order_items');
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
        if ($this->db->table_exists('products_files')) 
        {
            $this->dbforge->drop_table('products_files');
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