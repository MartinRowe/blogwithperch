<?php

class Perch
{
    static protected $instance;
	
    public $version = '2.6.6';
    
    public $admin           = false;
    private $page           = false;
    private $page_as_set    = false;
    private $bucket_list    = false;

    public $debug           = false;
    public $debug_output    = '';
    public $page_title      = 'Welcome';
    public $help_html       = '';
    public $form_count      = 0;
    public $form_errors     = array();
    
    protected $layout_vars  = array();
    public    $layout_depth = 1;
    
    public $ignore_pattern  = '/^CVS$/i';
    
    function __construct()
    {
        if (!defined('PERCH_DEBUG'))            define('PERCH_DEBUG', false);
        if (!defined('PERCH_PREVIEW_ARG'))      define('PERCH_PREVIEW_ARG', 'preview');
        if (!defined('PERCH_TEMPLATE_PATH'))    define('PERCH_TEMPLATE_PATH', PerchUtil::file_path(PERCH_PATH.'/templates'));
        if (!defined('PERCH_DEFAULT_DOC'))      define('PERCH_DEFAULT_DOC', 'index.php');
        if (!defined('PERCH_DEFAULT_EXT'))      define('PERCH_DEFAULT_EXT', '.php');
        if (!defined('PERCH_PRODUCTION_MODE'))  define('PERCH_PRODUCTION_MODE', 100);
        if (!defined('PERCH_HTML5'))            define('PERCH_HTML5', false);
        if (!defined('PERCH_RWD'))              define('PERCH_RWD', false);
        if (!defined('PERCH_HTML_ENTITIES'))    define('PERCH_HTML_ENTITIES', false);
        if (!defined('PERCH_SSL'))              define('PERCH_SSL', false);
        
        if (PERCH_DEBUG) $this->debug = true;
    }
    
    public static function fetch()
	{	    
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
	}
    
    public function get_page($request_uri=false, $hide_default_doc=false)
    {
        if ($request_uri) {
            $out = str_replace(PERCH_DEFAULT_DOC, '', strtolower($_SERVER['SCRIPT_NAME']));
            if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING']!='') {
                $out .= '?'.$_SERVER['QUERY_STRING'];
            }
            $out = preg_replace('/(\/)\\1+/', '/', $out);           
            return $out;
        }
        
        if ($this->page === false) {
            $this->page = strtolower($_SERVER['SCRIPT_NAME']);
        }
        
        if ($this->page != false) {
            $this->page = preg_replace('/(\/)\\1+/', '/', $this->page);
        }

        if ($hide_default_doc) {
            return str_replace(PERCH_DEFAULT_DOC, '', $this->page);
        }      
      
        return $this->page;
    }
    
    public function get_page_as_set($request_uri=false)
    {
        if (!$this->page_as_set) return $this->get_page($request_uri, true);
        
        return $this->page_as_set;
    }

    public function set_page($page)
    {
        $this->page        = $page;
        $this->page_as_set = $page;
    }
    
    public function find_installed_apps($CurrentUser)
    {
        return false;
    }
    
    public function dispatch_form($key, $post, $files)
    {
        $key      = base64_decode($key);
        $parts    = explode(':', $key);
        $formID   = $parts[0];
        $appIDs   = $parts[1];
        $template = $parts[2];

        if ($appIDs) {
            $appIDs = explode(' ', $appIDs);
            if (is_array($appIDs)) {
                foreach($appIDs as $appID) {
                    if (function_exists($appID.'_form_handler')) {
                        $API = new PerchAPI(1.0, $appID);
                        $SubmittedForm = $API->get('SubmittedForm');
                        $SubmittedForm->populate($formID, $template, $post, $files);
                        call_user_func($appID.'_form_handler', $SubmittedForm);
                    }else{
                        PerchUtil::debug($appID.' form handler not found.', 'error');
                    }
                }
            }
        }       
    }
    
    public function log_form_error($formID, $fieldID, $type="required")
    {
        if (!isset($this->form_errors[$formID])) $this->form_errors[$formID]=array();
        $this->form_errors[$formID][$fieldID] = $type;
    }
    
    public function get_form_errors($formID)
    {
        if (isset($this->form_errors[$formID])) return $this->form_errors[$formID];
        
        return false;
    }

    public function get_resource_bucket($bucket_name='default')
    {
        $bucket = array();

        // hardwire default, most common case
        $bucket['name']      = 'default';
        $bucket['web_path']  = PERCH_RESPATH;
        $bucket['file_path'] = PERCH_RESFILEPATH;

        if ($bucket_name && trim($bucket_name)!='' && $bucket_name!='default') {
            
            // try buckets file
            if ($this->bucket_list===false) {
                $bucket_list_file = PerchUtil::file_path(PERCH_PATH.'/config/buckets.php');
                if (file_exists($bucket_list_file)) {
                    $this->bucket_list = include ($bucket_list_file);
                    if ($this->bucket_list==false) $this->bucket_list = array();
                }else{
                    $this->bucket_list = array();
                }
            }
                                     
            if (PerchUtil::count($this->bucket_list) && isset($this->bucket_list[$bucket_name])) {
                $bucket = $this->bucket_list[$bucket_name];
                $bucket['name'] = $bucket_name;
                return $bucket;
            }         

            // not defined, so treat as a subfolder of resources
            $bucket['name']      = $bucket_name;
            $bucket['web_path']  .= '/'.$bucket_name;
            $bucket['file_path'] = PerchUtil::file_path($bucket['file_path'].'/'.$bucket_name);
        }

        return $bucket;
    }

    public function set_layout_vars($vars) 
    {
        if ($this->layout_depth > 1 && is_array($vars)) {
            $this->layout_vars = array_merge($this->layout_vars, $vars);
        }else{
            $this->layout_vars = $vars;    
        }      
    }

    public function get_layout_vars()
    {
        return $this->layout_vars;
    }

    public function get_layout_var($var)
    {
        if (isset($this->layout_vars[$var])) {
            return $this->layout_vars[$var];
        }

        return '';
    }    
}
