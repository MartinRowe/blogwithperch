<?php

class PerchForm
{
    var $html_encode    = true;
    
	var $required	= array();
	var $validate	= array();
	var $messages	= array();
	var $error		= false;
	
	var $display_only	= false;
	var $allow_edits	= true;
	var $name	 		= false;
	var $force_clear	= false;
	
	public $submitted_via_ajax = false;
	
	public $csrf_token     = false;
	
	var $fields		= array();
	
	public $translate_errors = true;


	function __construct($name=false, $display_only=false, $allow_edits=true, $use_session=true)
	{
		$Perch  = PerchAdmin::fetch();
		
		$this->name			= $name;
		$this->display_only = $display_only;
		$this->allow_edits 	= $allow_edits;
		
		if (isset($_GET['editform']) && $_GET['editform']==$this->name) {
			$this->display_only = false;
		}
		
		if (strpos($Perch->get_page(true), 'editform='.$this->name)>0) {
			$this->display_only = false;
		}
			
		if (!$allow_edits) {
			$this->display_only	= true;
		}
		
		// check csrf token
		if ($use_session) {
			if (PerchSession::is_set('csrf_token') && PerchSession::get('csrf_token')!='') {
			    $this->csrf_token = PerchSession::get('csrf_token');
			}else{
			    $this->csrf_token = md5(uniqid('csrf', true));
			    PerchSession::set('csrf_token', $this->csrf_token);
			}
		}

		if (isset($_POST['_perch_ajax']) && $_POST['_perch_ajax']=='1') {
		    $this->submitted_via_ajax = true;
		}
		
	}
	
	public function get_token()
	{
	    return $this->csrf_token;
	}
	
	
	public function set_name($name)
	{
	    $this->name = $name;
	}
	
	
	public function posted()
	{
		if (isset($_POST) && isset($_POST['formaction']) && $_POST['formaction'] == $this->name) {
		    // check csrf token
		    if (isset($_POST['token']) && $_POST['token']!='' && $_POST['token']==$this->csrf_token) {
    		    // generate new token
    		    $this->csrf_token = md5(uniqid('csrf', true));
    		    PerchSession::set('csrf_token', $this->csrf_token);
    		
    			$this->display_only(false);
    			
    			if (isset($_POST['_perch_ajax']) && $_POST['_perch_ajax']=='1') {
    			    $this->submitted_via_ajax = true;
    			}
    			return true;
    		}
		}
		return false;
	}

	public function required($id)
	{		
		$data	= $this->required;
				
		if (isset($data[$id])){
			return $data[$id];
		}
		
		return false;
	}
	
	public function message($id, $value)
	{
	    $translate = $this->translate_errors;
	    
		if ($this->error == true){
			if (trim($value) === ''){
				return ' <span class="error">' . ($translate ? $this->html(PerchLang::get($this->required($id))) : $this->html($this->required($id))) . '</span> ';
			}
			if (isset($this->messages[$id])){
				return ' <span class="error">' . ($translate ? $this->html(PerchLang::get($this->messages[$id])) : $this->html($this->messages[$id])) . '</span> ';
			}
		}
		
		return ' <span class="required">*</span> ';

		
	}
	
	public function error($id, $class=true)
	{
	    if ($this->error == true){
	        if ($this->required($id) && (!isset($_POST[$id]) || ($_POST[$id]) === '') && (!isset($_FILES[$id]) && !isset($_POST[$id.'_populated']))) {
	            if ($class) return ' class="error"';
	            return ' error';
	        }
	    }
	    
	    return '';
	}
	
	public function display_only($display_only=false) {
		$this->display_only = $display_only;
	}
	
	public function clear()
	{
		$this->force_clear	= true;
	}
	
	public function is_valid($id, $value)
	{
		$r= true;
		
		$args = array();
		if (isset($value[2])) $args = $value[2];
		
		switch ( $value[0] )
		{
			case 'email':
				$r	= $this->check_email($id, $args);
			break;
			
			case 'username':
				$r	= $this->check_username($id, $args);
			break;
			
			case 'password':
				$r	= $this->check_password($id, $args);
			break;
					
			default:
				# code...
			break;
		}
		
		if (!$r) $this->messages[$id]	= $value[1];
		return $r;
	}
	
