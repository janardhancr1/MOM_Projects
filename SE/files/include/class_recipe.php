<?php

/* $Id: class_recipe.php 72 2009-02-27 01:59:11Z Janardhan $ */


//  THIS CLASS CONTAINS POLL-RELATED METHODS
//  METHODS IN THIS CLASS:
//
//    se_recipe()
//
//    recipe_add()
//    recipe_edit()
//    recipe_delete()
//    recipe_vote()
//    recipe_update()
//    recipe_toggle_closed()
//
//    recipe_total()
//    recipe_list()


defined('SE_PAGE') or exit();


class se_recipe
{
	// INITIALIZE VARIABLES
	var $is_error;				// DETERMINES WHETHER THERE IS AN ERROR OR NOT
	var $error_message;   		// CONTAINS RELEVANT ERROR MESSAGE
	var $user_id;				// CONTAINS THE USER ID OF THE USER WHOSE POLL WE ARE EDITING

	var $recipe_exists;			// DETERMINES WHETHER THE POLL HAS BEEN SET AND EXISTS OR NOT
	var $recipe_info;				// CONTAINS THE POLL INFO OF THE POLL WE ARE EDITING

	var $recipe_dir = "./uploads_recipes/";

	function se_recipe($user_id=NULL, $recipe_id=NULL)
	{
		global $database, $user, $owner;

		if( empty($user_id) || !is_numeric($user_id) ) $user_id = NULL;
		if( empty($recipe_id) || !is_numeric($recipe_id) ) $recipe_id = NULL;

		$this->user_id = $user_id;
		$this->recipe_exists = FALSE;

		if( $recipe_id )
		{
			// GENERATE QUERY
			$sql = "
		        SELECT
		          *
		        FROM
		          se_recipes
		        WHERE
		          recipe_id='{$recipe_id}'
		      ";

			if( $user_id ) $sql .= " AND
			        recipe_user_id='{$user_id}'
			      ";

			$sql .= "
			        LIMIT
			          1
			      ";

			$resource = $database->database_query($sql) or die($database->database_error()."<br /><b>SQL:</b> $sql");

			if( $database->database_num_rows($resource) )
			{
				$this->recipe_info = $database->database_fetch_assoc($resource);
				$this->recipe_exists = TRUE;
			}
			$this->recipe_info["user_name"] = $user->user_info["user_username"];
		}
	}

