<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template{
    protected $_CI;
    
    // private $setTheme;
    
    function __construct(){
        $this->_CI=&get_instance();
        // $theme = $this->setTheme(2);
        $this->appName = "Watering Plant";
    }

    function setTheme(){
        $useTheme = 't1';
        
        $listTheme = new stdClass;
        $listTheme->t1 = 'colorlib';
        // $listTheme->t2 = 'themeV2';
        
        return $listTheme->$useTheme;
    }

    function admin($admin,$data=null){
        $data['appName'] = $this->appName;
        $data['_navbar']=$this->_CI->load->view(''.$this->setTheme().'/template/dashboard/navBar',$data,true);
        
        $data['_sidebar']=$this->_CI->load->view(''.$this->setTheme().'/template/dashboard/sideBar',$data,true);
        
        $data['_content']=$this->_CI->load->view(''.$this->setTheme().'/'.$admin,$data,true);

        $data['_footer']=$this->_CI->load->view(''.$this->setTheme().'/template/dashboard/footerDash',$data,true);
               
        $this->_CI->load->view(''.$this->setTheme().'/template',$data);
    }

    function dosen($dosen,$data=null){
        $data['appName'] = $this->appName;
        $data['_navbar']=$this->_CI->load->view(''.$this->setTheme().'/template/dashboard/navBar',$data,true);
        
        $data['_sidebar']=$this->_CI->load->view(''.$this->setTheme().'/template/dashboard/sideBar',$data,true);
        
        $data['_content']=$this->_CI->load->view(''.$this->setTheme().'/'.$dosen,$data,true);

        $data['_footer']=$this->_CI->load->view(''.$this->setTheme().'/template/dashboard/footerDash',$data,true);
               
        $this->_CI->load->view(''.$this->setTheme().'/template',$data);
    }

    function mhs($mhs,$data=null){
        $data['appName'] = $this->appName;
        $data['_navbar']=$this->_CI->load->view(''.$this->setTheme().'/template/dashboard/navBar',$data,true);
        
        $data['_sidebar']=$this->_CI->load->view(''.$this->setTheme().'/template/dashboard/sideBar',$data,true);
        
        $data['_content']=$this->_CI->load->view(''.$this->setTheme().'/'.$mhs,$data,true);

        $data['_footer']=$this->_CI->load->view(''.$this->setTheme().'/template/dashboard/footerDash',$data,true);
               
        $this->_CI->load->view(''.$this->setTheme().'/template',$data);
    }

    function login($login,$data=null){
        $data['appName'] = $this->appName;
        $data['_navbar']=null;
        
        $data['_sidebar']=null;
        
        $data['_content']=$this->_CI->load->view(''.$this->setTheme().'/'.$login,$data,true);

        $data['_footer']=null;
               
        $this->_CI->load->view(''.$this->setTheme().'/template',$data);
    }

    function home($home,$data=null){
        $data['appName'] = $this->appName;
        $data['_navbar']=null;
        
        $data['_sidebar']=null;
        
        $data['_content']=$this->_CI->load->view(''.$this->setTheme().'/'.$home,$data,true);

        $data['_footer']=null;
               
        $this->_CI->load->view(''.$this->setTheme().'/template',$data);
    }
}


/* End of file template.php */
/* Location: ./application/libraries/template.php */