	public function validate()
	{
		$this->error	= true;
		$r				= true;
		
		//check required
		foreach($this->required as $key => $value) {
			
			// check in POST
			if (!isset($_POST[$key]) || (is_string($_POST[$key]) && trim($_POST[$key])=='') || (is_array($_POST[$key]) && empty($_POST[$key]))){

				// check in FILES
				if (!isset($_FILES[$key]) && !isset($_POST[$key.'_populated'])) {
					$r	= false;	
				}
			}
		}
		
		//run validations
		foreach($this->validate as $key => $value) {
			if (isset($_POST[$key]) && !$_POST[$key]==''){
				if (!$this->is_valid($key, $value)) {
				 	$r	= false;
				}
			}	
		}

		
		if ($r) $this->error = false;
	
		return $r;
	}

	public function set_required($data, $replace=true)
	{
		if ($replace) {
			$this->required	= $data;	
		}else{
			$this->required	= array_merge($this->required, $data);
		}
		
	}
	
	public function set_validation($data)
	{
		$this->validate = $data;
	}
	
	private function check_password($id, $args)
	{
	    
		$str 	= $_POST[$id];
		$str2	= $_POST[$id.'2'];
		
		if ($str != $str2){
			return false;
		}
		return true;
	}
	
	private function check_email($id, $args)
	{
		$email 	= $_POST[$id];
		
		$Users = new PerchUsers;
		
		// check for a passed in UserID
		// so that a user can be excluded from the check
		// (so we don't prevent editing of a record)
		if (isset($args['userID'])) {
		    $exclude_userID = $args['userID'];
		}else{
		    $exclude_userID = false;
		}
		
		if (!PerchUtil::is_valid_email($email) || PerchUtil::contains_bad_str($email) || !$Users->email_available($email, $exclude_userID)){
			return false;
		}
		return true;
	}
    
    private function check_username($id, $args)
	{
		$str 	= $_POST[$id];
		
		$Users = new PerchUsers;
		
		// check for a passed in UserID
		// so that a user can be excluded from the check
		// (so we don't prevent editing of a record)
		if (isset($args['userID'])) {
		    $exclude_userID = $args['userID'];
		}else{
		    $exclude_userID = false;
		}
		
		if (!$Users->username_available($str, $exclude_userID)){
			return false;
		}
	
		
		return true;
	}
    

	public function get($array, $key, $default='', $POSTprefix=false)
	{
		if ($POSTprefix) {
			$postkey	= $POSTprefix.$key;
		}else{
			$postkey	= $key;
		}
		
		if (isset($_POST[$postkey])){
			return $_POST[$postkey];
		}else{
			if (isset($array) && isset($array[(string)$key])){
				return $array[(string)$key];
			}
		}
		
		// is it a date?
		$d = $this->get_date($postkey);
		if ($d!=false) return $d;
		
		return $default;
	}
	
	public function find_items($prefix, $keys_only=false)
	{
		$out	= array();
		
		foreach($_POST as $key=>$val) {
			
			if (strpos($key, $prefix)===0) {
				$key	= str_replace($prefix, '', $key);
				if ($keys_only) {
				    $out[]  = $key;
				}else{
				    $out[$key]	= $val;  
				}
				
			}
			
		}
		
		return $out;
		
	}
	
	public function hint($txt, $classname=false)
	{
 		return '<span class="hint'.($classname ? ' '.$classname : '').'">'.$this->html($txt).'</span>';
	}

	public function label($id, $txt, $class='', $colon=false, $translate=true)
	{
	    if ($translate) $txt = PerchLang::get($txt);
	    
		if ($this->display_only) return '<span class="label">'.$this->html($txt).($colon?':':'').'</span>';
		
		return '<label for="'.$this->html($id, true).'" class="'.$this->html($class, true).'">'.$this->html($txt, true).($colon?':':'') . '</label>';
	}
	