	function recipe_add($recipe_name, $recipe_desc, $recipe_tags, $recipe_prep_tm, $recipe_cook_tm,
	$recipe_serve_to, $recipe_diff, $recipe_ingre, $recipe_method, $recipe_search, $recipe_privacy, $recipe_comments,
	$recipe_pref)
	{
		global $database, $user;

		$recipe_name = censor($recipe_name);
		$recipe_desc = censor($recipe_desc);
		$recipe_tags = censor($recipe_tags);
		$recipe_prep_tm = censor($recipe_prep_tm);
		$recipe_cook_tm = censor($recipe_cook_tm);
		$recipe_serve_to = censor($recipe_serve_to);
		$recipe_ingre = censor($recipe_ingre);
		$recipe_method = censor($recipe_method);

		// GET PRIVACY SETTINGS
		$level_recipe_privacy = unserialize($user->level_info['level_recipe_privacy']);
		rsort($level_recipe_privacy);
		$level_recipe_comments = unserialize($user->level_info['level_recipe_comments']);
		rsort($level_recipe_comments);

		// MAKE SURE SUBMITTED PRIVACY OPTIONS ARE ALLOWED, IF NOT, SET TO MOST PUBLIC
		if( !in_array($recipe_privacy, $level_recipe_privacy) )
		$recipe_privacy = $level_recipe_privacy[0];
		if( !in_array($recipe_comments, $level_recipe_comments))
		$recipe_comments = $level_recipe_comments[0];

		// CHECK THAT SEARCH IS NOT BLANK
		if( !$user->level_info['level_recipe_search'] )
		$poll_search = 1;

		// GET START AND END DATES
		$recipe_datecreated = time();

		// GENERATE QUERY
		$sql = "
	      INSERT INTO
	        se_recipes
	      (
	        recipe_user_id,
	        recipe_datecreated,
	        recipe_name,
	        recipe_description,
	        recipe_tags,
	        recipe_prep_tm,
	        recipe_cook_tm,
	        recipe_serve_to,
	        recipe_difficulty,
	        recipe_ingredients,
	        recipe_method,
	        recipe_vege,
	        recipe_vegan,
	        recipe_dairy,
	        recipe_gluten,
	        recipe_nut,
	        recipe_search,
	        recipe_privacy,
	        recipe_comments
	      )
	      VALUES
	      (
	        '{$user->user_info['user_id']}',
	        '{$recipe_datecreated}',
	        '".$database->database_real_escape_string($recipe_name)."',
	        '".$database->database_real_escape_string($recipe_desc)."',
	        '".$database->database_real_escape_string($recipe_tags)."',
	        '".$database->database_real_escape_string($recipe_prep_tm)."',
	        '".$database->database_real_escape_string($recipe_cook_tm)."',
	        '".$database->database_real_escape_string($recipe_serve_to)."',
	        '".$database->database_real_escape_string($recipe_diff)."',
	        '".$database->database_real_escape_string($recipe_ingre)."',
	        '".$database->database_real_escape_string($recipe_method)."',
	        '{$recipe_pref["vege"]}',
	        '{$recipe_pref["vegan"]}',
	        '{$recipe_pref["dairy"]}',
	        '{$recipe_pref["gluten"]}',
	        '{$recipe_pref["nut"]}',
	        '{$recipe_search}',
	        '{$recipe_privacy}',
	        '{$recipe_comments}'
	      )
	    ";
		$resource = $database->database_query($sql) or die($database->database_error()." SQL: ".$sql);

		return $database->database_insert_id();
	}


	function recipe_edit($recipe_id, $recipe_name, $recipe_desc, $recipe_tags, $recipe_prep_tm, $recipe_cook_tm,
	$recipe_serve_to, $recipe_diff, $recipe_ingre, $recipe_method, $recipe_search, $recipe_privacy, $recipe_comments,
	$recipe_pref)
	{
		global $database, $user;

		$recipe_name = censor($recipe_name);
		$recipe_desc = censor($recipe_desc);
		$recipe_tags = censor($recipe_tags);
		$recipe_prep_tm = censor($recipe_prep_tm);
		$recipe_cook_tm = censor($recipe_cook_tm);
		$recipe_serve_to = censor($recipe_serve_to);
		$recipe_ingre = censor($recipe_ingre);
		$recipe_method = censor($recipe_method);

		// GET PRIVACY SETTINGS
		$level_recipe_privacy = unserialize($user->level_info['level_recipe_privacy']);
		rsort($level_recipe_privacy);
		$level_recipe_comments = unserialize($user->level_info['level_recipe_comments']);
		rsort($level_recipe_comments);

		// MAKE SURE SUBMITTED PRIVACY OPTIONS ARE ALLOWED, IF NOT, SET TO MOST PUBLIC
		if( !in_array($recipe_privacy, $level_recipe_privacy) )
		$recipe_privacy = $level_recipe_privacy[0];
		if( !in_array($recipe_comments, $level_recipe_comments))
		$recipe_comments = $level_recipe_comments[0];

		// CHECK THAT SEARCH IS NOT BLANK
		if( !$user->level_info['level_recipe_search'] )
		$poll_search = 1;

		// GET START AND END DATES
		$recipe_datecreated = time();

		// GENERATE QUERY
		$sql = "
	      UPDATE se_recipes
	      SET
	        recipe_user_id = '{$user->user_info['user_id']}',
	        recipe_name = '".$database->database_real_escape_string($recipe_name)."',
	        recipe_description = '".$database->database_real_escape_string($recipe_desc)."',
	        recipe_tags = '".$database->database_real_escape_string($recipe_tags)."',
	        recipe_prep_tm = '".$database->database_real_escape_string($recipe_prep_tm)."',
	        recipe_cook_tm = '".$database->database_real_escape_string($recipe_cook_tm)."',
	        recipe_serve_to = '".$database->database_real_escape_string($recipe_serve_to)."',
	        recipe_difficulty = '".$database->database_real_escape_string($recipe_diff)."',
	        recipe_ingredients = '".$database->database_real_escape_string($recipe_ingre)."',
	        recipe_method = '".$database->database_real_escape_string($recipe_method)."',
	        recipe_vege = '{$recipe_pref["vege"]}',
	        recipe_vegan = '{$recipe_pref["vegan"]}',
	        recipe_dairy = '{$recipe_pref["dairy"]}',
	        recipe_gluten = '{$recipe_pref["gluten"]}',
	        recipe_nut = '{$recipe_pref["nut"]}',
	        recipe_search = '{$recipe_search}',
	        recipe_privacy = '{$recipe_privacy}',
	        recipe_comments = '{$recipe_comments}'
	      WHERE recipe_id = $recipe_id";

		echo $sql;
		$resource = $database->database_query($sql) or die($database->database_error()." SQL: ".$sql);

		return $database->database_affected_rows();
	}

