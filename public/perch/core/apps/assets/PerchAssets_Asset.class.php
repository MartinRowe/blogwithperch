<?php

class PerchAssets_Asset extends PerchBase
{
    protected $table  = 'resources';
    protected $pk     = 'resourceID';

    private $bucket = false;
    private static $image_types  = array('jpg', 'png', 'gif', 'svg', 'jpeg', 'webp');
    private static $doc_types    = array('doc', 'docx', 'pdf', 'odt', 'fodt', 'epub', 'mobi', 'docm', 'rtf', 'txt', 'uof', 'wpd', 'wri');
    private static $sheet_types  = array('xls', 'csv', 'ods', 'fods', 'xlsx');
    private static $audio_types  = array('mp3', 'wav', 'ogg', 'flac', 'm4a', 'wma', 'aiff', 'mp2', 'spx', 'ra', 'rm', 'mid');
    private static $video_types  = array('mp4', 'mov', 'webm', 'ogv', 'aff', '3gp', 'asf', 'avi', 'flv', 'mpeg', 'mpg', 'wmv');
    private static $pres_types   = array('ppt', 'pps', 'odp', 'fodp', 'key', 'pez', 'pptx', 'pot', 'opt');

    public static function get_type_map()
    {
        return array(
            'img'   => array('label'=>PerchLang::get('Images'), 'exts'=>self::$image_types),
            'doc'   => array('label'=>PerchLang::get('Documents'), 'exts'=>self::$doc_types),
            'sheet' => array('label'=>PerchLang::get('Spreadsheets'), 'exts'=>self::$sheet_types),
            'audio' => array('label'=>PerchLang::get('Audio'), 'exts'=>self::$audio_types),
            'video' => array('label'=>PerchLang::get('Video'), 'exts'=>self::$video_types),
            'pres'  => array('label'=>PerchLang::get('Presentations'), 'exts'=>self::$pres_types),
            );

    }

    public function thumb_url()
    {
    	if ($this->thumb()) {
    		$Perch = Perch::fetch();
    		$bucket = $Perch->get_resource_bucket($this->resourceBucket());
    		return $bucket['web_path'].'/'.$this->thumb();
    	}

        if ($this->is_svg()) {
            $Perch = Perch::fetch();
            $bucket = $Perch->get_resource_bucket($this->resourceBucket());
            return $bucket['web_path'].'/'.$this->resourceFile();
        }
    }

    public function thumb()
    {
        if (isset($this->details['thumb']) && $this->details['thumb']!='') return $this->details['thumb'];
        return false;
    }

    public function display_width()
    {
        return floor($this->resourceWidth() / $this->resourceDensity());
    }

    public function display_height()
    {
        return floor($this->resourceHeight() / $this->resourceDensity());
    }

    public function thumb_display_width()
    {
        if ($this->is_svg()) return $this->display_width();


        if (!isset($this->details['thumbWidth']) || !isset($this->details['thumbDensity'])) return false;

        return $this->thumbWidth();

        return floor($this->thumbWidth() / $this->thumbDensity());
    }

    public function thumb_display_height()
    {
        if ($this->is_svg()) return $this->display_height();

        if (!isset($this->details['thumbHeight']) || !isset($this->details['thumbDensity'])) return false;

        return $this->thumbHeight();

        return floor($this->thumbHeight() / $this->thumbDensity());
    }

    public function get_type()
    {
        $type = strtolower($this->resourceType());

        if (in_array($type, self::$image_types))  return 'image';
        if (in_array($type, self::$doc_types))    return 'doc';
        if (in_array($type, self::$sheet_types))  return 'sheet';
        if (in_array($type, self::$audio_types))  return 'audio';
        if (in_array($type, self::$video_types))  return 'video';
        if (in_array($type, self::$pres_types))   return 'pres';

        return 'doc';
    }

    static function get_type_from_filename($filename)
    {
        $type = strtolower(PerchUtil::file_extension($filename));
        
        if (in_array($type, self::$image_types))  return 'image';
        if (in_array($type, self::$doc_types))    return 'doc';
        if (in_array($type, self::$sheet_types))  return 'sheet';
        if (in_array($type, self::$audio_types))  return 'audio';
        if (in_array($type, self::$video_types))  return 'video';
        if (in_array($type, self::$pres_types))   return 'pres';

        return 'doc';
    }

    public function is_svg()
    {
        return strtolower($this->resourceType())=='svg';
    }



    public function reindex()
    {
        if ($this->exists()) {
            $data = array();

            // Title
            if ($this->resourceKey()=='orig' && $this->details['resourceTitle']=='') {
                $data['resourceTitle'] = $this->get_title_from_filename();
            }

            // Meta
            if ($this->resourceFileSize()==0) {
                $meta = $this->get_meta();
                if (is_array($meta)) {
                    $data = array_merge($data, $meta);
                }
            }

            if (count($data)) {
                $this->update($data);
            }
        }else{
            $this->mark_as_awol();
        }
    }

    /**
     * Flag this resource as having a missing file 
     * @return [type] [description]
     */
    public function mark_as_awol()
    {
        $this->update(array(
            'resourceAWOL' => 1,
            ));

        return true;
    }

    public function mark_as_library()
    {
        $this->update(array('resourceInLibrary'=>'1'));

        // children
        $Assets = new PerchAssets_Assets($this->api);
        $Assets->mark_children_as_library($this->id());
    }

    /**
     * Does the file exist on the file system?
     * Initially just proxies file_exists() but will get more complex with CDN support
     * 
     * @return [type] [description]
     */
    protected function exists() 
    {
        return file_exists($this->file_path());
    }

    /**
     * Get the file system path for the file
     * @return [type] [description]
     */
    public function file_path()
    {
        $bucket = $this->get_bucket();
        return PerchUtil::file_path($bucket['file_path'].'/'.$this->resourceFile());
    }