	public function text($id, $value='', $class='', $limit=false, $type='text', $attributes='')
	{
		$this->fields[] = $id;
		
		if ($this->display_only) return $this->html($this->value($value));
		
		if ($limit !== false) {
		    $limit = ' maxlength="'.intval($limit).'"';
		}else{
		    $limit = '';
		}
		
		if ($this->required($id)){
			$attributes .= ' required="required" ';
		}
		
		$s	= '<input type="'.$type.'" id="'.$this->html($id, true).'" name="'.$this->html($id, true).'" value="'.$this->html($this->value($value), true).'"'.$attributes.' class="'.$type.' '.$this->html($class, true).'"'.$limit.' />';
	
		if ($this->required($id)){
			$s	.= $this->message($id, $value);
		}
		
		return $s;
	}
	
	public function email($id, $value='', $class='', $limit=false)
	{
	    return $this->text($id, $value, $class, $limit=false, 'text email');
	}
	
    public function url($id, $value='', $class='', $limit=false)
    {
        return $this->text($id, $value, $class, $limit=false, 'text url');
    }
    
    public function color($id, $value='', $class='', $limit=false)
    {
        return $this->text($id, $value, $class, $limit=false, 'color');
    }

    public function tags($id, $value='', $class='', $limit=false)
    {
        return $this->text($id, $value, $class, $limit=false, 'text tags');
    }

	public function password($id, $value='', $class='')
	{
		$this->fields[] = $id;
		
		if ($this->display_only) return $this->html($value);
		
		$s	= '<input type="password" id="'.$this->html($id, true).'" name="'.$this->html($id, true).'" value="'.$this->html($this->value($value), true).'" class="text '.$this->html($class, true).'" />';
	
		if ($this->required($id) || isset($this->messages[$id])){
			$s	.= $this->message($id, $value);
		}
		
		return $s;
	}
	
	public function hidden($id, $value='', $skip_id=false)
	{
		$this->fields[] = $id;
		
		if ($this->display_only) return '';
		
		if ($skip_id) {
		    $s	= '<input type="hidden" name="'.$this->html($id, true).'" value="'.$this->html($value, true).'" />';
		}else{
		    $s	= '<input type="hidden" id="'.$this->html($id, true).'" name="'.$this->html($id, true).'" value="'.$this->html($value, true).'" />';
		}

		return $s;
	}