	function recipe_view()
	{
		global $database;

		if( !$this->recipe_exists || !$this->recipe_info['recipe_id'] )
		return FALSE;

		// CREATE UPDATE QUERY
		$sql = "
	      UPDATE
	        se_recipes
	      SET
	        recipe_views=recipe_views+1
	      WHERE
	        recipe_id='{$this->recipe_info['recipe_id']}'
	      LIMIT
	        1
	    ";

		// RUN QUERIES
		$resource = $database->database_query($sql) or die($database->database_error()." SQL: ".$sql);

		return (bool) $database->database_affected_rows($resource);
	}

	function recipe_total($where=NULL)
	{
		global $database;

		// BEGIN ENTRY QUERY
		$sql = "
      		SELECT
        		NULL
      		FROM
        		se_recipes";

		// IF NO USER ID SPECIFIED, JOIN TO USER TABLE
		if( !$this->user_id ) $sql .= "
      		LEFT JOIN se_users
        	ON se_recipes.recipe_user_id=se_users.user_id ";

		// ADD WHERE IF NECESSARY
		if($where != "") $sql .= "
	        WHERE $where
	    ";

		// ENSURE USER ID IS NOT EMPTY
		if( $this->user_id )
		{
			if($where != "")
			$sql .= "
        			AND recipe_user_id='{$this->user_id}'
    				";
			else
			$sql .= "
        	 		WHERE recipe_user_id='{$this->user_id}'
    				";
		}
			
		//echo $sql;
		// GET AND RETURN TOTAL CLASSIFIED ENTRIES
		$resource = $database->database_query($sql);
		$recipe_total = $database->database_num_rows($resource);

		return $recipe_total;
	}

	function recipe_list($start, $limit, $where="", $sort_by = "recipe_id DESC", $rating="")
	{
		global $database;

		// BEGIN ENTRY QUERY
		$sql = "
      		SELECT
        		  recipe_id
				, recipe_name
				, recipe_description
				, recipe_photo
				, recipe_cook_tm 
				, recipe_user_id
				, recipe_views
				, recipe_ratings
				, se_users.user_username AS SUBMITTEDBY
				, recipe_totalcomments
				, recipe_datecreated ";

		if($rating != "") $sql .=",  se_ratings.rating_value ";

		$sql .= "
      		FROM
        		se_recipes
        	INNER JOIN
        		se_users
        	ON se_users.user_id = se_recipes.recipe_user_id
    		";

		if($rating != "") $sql .="
			LEFT JOIN 
				se_ratings
			ON se_ratings.rating_object_id = se_recipes.recipe_id 
			AND rating_object_table = 'se_recipes'";

		// ADD WHERE IF NECESSARY
		if($where != "") $sql .= "
	        WHERE $where
	    ";
			
		$sql .= "
		      ORDER BY
		      $sort_by
		      LIMIT
		      $start, $limit
		    ";

		      //echo $sql;
		      // GET AND RETURN TOTAL CLASSIFIED ENTRIES
		      $resource = $database->database_query($sql);
		      $recipe_array = array();
		      while( $recipe_info=$database->database_fetch_assoc($resource) )
		      {
		      	if(!empty($recipe_info["recipe_photo"])) {
		      		$recipe_info["recipe_photo"] = $this->recipe_dir.$recipe_info["recipe_photo"];
		      	}
		      	$recipe_array[] = $recipe_info;
		      }

		      return $recipe_array;
	}

