<?php

class Accounts_Model extends XPO_Model {

    var $user_id;
    var $menu;
    var $employee_info;

    public function getUser($user_id)
    {
        return $this->db->get_where('users_login',array('username'=>$user_id))->row()->password;
    }
    
    public function build($user_id)
    {
        $this->user_id = $user_id;
        $this->buildUserMenu();
        $this->buildUserProfile();

        $this->session->set_userdata('user_menu',$this->menu);
        $this->session->set_userdata('user_info',$this->employee_info);
    }

    private function buildUserProfile()
    {
        $employee = $this->db->get_where('employees',array('user_id'=>$this->user_id))->row();
        $this->employee_info = array(
                                    'fname' => ucwords($employee->e_fname),
                                    'lname' => ucwords($employee->e_lname),
                                    'dept' => $employee->department,
                                    'group' => $employee->user_group
                                );
    }

    private function buildUserMenu()
    {   
        $this->db->join('site_menus','site_menus.menu_id = user_menus.site_menu_id','left');
        $menu = $this->db->get_where('user_menus',array('user_id'=>$this->user_id))->result();
        if(count($menu) > 1){
            $this->menu = $this->buildSubMenu($menu);
        }else{
            $this->menu = $this->buildSubMenu($this->getAllSiteMenu());
        }
    }

    private function getAllSiteMenu()
    {
        $site_menu = $this->db->get_where('site_menus',array('parent_id'=>NULL))->result();
        return $site_menu;
    }

    private function buildSubMenu($parents)
    {   
        foreach($parents as $submenu)
        {
            if(isset($submenu->permissions)){
                $allowed = ($submenu->permissions != '*' ? explode('-',$submenu->permissions) : NULL);
            
                if($allowed){
                    $this->db->where_in('menu_id',$allowed);
                }
            }

            $this->db->where('parent_id',$submenu->menu_id);
            $sub = $this->db->get_where('site_menus')->result();
            
            $menu[] = array(
                            'name' => $submenu->name,
                            'description' => $submenu->description,
                            'controller' => $submenu->controller,
                            'submenu' => ($sub ? $this->buildSubMenu($sub) : NULL),
                            'icon' => $submenu->icon
                        );
        }
        
        return $menu;
    }


}