	public function select($id, $array, $value, $class='', $multiple=false)
	{
		if ($multiple) $id .= '[]';
			
		$this->fields[] = $id;
		if ($this->display_only && trim($value)=='') return 'No selection';
		
		$s	= '<select id="'.$this->html($id, true).'" name="'.$this->html($id, true).'" class="'.$this->html($class, true).'"'.($multiple ? 'multiple="multiple"':'').'>';
		
		for ($i=0; $i<PerchUtil::count($array); $i++){
			$s .= '<option value="'.$this->html($array[$i]['value'], true).'"';
			
			if (is_array($value)) {
				if (in_array($array[$i]['value'], $this->value($value))){
					$s .= ' selected="selected"';
				}
			}else{
				if ($array[$i]['value'] == $this->value($value)){
					$s .= ' selected="selected"';
				}	
			}
			
			
			if (isset($array[$i]['disabled']) && $array[$i]['disabled']) {
    		    $s .= ' disabled="disabled"';
    		}
			
			$s .='>'.$this->html($array[$i]['label']).'</option>';
			
			if ($this->display_only && $array[$i]['value'] == $value) {
				return $this->html($array[$i]['label']);
			}
		}
		
		$s	.= '</select>';
		
		if ($this->required($id)){
			$s	.= $this->message($id, $value);
		}
		
		
		return $s;
	}
	
	
	function grouped_select($id, $groups, $value, $class='')
	{
			
		$this->fields[] = $id;
		if ($this->display_only && trim($value)=='') return 'No selection';
		
		$s	= '<select id="'.$this->html($id, true).'" name="'.$this->html($id, true).'" class="'.$this->html($class, true).'">';
		
		foreach($groups as $group_name=>$array) {
		
		    $s .= '<optgroup label="'.$this->html($group_name, true).'">';
		    
    		for ($i=0; $i<PerchUtil::count($array); $i++){
    			$s .= '<option value="'.$this->html($array[$i]['value'], true).'"';
			
    			if ($array[$i]['value'] == $this->value($value)){
    				$s .= ' selected="selected"';
    			}
			
    			$s .='>'.$this->html($array[$i]['label']).'</option>';
			
    			if ($this->display_only && $array[$i]['value'] == $value) {
    				return $this->html($array[$i]['label']);
    			}
    		}
    		
    		$s .= '</optgroup>';
    	}
		
		$s	.= '</select>';
		
		if ($this->required($id)){
			$s	.= $this->message($id, $value);
		}
	
		return $s;
	}
	
	
	
	
	public function datepicker($id, $value=false, $field_order='dmy', $allowempty=false)
	{
		$this->fields[] = $id;
		
		if ($this->display_only){
			if ($value) { 
				return strftime('%d %b %Y', strtotime($value));
			}else{
				return '';
			}
		}
		
		$s	 = '';

		$fields = array();
				
		$value	= ($this->value($value) ? $this->value($value) : strftime('%Y-%m-%d'));

		$d			= array();
		$d['day']	= strftime('%d', strtotime($value));
		$d['month']	= strftime('%m', strtotime($value));
		$d['year']	= strftime('%Y', strtotime($value));

		// Day
		$days	= array();
		if ($allowempty) $days[] = array('label'=>'', 'value'=>'');
		for ($i=1; $i<32; $i++) $days[]	= array('label'=>PerchUtil::pad($i), 'value'=>PerchUtil::pad($i));
		$fields['d'] = $this->select($id.'_day', $days, $d['day']);
		
		// Month
		$months	= array();
		if ($allowempty) $months[] = array('label'=>'', 'value'=>'');
		for ($i=1; $i<13; $i++) $months[]	= array('label'=>strftime('%b', strtotime('2007-'.PerchUtil::pad($i).'-01')), 'value'=>PerchUtil::pad($i));
		$fields['m']	= $this->select($id.'_month', $months, $d['month']);
		
		// Year
		$years	= array();
		if ($allowempty) $years[] = array('label'=>'', 'value'=>'');
		for ($i=strftime('%Y')-100; $i<strftime('%Y')+11; $i++) $years[]	= array('label'=>$i, 'value'=>$i);
		$fields['y']	= $this->select($id.'_year', $years, $d['year']);
		

		for($i=0;$i<strlen($field_order); $i++) {
			if (isset($fields[$field_order[$i]])) {
				$s .= $fields[$field_order[$i]];	
			}
		}
		
		
		return $s;
		
		
	}
	
    public function datetimepicker($id, $value=false, $field_order='dmy', $allowempty=false)
    {
        $this->fields[] = $id;
        
        if ($this->display_only){
            if ($value) { 
                return strftime('%d %b %Y %H:%M', strtotime($value));
            }else{
                return '';
            }
        }
        
        $s   = '';

        $fields = array();
                
        $value  = ($this->value($value) ? $this->value($value) : strftime('%Y-%m-%d %H:%M'));

        $d          = array();
        $d['day']   = strftime('%d', strtotime($value));
        $d['month'] = strftime('%m', strtotime($value));
        $d['year']  = strftime('%Y', strtotime($value));
        $d['hour']  = strftime('%H', strtotime($value));
        $d['minute']= strftime('%M', strtotime($value));
        
        // Day
        $days   = array();
        if ($allowempty) $days[] = array('label'=>'', 'value'=>'');
        for ($i=1; $i<32; $i++) $days[] = array('label'=>PerchUtil::pad($i), 'value'=>PerchUtil::pad($i));
        $fields['d'] = $this->select($id.'_day', $days, $d['day']);
        
        // Month
        $months = array();
        if ($allowempty) $months[] = array('label'=>'', 'value'=>'');
        for ($i=1; $i<13; $i++) $months[]   = array('label'=>strftime('%b', strtotime('2007-'.PerchUtil::pad($i).'-01')), 'value'=>PerchUtil::pad($i));
        $fields['m'] = $this->select($id.'_month', $months, $d['month']);
        
        // Year
        $years  = array();
        if ($allowempty) $years[] = array('label'=>'', 'value'=>'');
        for ($i=strftime('%Y')-100; $i<strftime('%Y')+11; $i++) $years[]    = array('label'=>$i, 'value'=>$i);
        $fields['y'] = $this->select($id.'_year', $years, $d['year']);
        
		for($i=0;$i<strlen($field_order); $i++) {
			if (isset($fields[$field_order[$i]])) {
				$s .= $fields[$field_order[$i]];	
			}
		}


        $s  .= ' : ';
        
        // Hours
        $hours  = array();
        if ($allowempty) $hours[] = array('label'=>'', 'value'=>'');
        for ($i=0; $i<24; $i++) $hours[]    = array('label'=>PerchUtil::pad($i), 'value'=>PerchUtil::pad($i));
        $s      .= $this->select($id.'_hour', $hours, $d['hour']);
        
        // Minutes
        $minutes    = array();
        if ($allowempty) $minutes[] = array('label'=>'', 'value'=>'');
        for ($i=0; $i<60; $i++) $minutes[]  = array('label'=>PerchUtil::pad($i), 'value'=>PerchUtil::pad($i));
        $s      .= $this->select($id.'_minute', $minutes, $d['minute']);
        
        
        return $s;
        
        
    }
    
