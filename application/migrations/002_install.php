<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install extends CI_Migration {


    public function __construct()
    {   
        parent::__construct();
    }
    
    public function up()
    {
        $this->_table_admin();
        $this->_table_banners();
        $this->_table_banner_collections();
        $this->_table_boxes();
        $this->_table_canned_messages();
        $this->_table_categories();
        $this->_table_countries();
        $this->_table_country_zones();
        $this->_table_country_zone_areas();
        $this->_table_pages();
        $this->_table_posts();
        $this->_table_post_categories();
        $this->_table_routes();
        $this->_table_search();
        $this->_table_sessions();
        $this->_table_settings();
    }
    
    public function down()
    {
        // Migration 2 has no down yet
    } 

    /********************************************
    *
    * Generate admin table
    *
    *********************************************/
    private function _table_admin()
    {
        if(!$this->db->table_exists('admin'))
        {

            // create the table
            $this->dbforge->add_field(array(
                'id' => array(  
                            'type' => 'int',
                            'constraint' => 9,
                            'unsigned' => true,
                            'auto_increment' => true
                            ),
                'firstname' => array(
                            'type' => 'varchar',
                            'constraint' => 32,
                            'null' => true
                            ),
                'lastname' => array(
                            'type' => 'varchar',
                            'constraint' => 32,
                            'null' => true
                            ),
                'username' => array(
                            'type' => 'varchar',
                            'constraint' => 255,
                            'null' => false
                            ),
                'email' => array(
                            'type' => 'varchar',
                            'constraint' => 128,
                            'null' => true
                            ),
                'access' => array(
                            'type' => 'varchar',
                            'constraint' => 11,
                            'null' => false
                            ),
                'password' => array(
                            'type' => 'varchar',
                            'constraint' => 40,
                            'null' => false
                            )
            ));

            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table('admin', true);

            //add the default user
            $this->db->insert('admin', array('username'=>'admin','email'=>'admin@admin.com', 'password'=>sha1('admin'), 'access'=>'Admin'));
        }
    }

    /********************************************
    *
    * Generate banners table
    *
    *********************************************/
    private function _table_banners()
    {        
        if(!$this->db->table_exists('banners'))
        {
            $this->dbforge->add_field(array(
                'banner_id' => array(
                            'type' => 'int',
                            'constraint' => 9,
                            'unsigned' => true,
                            'auto_increment' => true
                            ),
                'banner_collection_id' => array(
                            'type' => 'int',
                            'constraint' => 9,
                            'unsigned' => true,
                            'null' => false
                            ),
                'category_id' => array(
                            'type' => 'int',
                            'constraint' => 9,
                            'unsigned' => true,
                            'null' => false
                            ),
                'name' => array(
                            'type' => 'varchar',
                            'constraint' => 128,
                            'null' => false
                            ),
                'enable_date' => array(
                            'type' => 'date',
                            'null' => false
                            ),
                'disable_date' => array(
                            'type' => 'date',
                            'null' => false
                            ),
                'image' => array(
                            'type' => 'varchar',
                            'constraint' => 64,
                            'null' => false
                            ),
                'link' => array(
                            'type' => 'varchar',
                            'constraint' => 128,
                            'null' => true
                            ),
                'new_window' => array(
                            'type' => 'tinyint',
                            'constraint' => 1,
                            'null' => false,
                            'default' => 0
                            ),
                'sequence' => array(
                            'type' => 'int',
                            'constraint' => 11,
                            'null' => false,
                            'default' => 0
                            )
            ));

            $this->dbforge->add_key('banner_id', true);
            $this->dbforge->create_table('banners', true);
        }
    }
    
    /********************************************
    *
    * Generate banners_collections table
    *
    *********************************************/
    private function _table_banner_collections()
    {
        //if the banner_collections table does not exist, run the migration
        if (!$this->db->table_exists('banner_collections'))
        {
            //create banner collections
            $this->dbforge->add_field(array(
                'banner_collection_id' => array(
                    'type' => 'INT',
                    'constraint' => 4,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'name' => array(
                    'type' => 'varchar',
                    'constraint' => 32
                )
            ));
                
            $this->dbforge->add_key('banner_collection_id', TRUE);
            $this->dbforge->create_table('banner_collections', TRUE);
        
            //create 2 collections to replace the current Banners & Boxes
            $records = array(array('name'=>'Homepage Banners'), array('name'=>'Homepage Boxes'));
            $this->db->insert_batch('banner_collections', $records);
        }
    }

    /********************************************
    *
    * Generate banners_collections table
    *
    *********************************************/
    private function _table_boxes()
    {
        if (!$this->db->table_exists('boxes'))
        {   
            //create table fox boxes
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'sequence' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                ),
                'title' => array(
                    'type' => 'varchar',
                    'constraint' => 128
                ),
                'enable_on' => array(
                    'type' => 'date',
                    'null' => TRUE
                ),
                'disable_on' => array(
                    'type' => 'date',
                    'null' => TRUE
                ),
                'image' => array(
                    'type' => 'varchar',
                    'constraint' => 64
                ),
                'link' => array(
                    'type' => 'varchar',
                    'constraint' => 255,
                ),
                'new_window' => array(
                    'type' => 'tinyint',
                    'constraint' => 1,
                    'default' => 0
                )
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('boxes', TRUE);
        }
    }

    /********************************************
    *
    * Generate canned_messages table
    *
    *********************************************/
    private function _table_canned_messages()
    {
        if (!$this->db->table_exists('canned_messages'))
        {

            $this->dbforge->add_field(array(
                    'id' => array(
                                'type' => 'int',
                                'constraint' => 9,
                                'unsigned' => true,
                                'auto_increment' => true
                                ),
                    'deletable' => array(
                                'type' => 'tinyint',
                                'constraint' => 1,
                                'null' => false,
                                'default' => 1
                                ),
                    'type' => array(
                                'type' => 'enum',
                                'constraint' => array('internal', 'order'),
                                'null' => false
                                ),
                    'name' => array(
                                'type' => 'varchar',
                                'constraint' => 50,
                                'null' => true
                                ),
                    'subject' => array(
                                'type' => 'varchar',
                                'constraint' => 100,
                                'null' => true
                                ),
                    'content' => array(
                                'type' => 'text'
                                )
            ));

            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table('canned_messages', true);
        }
    }

    /********************************************
    *
    * Generate categories table
    *
    *********************************************/
    private function _table_categories()
    {
        if(!$this->db->table_exists('categories'))
        {
            $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'int',
                                'constraint' => 9,
                                'unsigned' => true,
                                'auto_increment' => true
                                    ),
                        'parent_id' => array(
                                'type' => 'int',
                                'constraint' => 9,
                                'unsigned' => true,
                                'null' => false,
                                'default' => 0
                                    ),
                        'name' => array(
                                'type' => 'varchar',
                                'constraint' => 64,
                                'null' => false
                                    ),
                        'slug' => array(
                                'type' => 'varchar',
                                'constraint' => 64,
                                'null' => false
                                    ),
                        'route_id' => array(
                                'type' => 'int',
                                'constraint' => 9,
                                'null' => false
                                    ),
                        'description' => array(
                                'type' => 'text',
                                'null' => false
                                    ),
                        'excerpt' => array(
                                'type' => 'text',
                                'null' => false
                                    ),
                        'sequence' => array(
                                'type' => 'int',
                                'constraint' => 5,
                                'unsigned' => true,
                                'default' => 0,
                                'null' => false
                                    ),
                        'image' => array(
                                'type' => 'varchar',
                                'constraint' => 255,
                                'null' => true
                                    ),
                        'seo_title' => array(
                                'type' => 'text',
                                'null' => false
                                    ),
                        'meta' => array(
                                'type' => 'text',
                                'null' => false
                                    ),
                        'enabled' => array(
                                'type' => 'tinyint',
                                'constraint' => 1,
                                'default' => 1
                                    )
            ));

            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table('categories', true);
        }
    }

    /********************************************
    *
    * Generate countries table
    *
    *********************************************/
    private function _table_countries()
    {
        
        if(!$this->db->table_exists('countries'))
        {
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'int',
                    'constraint' => 9,
                    'unsigned' => true,
                    'auto_increment' => true
                    ),
                'sequence' => array(
                    'type' => 'int',
                    'constraint' => 11,
                    'default' => 0
                    ),
                'name' => array(
                    'type' => 'varchar',
                    'constraint' => 128,
                    'null' => false
                    ),
                'iso_code_2' => array(
                    'type' => 'varchar',
                    'constraint' => 2 ,
                    'null' => false
                    ),
                'iso_code_3' => array(
                    'type' => 'varchar',
                    'constraint' => 3 ,
                    'null' => false
                    ),
                'address_format' => array(
                    'type' => 'text'
                    ),
                'zip_required' => array(
                    'type' => 'int',
                    'constraint' => 1 ,
                    'null' => false,
                    'default' => 0
                    ),
                'status' => array(
                    'type' => 'int',
                    'constraint' => 1 ,
                    'null' => false, 
                    'default' => 1
                    ),
                'tax' => array(
                    'type' => 'float',
                    'constraint' => '10,2',
                    'null' => false,
                    'default' => 0
                    )
                ));

            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table('countries');

            // Seed

            $records = $this->load->view('templates/countries.txt', array(), true);
            $records = explode("\n", $records);

            $batch = array();
            foreach($records as $r)
            {
                $r = explode('|', $r);

                $batch[] = array('id'=>$r[0], 
                                 'sequence'=>$r[1], 
                                 'name'=>$r[2], 
                                 'iso_code_2'=>$r[3],
                                 'iso_code_3'=>$r[4], 
                                 'address_format'=> str_replace('\n', "\n", $r[5]), // convert string newline to literal
                                 'zip_required'=>$r[6],
                                 'status'=>$r[7],
                                 'tax'=>$r[8]
                                 );
            }

            $this->db->insert_batch('countries', $batch);
        }
    }

    /********************************************
    *
    * Generate country_zones table
    *
    *********************************************/
    private function _table_country_zones()
    {

        if(!$this->db->table_exists('country_zones'))
        {   
            $this->dbforge->add_field(array(
                'id' => array( 
                    'type' => 'int', 
                    'constraint' => 11, 
                    'unsigned' => true,
                    'auto_increment' => true
                    ),
                'country_id' => array( 
                    'type' => 'int', 
                    'constraint' => 9,
                    'unsigned' => true, 
                    'null' => false
                    ),
                'code' => array( 
                    'type' => 'varchar', 
                    'constraint' => 32, 
                    'null' => true
                    ),
                'name' => array( 
                    'type' => 'varchar', 
                    'constraint' => 128, 
                    'null' => false
                    ),
                'status' => array( 
                    'type' => 'int', 
                    'constraint' => 1, 
                    'null' => false,
                    'default' => 1
                    ),
                'tax' => array( 
                    'type' => 'float', 
                    'constraint' => '10,2',
                    'null' => false
                    )
            ));

            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table('country_zones');

            // Seed

            $records = $this->load->view('templates/country_zones.txt', array(), true);
            $records = explode("\n", $records);

            foreach($records as $r)
            {
                $r = explode('|', $r);

                $insert = array('id'=>$r[0], 
                                'country_id' => $r[1],
                                'code' => $r[2],
                                'name' => $r[3],
                                'status' => $r[4],
                                'tax' => $r[5]
                                 );

                // Run this one one at a time, since the list is probably too large for a batch
                $this->db->insert('country_zones', $insert);
            }

        }
    }

    /********************************************
    *
    * Generate country_zone_areas table
    *
    *********************************************/
    private function _table_country_zone_areas()
    {
        if(!$this->db->table_exists('country_zone_areas'))
        {
            $this->dbforge->add_field(array(
                'id' =>array(
                    'type'=>'int',
                    'constraint' => 9,
                    'unsigned' => true,
                    'auto_increment' => true
                    ),
                'zone_id' =>array(
                    'type'=>'int',
                    'constraint' => 9,
                    'unsigned' => true,
                    'null' => false
                    ),
                'code' =>array(
                    'type'=>'varchar',
                    'constraint' => 15,
                    'null' => false
                    ),
                'name' =>array(
                    'type'=>'varchar',
                    'constraint' => 100,
                    'null' => false
                    ),
                'tax' =>array(
                    'type'=>'float',
                    'constraint' => '10,2',
                    'null' => false,
                    'default' => 0
                    ),
                'lat' =>array(
                    'type'=>'varchar',
                    'constraint' => '20',
                    'null' => false,
                    'default' => 0
                    ),
                'lng' =>array(
                    'type'=>'varchar',
                    'constraint' => '20',
                    'null' => false,
                    'default' => 0
                    )
            ));

            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table('country_zone_areas', true);

            // Seed

            $records = $this->load->view('templates/country_zone_areas.txt', array(), true);
            $records = explode("\n", $records);

            foreach($records as $r)
            {
                $r = explode('|', $r);

                $insert = array('id'=>$r[0], 
                                'zone_id' => $r[1],
                                'code' => $r[2],
                                'name' => $r[3],
                                'tax' => $r[4],
                                'lat' => $r[5],
                                'lng' => $r[6]
                                 );

                // Run this one one at a time, since the list is probably too large for a batch
                $this->db->insert('country_zone_areas', $insert);
            }
        }
    }

    /********************************************
    *
    * Generate pages table
    *
    *********************************************/
    private function _table_pages()
    {
        if(!$this->db->table_exists('pages'))
        {
            $this->dbforge->add_field(array(
                    'id' => array(
                        'type' => 'int',
                        'constraint' => 9,
                        'unsigned' => true,
                        'auto_increment' => true
                        ),
                    'parent_id' => array(
                        'type' => 'int',
                        'constraint' => 9,
                        'unsigned' => true,
                        'null' => false
                        ),
                    'title' => array(
                        'type' => 'varchar',
                        'constraint' => 128,
                        'null' => false
                        ),
                    'menu_title' => array(
                        'type' => 'varchar',
                        'constraint' => 128,
                        'null' => false
                        ),
                    'slug' => array(
                        'type' => 'varchar',
                        'constraint' => 255,
                        'null' => false
                        ),
                    'route_id' => array(
                        'type' => 'int',
                        'constraint' => 128,
                        'null' => false
                        ),
                    'content' => array(
                        'type' => 'longtext',
                        'null' => false
                         ),
                    'sequence' => array(
                        'type' => 'int',
                        'constraint' => 11,
                        'null' => false,
                        'default' => '0'
                        ),
                    'seo_title' => array(
                        'type' => 'text',
                        'null' => false
                         ),
                    'meta' => array(
                        'type' => 'text',
                        'null' => false
                         ),
                    'url' => array(
                        'type' => 'varchar',
                        'constraint' => 255
                        ),
                    'new_window' => array(
                        'type' => 'tinyint',
                        'constraint' => 1,
                        'default' => '0'
                        )
            ));

            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table('pages', true);
        }
    }
    
    /********************************************
    *
    * Generate posts table
    *
    *********************************************/
    private function _table_posts()
    {
        if(!$this->db->table_exists('posts'))
        {
            $this->dbforge->add_field(array(
                    'id' => array(
                        'type' => 'int',
                        'constraint' => 9,
                        'unsigned' => true,
                        'auto_increment' => true
                        ),
                    'parent_id' => array(
                        'type' => 'int',
                        'constraint' => 9,
                        'unsigned' => true,
                        'null' => false
                        ),
                    'category_id' => array(
                        'type' => 'int',
                        'constraint' => 9,
                        'unsigned' => true,
                        'null' => false
                        ),
                    'title' => array(
                        'type' => 'varchar',
                        'constraint' => 128,
                        'null' => false
                        ),
                    'menu_title' => array(
                        'type' => 'varchar',
                        'constraint' => 128,
                        'null' => false
                        ),
                    'image' => array(
                        'type' => 'text',
                        'null' => false
                         ),
                    'image_legend' => array(
                        'type' => 'text',
                        'null' => false
                         ),
                    'slug' => array(
                        'type' => 'varchar',
                        'constraint' => 255,
                        'null' => false
                        ),
                    'route_id' => array(
                        'type' => 'int',
                        'constraint' => 128,
                        'null' => false
                        ),
                    'content_preview' => array(
                        'type' => 'text',
                        'null' => false
                         ),
                    'content' => array(
                        'type' => 'longtext',
                        'null' => false
                         ),
                    'sequence' => array(
                        'type' => 'int',
                        'constraint' => 11,
                        'null' => false,
                        'default' => '0'
                        ),
                    'seo_title' => array(
                        'type' => 'text',
                        'null' => false
                         ),
                    'meta' => array(
                        'type' => 'text',
                        'null' => false
                         ),
                    'url' => array(
                        'type' => 'varchar',
                        'constraint' => 255
                        ),
                    'new_window' => array(
                        'type' => 'tinyint',
                        'constraint' => 1,
                        'default' => '0'
                        ),
                    'date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
            ));

            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table('posts', true);
        }
    }
    
    /********************************************
    *
    * Generate post_categories table
    *
    *********************************************/
    private function _table_post_categories()
    {
        if(!$this->db->table_exists('post_categories'))
        {
            $this->dbforge->add_field(array(

                    'id' => array(
                        'type' => 'int',
                        'constraint' => 9,
                        'unsigned' => true,
                        'auto_increment' => true
                        ),
                    'category_name' => array(
                        'type' => 'varchar',
                        'constraint' => 128,
                        'null' => false
                        ),
                    'sequence' => array(
                        'type' => 'int',
                        'constraint' => 11,
                        'null' => false,
                        'default' => '0'
                        )
            ));

            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table('post_categories', true);
        }
    }

    /********************************************
    *
    * Generate routes table
    *
    *********************************************/
    private function _table_routes()
    {
        if(!$this->db->table_exists('routes'))
        {
            $this->dbforge->add_field(array(
                    'id' => array(
                        'type' => 'int',
                        'constraint' => 9,
                        'unsigned' => true,
                        'auto_increment' => true
                        ),
                    'slug' => array(
                        'type' => 'varchar',
                        'constraint' => 255,
                        'null' => false
                        ),
                    'route' => array(
                        'type' => 'varchar',
                        'constraint' => 32
                        )
            ));

            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table('routes', true);
        }
    }

    /********************************************
    *
    * Generate search table
    *
    *********************************************/
    private function _table_search()
    {
        if(!$this->db->table_exists('search'))
        {
             $this->dbforge->add_field(array(
                    'code' => array(
                        'type' => 'varchar',
                        'constraint' => 40,
                        'null' => false
                        ),
                    'term' => array(
                        'type' => 'varchar',
                        'constraint' => 255,
                        'null' => false
                        )
            ));

            $this->dbforge->add_key('code', true);
            $this->dbforge->create_table('search', true);
        }
    }

    /********************************************
    *
    * Generate sessions table
    *
    *********************************************/
    private function _table_sessions()
    {
        if(!$this->db->table_exists('sessions'))
        {
            $this->dbforge->add_field(array(
                    'session_id' => array( 
                        'type' => 'varchar',
                        'constraint' => 40,
                        'default' => 0,
                        'null' => false
                        ),
                    'ip_address' => array( 
                        'type' => 'varchar',
                        'constraint' => 45,
                        'default' => 0,
                        'null' => false
                        ),
                    'user_agent' => array( 
                        'type' => 'varchar',
                        'constraint' => 120,
                        'default' => 0,
                        'null' => false
                        ),
                    'last_activity' => array( 
                        'type' => 'int',
                        'constraint' => 10,
                        'default' => 0,
                        'null' => false
                        ),
                    'user_data' => array( 
                        'type' => 'text',
                        'null' => false
                        )
            ));

            $this->dbforge->add_key('session_id', true);
            $this->dbforge->add_key('last_activity');
            $this->dbforge->create_table('sessions', true);
        }
    }

    /********************************************
    *
    * Generate settings table
    *
    *********************************************/
    private function _table_settings()
    {
        if(!$this->db->table_exists('settings'))
        {
            $this->dbforge->add_field(array(
                    'id' => array( 
                        'type' => 'int',
                        'constraint' => 9,
                        'unsigned' => true,
                        'auto_increment' => true
                        ),
                    'code' => array( 
                        'type' => 'varchar',
                        'constraint' => 255,
                        'null' => false
                        ),
                    'setting_key' => array( 
                        'type' => 'varchar',
                        'constraint' => 255,
                        'null' => false
                        ),
                    'setting' => array( 
                        'type' => 'longtext',
                        'null' => false
                        )
            ));


            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table('settings', true);
        }

        //move config to the database if it exists, otherwise enter default information
        
        //load in the settings model
        $this->load->model('settings_model');
        // $settings = array();
        $settings = $this->settings_model->get_settings('site');

        if(empty($settings))
        {
            if(file_exists(FCPATH.'application/config/site.php'))
            {
                include(FCPATH.'application/config/site.php');
                //Fix array items
                foreach ($config as $key => $c)
                {
                    if (is_array($c))
                    {
                        $config[$key] = json_encode($c);
                    }
                }

                //set locale to default
                $config['locale'] = 'pt-BR';
                $config['currency_iso'] = $config['currency'];
            }
            else
            {
                $config['theme'] = 'default';
                $config['ssl_support'] = false;
                $config['company_name'] = '';
                $config['address1'] = '';
                $config['address2'] = '';
                $config['country'] = '';
                $config['country_id'] = '';
                $config['city'] = '';
                $config['zone_id'] = '';
                $config['state'] = '';
                $config['zip'] = '';
                $config['email'] = '';
                $config['locale'] = 'pt-BR';
                $config['currency_iso'] = 'BRL';
                $config['weight_unit'] = 'KG';
                $config['dimension_unit'] = 'CM';
                $config['site_logo'] = '/assets/img/logo.png';
                $config['admin_folder'] = 'admin';
                $config['require_login'] = false;
            }

            //submit the settings
            $this->settings_model->save_settings('site', $config);

            //kill the config var
            unset($config);
        }
    } 
}