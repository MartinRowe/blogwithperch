<?php

class PerchCategories_Categories extends PerchFactory
{
	protected $singular_classname = 'PerchCategories_Category';
	protected $table              = 'categories';
	protected $pk                 = 'catID';
	protected $namespace 		  = 'category';
	protected $event_prefix       = 'category';
	
	protected $default_sort_column  = 'catTreePosition';  

	public $static_fields   = array('catTitle', 'catSlug');

	private $from_ids_cache = array();

	public function create($data)
	{
		$Category = parent::create($data);
		if (is_object($Category)) {
			$Category->update_tree_position();	
		}
		return $Category;
	}

	public function find_or_create($catPath, $label=false)
	{
		$Cat = $this->get_one_by('catPath', $catPath);

		if (is_object($Cat)) return $Cat;

		$path_parts = explode('/', $catPath);
		$setSlug = array_shift($path_parts);
		array_pop($path_parts);
		$catSlug = array_pop($path_parts);

		$Sets = new PerchCategories_Sets($this->api);
		$Set = $Sets->get_one_by('setSlug', $setSlug);

		if (is_object($Set)) {
			$data = array(
				'setID'       => $Set->id(),
				'catTitle'    => $label,
				'catSlug'     => $catSlug,
				'catPath'     => $catPath,
				'catParentID' => 0,
				);	
			$Cat = $this->create($data);

			return $Cat;
		}

		return false;
	}

	public function get_tree($setID)
	{
	    $sql = 'SELECT c.*, (SELECT COUNT(*) FROM '.$this->table.' WHERE catParentID=c.catID) AS subcats 
	            FROM '.$this->table.' c
	            WHERE setID='.$this->db->pdb($setID).'
	            ORDER BY catTreePosition ASC';
	    $rows   = $this->db->get_rows($sql);
	    
	    return $this->return_instances($rows);
	}

	public function get_by_parent($parentID, $setID)
	{
	    $sql = 'SELECT * FROM '.$this->table.'
	            WHERE catParentID='.$this->db->pdb($parentID).'
	            		AND setID='.$this->db->pdb($setID).'
	            ORDER BY catTreePosition ASC'; 
		        
		$rows   = $this->db->get_rows($sql);	
		return $this->return_instances($rows);
	}

	public function get_for_set($setSlug)
	{
		$sql = 'SELECT * FROM '.$this->table.' c, '.PERCH_DB_PREFIX.'category_sets s
				WHERE c.setID=s.setID AND s.setSlug='.$this->db->pdb($setSlug).'
				ORDER BY catTreePosition ASC';
		$rows   = $this->db->get_rows($sql);
		
		return $this->return_instances($rows);	
	}

	public function get_categories_from_ids_runtime($ids, $sort=false)
	{
		if (PerchUtil::count($this->from_ids_cache)) {
			$out = array_filter($this->from_ids_cache, function($a) use ($ids) {
				return in_array($a['catID'], $ids);
			});

			if ($sort!==false) {
				$parts = explode(' ', trim($sort));
				$sort_field = $parts[0];
				if (isset($parts[1]) && ($parts[1]=='ASC' || $parts[1]=='DESC')) {
					$sort_dir = $parts[1];
				}else{
					$sort_dir = 'ASC';
				}

				$out = PerchUtil::array_sort($out, $sort_field, ($sort_dir=='DESC' ? true : false));
			}

			return $this->return_flattened_instances($out);
		}

		if (!$sort) $sort = 'catTreePosition ASC';

		$sql = 'SELECT * FROM '.$this->table.' ORDER BY '.$sort;
		$rows   = $this->db->get_rows($sql);

		if (PerchUtil::count($rows)) {
			$this->from_ids_cache = $rows;
			return $this->get_categories_from_ids_runtime($ids, $sort);
		}

	}

	public function get_custom($opts, $api=false)
	{
		if ($api) $this->api = $api;

		$opts['template'] = 'categories/'.$opts['template'];

		$db = $this->db;

		$where_callback = function(PerchQuery $Query) use ($opts, $db) {

			// set
			if (isset($opts['set'])) {
				$setID = false;
			    if (is_numeric($opts['set'])) {
			        $setID = $opts['set'];
			    }else{
			    	$set_sql = 'SELECT setID FROM '.PERCH_DB_PREFIX.'category_sets WHERE setSlug='.$db->pdb($opts['set']).' LIMIT 1';
			        $setID = $db->get_value($set_sql);
			    }

			    if ($setID) {
			        $Query->where[] = ' setID='.$db->pdb($setID);
			    }
			}

			// count
			if (isset($opts['count-type'])) {

				$Query->select .= ', cc.countValue AS  `count.'.$opts['count-type'].'` ';
				$Query->from   .= ', '.PERCH_DB_PREFIX.'category_counts cc ';
				$Query->where[] = 'cc.catID=main.catID AND cc.countType='.$db->pdb($opts['count-type']);

				if (isset($opts['include-empty']) && $opts['include-empty']==false) {
					$Query->where[] = 'cc.countValue > 0';
				} 
			}

			return $Query;

		};


		return $this->get_filtered_listing($opts, $where_callback);
	}

}