    public function timepicker($id, $value=false)
    {
        $this->fields[] = $id;
        
        if ($this->display_only){
            if ($value) { 
                return strftime('%H:%M', strtotime($value));
            }else{
                return '';
            }
        }
        
        $s   = '';
                
        $value  = ($this->value($value) ? $this->value($value) : strftime('%H:%M'));

        $d          = array();
        $d['hour']  = strftime('%H', strtotime($value));
        $d['minute']= strftime('%M', strtotime($value));
    
        // Hours
        $hours  = array();
        for ($i=0; $i<24; $i++) $hours[]    = array('label'=>PerchUtil::pad($i), 'value'=>PerchUtil::pad($i));
        $s      .= $this->select($id.'_hour', $hours, $d['hour']);
        
        // Minutes
        $minutes    = array();
        for ($i=0; $i<60; $i++) $minutes[]  = array('label'=>PerchUtil::pad($i), 'value'=>PerchUtil::pad($i));
        $s      .= $this->select($id.'_minute', $minutes, $d['minute']);

        
        return $s;    
    }
    
	public function checkbox($id, $value, $checked, $class='', $group=false, $disabled=false)
	{
		$this->fields[] = $id;
		
		if (!$group){
		    $group=$id;
		}else{
		    $group = $group.'[]';
		}
		
		if ($this->display_only){
			if ($value == $checked){
				return 'Yes';
			}else{
				return 'No';
			}
		}
		
		$s	= '<input type="checkbox" class="check '.$this->html($class, true).'" id="'.$this->html($id, true).'" name="'.$this->html($group, true).'" value="'.$this->html($this->value($value), true).'"';

		if ($value == $checked){
			$s .= ' checked="checked"';
		}

		if ($disabled) {
			$s .= ' disabled="disabled"';
		}
		

		
		$s .= ' />';
		
		
		
		return $s;
	}
	
	public function checkbox_set($id, $label=false, $options, $values=array(), $class='', $limit=false, $container_class=false)
    {
    	/* 
    	Note:
    		$class and $limit aren't used. They exist to maintain argument consistancy 
    		between this and the older PerchAPI_Form::checkbox_set method
    	*/

        $out = '';
        
        $out .= '<fieldset class="checkboxes '.($container_class ? ' '.$container_class: '').'">';
        if ($label!==false) $out .= '<strong>'.$this->html(PerchLang::get($label)).'</strong>';
        
        $i = 0;
        
        foreach($options as $option) {
            $boxid = $id.'_'.$i;
            $checked_value = false;
            if (in_array($option['value'], $values)){
                $checked_value = $option['value'];
            }
            if (PerchUtil::count($_POST)) {
                $checked_value = false;
                if (isset($_POST[$id]) && is_array($_POST[$id])) {
                    if (in_array($option['value'], $_POST[$id])) {
                        $checked_value = $option['value'];
                    }
                }
            }

            if (!isset($option['disabled'])) {
            	$option['disabled'] = false;
            }
            
            $out .= '<div class="checkbox">';
            $out .= $this->checkbox($boxid, $option['value'], $checked_value, (isset($option['class']) ? $option['class'] : false), $id, $option['disabled']);
            $out .= $this->label($boxid, $option['label'], '', $colon=false, $translate=false);
            $out .= '</div>';
            $i++;
        }
        
        
        $out .= '</fieldset>';
        
        return $out;
    }
	