    /**
     * Get the web path for the file
     * @return [type] [description]
     */
    public function web_path()
    {
        $bucket = $this->get_bucket();
        return $bucket['web_path'].'/'.$this->resourceFile();
    }

    /**
     * Get the (cached) resource bucket details
     * @return [type] [description]
     */
    public function get_bucket()
    {
        if ($this->bucket) return $this->bucket;

        $Perch  = Perch::fetch();
        $this->bucket = $Perch->get_resource_bucket($this->resourceBucket());

        return $this->bucket;
    }

    /**
     * Attempt to construct a nice(ish) looking title from the file name
     * @return [type] [description]
     */
    public function get_title_from_filename()
    {
        $s = $this->resourceFile();
        $s = PerchUtil::strip_file_extension($s);
        return PerchUtil::filename($s, false);
    }

    /**
     * Get the file size, and other meta like dimensions for images
     * @return [type] [description]
     */
    public function get_meta()
    {
        $file_path = $this->file_path();
        $out = array();
        $out['resourceFileSize'] = filesize($file_path);

        if ($this->is_image() && $out['resourceFileSize']>0) {
            $Image = new PerchImage;

            $out['resourceCrop'] = 0;

            if ($this->resourceType()=='svg') {
                $info = $Image->get_svg_size($file_path);
            }else{
                PerchUtil::debug('Get image size: '. $file_path);
                $info = getimagesize($file_path);
            }

            if ($info) {
               $out['resourceWidth']    = $info[0]; 
               $out['resourceHeight']   = $info[1]; 
            }

            if ($info && isset($info['mime'])) {
               $out['resourceMimeType'] = $info['mime'];
            }else{
               $out['resourceMimeType'] = PerchUtil::get_mime_type($this->file_path());
            }


            // get target info from file name
            $targets = $Image->parse_file_name($this->resourceFile());
            if ($targets) {
                if (isset($targets['w'])) $out['resourceTargetWidth']  = $targets['w']; 
                if (isset($targets['h'])) $out['resourceTargetHeight'] = $targets['h']; 
                if (isset($targets['c'])) $out['resourceCrop']         = $targets['c']; 
                
                if (isset($targets['d'])) {
                    $out['resourceDensity']  = $targets['d']; 

                    $out['resourceWidth']    = $out['resourceWidth']/$targets['d']; 
                    $out['resourceHeight']   = $out['resourceHeight']/$targets['d'];

                    PerchUtil::debug('Yes'); 
                }

            }

            if (isset($out['resourceWidth']) && isset($out['resourceTargetWidth']) && isset($out['resourceHeight']) && isset($out['resourceTargetHeight'])) {
                if ($out['resourceWidth']==$out['resourceTargetWidth'] && $out['resourceHeight']==$out['resourceTargetHeight']){
                    $out['resourceCrop'] = '1';
                }
            }
        }else{
            $out['resourceMimeType'] = $this->get_mime_type();
        }

        if (isset($out['resourceWidth']))  $out['resourceWidth']  = (int)$out['resourceWidth'];
        if (isset($out['resourceHeight'])) $out['resourceHeight'] = (int)$out['resourceHeight'];

        return $out;
    }

    /**
     * Is this resource an image? Yes or no. That's all I need.
     * @return boolean [description]
     */
    public function is_image()
    {
        return in_array(strtolower($this->resourceType()), self::$image_types);
    }

    /**
     * A sanitised version of to_array for the JSON api
     * @return [type] [description]
     */
    public function to_api_array()
    {
        $data = $this->to_array();

        $out  = array();
        foreach($data as $key=>$value) {
            if (substr($key, 0, 8)=='resource') {
                $key = substr($key, 8);
            }
            $key = strtolower($key);
            $out[$key] = $value;
        }

        $type = strtoupper($out['type']);

        $out['type']         = $this->get_type();
        $out['mime_display'] = $this->display_mime();

        $out['thumburl']    = $this->thumb_url();
        $out['thumbwidth']  = $this->thumb_display_width();
        $out['thumbheight'] = $this->thumb_display_height();

        $out['has_thumb'] = ($out['thumb']? true : false);
       

        $out['display_filesize'] = $this->file_size();


        return $out;
    }

    public function file_size()
    {
        $size = $this->resourceFileSize();

        if ($size < 1048576) {
            $size = round($size/1024, 0).'KB';
        }else{
            $size = round($size/1024/1024, 0).'MB';
        }

        return $size;
    }

    public function display_mime()
    {
        return ucfirst($this->get_type() .' / '.strtoupper($this->resourceType()));
    }

    


    public function get_fieldtype_profile()
    {
        $out = array();
        $Assets = new PerchAssets_Assets();
        $Thumb = $Assets->get_thumb($this->id());

        $out['assetID'] = $this->id();
        $out['title'] = $this->resourceTitle();
        $out['bucket'] = $this->resourceBucket();
        $out['sizes'] = array();
        $out['size'] = $this->resourceFileSize();

        if ($Thumb) {
            $out['sizes']['thumb'] = array();
            $out['sizes']['thumb']['w'] = $Thumb->resourceWidth();
            $out['sizes']['thumb']['h'] = $Thumb->resourceHeight();
            $out['sizes']['thumb']['web_path'] = $Thumb->web_path();
            $out['sizes']['thumb']['path'] = $Thumb->resourceFile();
        }

        return $out;

    }

    public function in_use() 
    {
        $sql = 'SELECT COUNT(*) FROM '.PERCH_DB_PREFIX.'resource_log WHERE resourceID='.$this->db->pdb($this->id());
        $count = $this->db->get_count($sql);

        return ($count > 0);
    }


}