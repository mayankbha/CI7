<?php
class MY_Loader extends CI_Loader {
    function __construct(){
		parent::__construct();
		
	}
	
	public function template($template_name, $language = 'asian', $vars = array(), $return = FALSE)
    {
		
		//echo 'templates/'.$language.'/header';

        $content  = $this->view('templates/'.$language.'/header', $vars, $return);
        $content .= $this->view('templates/'.$language.'/'.$template_name, $vars, $return);
        $content .= $this->view('templates/'.$language.'/footer', $vars, $return);
        if ($return)
        {
            return $content;
        }
    }
	
    public function blank_template($template_name, $language = 'asian', $vars = array(), $return = FALSE)
    {

        //$content  = $this->view('templates/'.$language.'/if_header', $vars, $return);   
        $content = $this->view('templates/'.$language.'/'.$template_name, $vars, $return);  
        //$content .= $this->view('templates/'.$language.'/if_footer', $vars, $return);   
        if ($return)
        {
            return $content;
        }
    }
			
    public function admin_template($template_name='index.php', $vars = array(), $return = FALSE)
    {

        $content  = $this->view('templates/admin/header', $vars, $return);
        $content .= $this->view('templates/admin/'.$template_name, $vars, $return);
        $content .= $this->view('templates/admin/footer', $vars, $return);
        if ($return)
        {
            return $content;
        }
    }
	
    public function iframe_template($template_name='index.php', $vars = array(), $return = FALSE)
    {

        $content  = $this->view('templates/admin/if_header', $vars, $return);
        $content .= $this->view('templates/admin/'.$template_name, $vars, $return);
        $content .= $this->view('templates/admin/if_footer', $vars, $return);
        if ($return)
        {
            return $content;
        }
    }
    
    public function shop_template($template_name, $language = 'asian', $vars = array(), $return = FALSE)
    {
		
		//echo 'templates/'.$language.'/header';

        $content  = $this->view('templates/'.$language.'/header', $vars, $return);
        $content .= $this->view('templates/'.$language.'/'.$template_name, $vars, $return);
        
		//$content .= $this->view('templates/'.$language.'/store_footer', $vars, $return);
		$content .= $this->view('templates/'.$language.'/footer', $vars, $return);
		
		
        if ($return)
        {
            return $content;
        }
    }	
}