	public function radio($id, $group, $value, $checked, $class='')
	{
		$this->fields[] = $id;
		
		if ($this->display_only){
			if ($value == $checked){
				return 'Yes';
			}else{
				return 'No';
			}
		}
		
		$s	= '<input type="radio" class="check '.$this->html($class, true).'" id="'.$this->html($id, true).'" name="'.$this->html($group, true).'" value="'.$this->html($this->value($value), true).'"';

		if ($value == $checked){
			$s .= ' checked="checked"';
		}
		
		$s .= ' />';
		
		
		
		return $s;
	}
	
	public function textarea($id, $value='', $class='', $data_attributes=false)
	{
		$this->fields[] = $id;
		
		if ($this->display_only) return nl2br($this->html($value));
		
		$data = '';
		if (PerchUtil::count($data_attributes)) {
		    foreach($data_attributes as $key=>$val) {
		        $data .= ' data-'.$key.'="'.$this->html($val, true).'"';
		    }
		}
		
		$s	= '<textarea id="'.$this->html($id, true).'" name="'.$this->html($id, true).'"  class="text '.$this->html($class, true).'"'.$data.' rows="6" cols="40">'.$this->html($this->value($value)).'</textarea>';
	
		if ($this->required($id)){
			$s	.= $this->message($id, $value);
		}
		
		return $s;
	}
	
	public function submit($id, $value, $class=false, $translate=true, $use_button=false)
	{
		$Perch  = PerchAdmin::fetch();
		
		if ($this->display_only) {
			if ($this->allow_edits) {
				$segments	= str_replace('/editform='.$this->name, '', split('/', $Perch->get_page(true)));
				$segments[]	= 'editform='.$this->name;
				$url		= implode('/', $segments);
				$url		= str_replace('//', '/', $url);
			
				return '<a href="'.$url.'" class="button" id="'.$this->html($id, true).'">Edit</a>';
			}
			
			return '';
		
		}
		
		if ($translate)  {
		    $value = PerchLang::get($value);
		}
		
		if ($use_button) {
		    $s = '<button type="submit" name="'.$this->html($id, true).'" id="'.$this->html($id, true).'" value="'.$this->html($value, true).'" class="'.$this->html($class, true).'"><span></span>'.$this->html($value, true).'</button>';
		}else{
		    $s = '<input type="submit" name="'.$this->html($id, true).'" id="'.$this->html($id, true).'" value="'.$this->html($value, true).'" class="'.$this->html($class, true).'" />';
		}
		
		
		$s .= '<input type="hidden" name="formaction" value="'.$this->html($this->name, true).'" />';
		$s .= '<input type="hidden" name="token" value="'.$this->html(PerchSession::get('csrf_token'), true).'" />';
		
		return $s;
	}
	
	public function image($id, $value='', $basePath='', $class='')
	{
		if ($this->display_only) {
			if ($value) return '<img src="'.$this->html($basePath . $value, true).'" />';
			return '';
		}
		
		$s	= '<input type="file" id="'.$this->html($id, true).'" name="'.$this->html($id, true).'" value="'.$this->html($this->value($value), true).'" class="'.$this->html($class, true).'" />';
	
		if ($this->required($id)){
			$s	.= $this->message($id, $value);
		}
		
		return $s;
	}
	