	function get_tagcould()
	{
		global $database;

		// BEGIN ENTRY QUERY
		$sql = "
      		SELECT
        		  recipe_tags
      		FROM
        		se_recipes";

		//echo $sql;
		// GET AND RETURN TOTAL CLASSIFIED ENTRIES
		$resource = $database->database_query($sql);
		$tag_array = array();
		while( $recipe_tags=$database->database_fetch_assoc($resource) )
		{
			$tags = explode(",",$recipe_tags["recipe_tags"]);
			foreach($tags as $tag)
			{
				$tag_array[] = trim($tag);
			}
		}

		$tag_count = array_count_values($tag_array);
		$tag_array = array_unique($tag_array);
		$tag_could = array();
		foreach($tag_array as $tag)
		{
			$tag_could[] = array ("tag" => $tag,
								"wieght" => 10 + $tag_count[$tag],
								"url" => "recipes_tag.php?q=$tag");
		}
		return $tag_could;
	}

	function add_to_favorite($recipe_id)
	{
		global $database, $user;

		// GET START AND END DATES
		$fav_datecreated = time();
		$sql = "
      		SELECT
        		NULL
      		FROM
        		se_recipefav
    		WHERE fav_user_id = {$user->user_info['user_id']} 
    		AND fav_recipe_id = {$recipe_id}";

		$resource = $database->database_query($sql);

		$fav_exists = $database->database_num_rows($resource);
		if($fav_exists <= 0)
		{
			// GENERATE QUERY
			$sql = "
		      INSERT INTO
		        se_recipefav
		      (
		      	fav_user_id,
		        fav_recipe_id,
		        fav_datecreated
		      )
		      VALUES
		      (
		        '{$user->user_info['user_id']}',
		        '{$recipe_id}',
		        '{$fav_datecreated}'
		      )
		    ";
			$resource = $database->database_query($sql) or die($database->database_error()." SQL: ".$sql);

			return (bool) $database->database_affected_rows($resource);
		}
	}

	function recipe_fav_total()
	{
		global $database, $user;

		// BEGIN ENTRY QUERY
		$sql = "
      		SELECT
        		NULL
      		FROM
        		se_recipefav
    		WHERE fav_user_id = {$user->user_info['user_id']}";

		//echo $sql;
		// GET AND RETURN TOTAL CLASSIFIED ENTRIES
		$resource = $database->database_query($sql);
		$recipe_total = $database->database_num_rows($resource);

		return $recipe_total;
	}

	function recipe_list_favorite($start, $limit, $sort_by = "fav_datecreated DESC")
	{
		global $database, $user;

		// BEGIN ENTRY QUERY
		$sql = "
      		SELECT
        		  recipe_id
				, recipe_name
				, recipe_description
				, recipe_photo
				, recipe_cook_tm 
				, recipe_user_id
				, recipe_views
				, recipe_ratings
				, se_users.user_username AS SUBMITTEDBY
				, recipe_totalcomments 
      		FROM
        		se_recipes
        	INNER JOIN
        		se_users
        	ON se_users.user_id = se_recipes.recipe_user_id 
        	INNER JOIN 
				se_recipefav
			ON se_recipefav.fav_recipe_id = se_recipes.recipe_id
			WHERE se_recipefav.fav_user_id = {$user->user_info['user_id']}  
        	ORDER BY $sort_by
    		LIMIT $start, $limit";

		//echo $sql;
		// GET AND RETURN TOTAL CLASSIFIED ENTRIES
		$resource = $database->database_query($sql);
		$recipe_array = array();
		while( $recipe_info=$database->database_fetch_assoc($resource) )
		{
			if(!empty($recipe_info["recipe_photo"])) {
				$recipe_info["recipe_photo"] = $this->recipe_dir.$recipe_info["recipe_photo"];
			}
			$recipe_array[] = $recipe_info;
		}

		return $recipe_array;
	}

	function recipe_photo_add($postedfile, $recipe_id)
	{
		$width  = 175 ;
		$height = 131;
		list($filewidth, $fileheight, $filetype, $fileattr) = getimagesize($postedfile["tmp_name"]);
		$photo_dest = $this->recipe_dir.$recipe_id."_pic.jpg";
		// RESIZE IMAGE AND PUT IN USER DIRECTORY
		switch($postedfile["type"])
		{
			case "image/gif":
				$file = imagecreatetruecolor($width, $height);
				$new = imagecreatefromgif($postedfile["tmp_name"]);
				$kek=imagecolorallocate($file, 255, 255, 255);
				imagefill($file,0,0,$kek);
				imagecopyresampled($file, $new, 0, 0, 0, 0, $width, $height, $filewidth, $fileheight);
				imagejpeg($file, $photo_dest, 100);
				ImageDestroy($new);
				ImageDestroy($file);
				break;

			case "image/bmp":
				$file = imagecreatetruecolor($width, $height);
				$new = $this->imagecreatefrombmp($postedfile["tmp_name"]);
				for($i=0; $i<256; $i++) { imagecolorallocate($file, $i, $i, $i); }
				imagecopyresampled($file, $new, 0, 0, 0, 0, $width, $height, $filewidth, $fileheight);
				imagejpeg($file, $photo_dest, 100);
				ImageDestroy($new);
				ImageDestroy($file);
				break;

			case "image/jpeg":
			case "image/jpg":
				$file = imagecreatetruecolor($width, $height);
				$new = imagecreatefromjpeg($postedfile["tmp_name"]);
				for($i=0; $i<256; $i++) { imagecolorallocate($file, $i, $i, $i); }
				imagecopyresampled($file, $new, 0, 0, 0, 0, $width, $height, $filewidth, $fileheight);
				imagejpeg($file, $photo_dest, 100);
				ImageDestroy($new);
				ImageDestroy($file);
				break;

			case "image/png":
				$file = imagecreatetruecolor($width, $height);
				$new = imagecreatefrompng($postedfile["tmp_name"]);
				for($i=0; $i<256; $i++) { imagecolorallocate($file, $i, $i, $i); }
				imagecopyresampled($file, $new, 0, 0, 0, 0, $width, $height, $filewidth, $fileheight);
				imagejpeg($file, $photo_dest, 100);
				ImageDestroy($new);
				ImageDestroy($file);
				break;
		}

		chmod($photo_dest, 0777);
		global $database, $user;
		$sql = "UPDATE se_recipes
				SET recipe_photo='" . $recipe_id."_pic.jpg'
				WHERE recipe_id=" . $recipe_id;
		$resource = $database->database_query($sql) or die($database->database_error()." SQL: ".$sql);
		return (bool) $database->database_affected_rows($resource);
	}

	// END classified_photo() METHOD

	function recipe_delete($recipe_id)
	{
		global $database;

		// CREATE DELETE QUERY
		$sql = "DELETE FROM se_recipes WHERE";

		// SINGLE
		if( is_numeric($recipe_id) )
		$sql .= " se_recipes.recipe_id='{$recipe_id}'";
		elseif( is_array($recipe_id) )
		$sql .= " se_recipes.recipe_id IN('".join("','", $recipe_id)."')";
		else
		return FALSE;

		// IF USER ID IS NOT EMPTY, ADD USER ID CLAUSE
		if( $this->user_id )
		$sql .= " && se_recipes.recipe_user_id='{$this->user_id}'";

		// RUN QUERIES
		$resource = $database->database_query($sql) or die($database->database_error()." SQL: ".$sql);

		return (bool) $database->database_affected_rows($resource);
	}
}


?>