	public function get_date($id, $postitems=false)
	{        
		$out	= '';
		
		if ($postitems === false) $postitems = $_POST;
		
		$day	= (isset($postitems[$id . '_day'])    ? $postitems[$id . '_day']    : false);
		$month	= (isset($postitems[$id . '_month'])  ? $postitems[$id . '_month']  : false);
		$year	= (isset($postitems[$id . '_year'])   ? $postitems[$id . '_year']   : false);
		$hour	= (isset($postitems[$id . '_hour'])   ? $postitems[$id . '_hour']   : false);
		$minute	= (isset($postitems[$id . '_minute']) ? $postitems[$id . '_minute'] : false);
		
		if ($day!==false && $month!==false && $year!==false) {
			$out = "$year-$month-$day";
			
			if ($hour!==false && $minute!==false) {
				$out .= ' ' . PerchUtil::pad($hour) . ':' . PerchUtil::pad($minute) . ':00';
			}
			
			return $out;
		}else if($hour!==false && $minute!==false) {
		    $out = PerchUtil::pad($hour) . ':' . PerchUtil::pad($minute) . ':00';
		    
		    return $out;
		}
	
		return false;
	}
	


		
	public function check_alpha($id)
	{
		$str 	= $_POST[$id];
		if (preg_match('/^[A-Za-z0-9_]*$/', $str)==0){
			return false;
		}
		return true;
	}


		
	public function show_fields()
	{
		$s 	= '<textarea rows="16" cols="80">';
		
		$s 	.= '$req = array();' . "\n";
		
		if (is_array($this->fields)) {
			foreach ($this->fields as $field){
				$a[] = "'" . $field . "'";
			
				$s	.= '$req[\''.$field.'\'] = "Required";' . "\n";
			}
		}
		$s	.= '$Form->set_required($req);' . "\n";
		
		$s  .= 'if ($Form->posted() && $Form->validate()) {' . "\n";
		
		$s	.=  "\t" . '$postvars = array('.implode(', ', $a) . ');' . "\n";
		$s  .= "\t" .  '$data = $Form->receive($postvars);' . "\n";

		$s  .= '}' . "\n";
		
		$s  .= '</textarea>';
		return $s;
	}
	
	public function action()
	{
		$Perch  = PerchAdmin::fetch();
		$url = $Perch->get_page(true);
		
		$url = str_replace('created=true&', '', $url);
		$url = str_replace('&created=true', '', $url);
		$url = str_replace('created=true', '', $url);
		
		return $url;
	}
	
	private function value($value)
	{
		if ($this->force_clear) return '';
		if (is_array($value)) return $value;
		return stripslashes($value);
	}
	
	public function scaffold($DB, $table, $prefix)
	{
		$cols	= $DB->get_table_meta($table);
		
		$s = '';
		
		if (is_array($cols)) {
			foreach($cols as $col) {
				
				if ($col->name != $prefix.'ID') {
				
					$s	.= '<div>' . "\n";
				
					$s	.= "\t" . '<' . '?php echo $Form->label(\'' . $col->name . '\', \'' . str_replace($prefix, '', $col->name) . '\'); ?' . '>' . "\n";
					
					switch ($col->type) {
						case 'blob':
							$s	.= "\t" . '<' . '?php echo $Form->textarea(\'' . $col->name . '\', $Form->get(@$details, \'' . $col->name . '\'), \'large\'); ?' . '>' . "\n";
							break;
						
						default:
							$s	.= "\t" . '<' . '?php echo $Form->text(\'' . $col->name . '\', $Form->get(@$details, \'' . $col->name . '\')); ?' . '>' . "\n";
							break;
					}				
					
				
					$s	.= '</div>' . "\n\n";
				}
				
			}
		}
	
	
		return '<textarea rows="16" cols="80">' . $s . '</textarea>';
		
	}
	
	public function receive($postvars)
	{
	    $data = array();
	    foreach($postvars as $val){
	        if (isset($_POST[$val])) {
	            if (!is_array($_POST[$val])){
	                $data[$val]	= trim($_POST[$val]);
	            }else{
	                $data[$val]	= $_POST[$val];
	            }
	        }
	    } 
	    
	    return $data;
	}
	
	public function field_completed($field)
	{
	    if (isset($_POST[$field]) && $_POST[$field] != '') {
	        return true;
	    }
	    
	    return false;
	}
	
	private function html($str, $quotes=false)
	{
	    if ($this->html_encode) {
	        return PerchUtil::html($str, $quotes);
	    }else{
	        return $str;
	    }   
	}
	
	public function disable_html_encoding()
	{
	    $this->html_encode  = false;
	}
	
	public function enable_html_encoding()
	{
	    $this->html_encode  = true;
	}
	
	public function enctype()
	{
	    return 'enctype="multipart/form-data"';
	}
	
	public function reset()
	{
    	$this->messages	= array();
    	$this->error	= false;
	}

	public function reset_field($id)
	{
    	if (isset($_POST[$id])) {
    		$_POST[$id] = '';
    	}
	}
}


?>