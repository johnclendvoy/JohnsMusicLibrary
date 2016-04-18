<?php defined('SYSPATH') or die('No direct access allowed.');


class Model_ArtistModel extends Model
{

    public function get($params)
    {
        try {
            $iterator = ORM::factory('Artist')
                ->find_all()
                ->as_array();

            foreach ($iterator as $member) {
                $data[] = $member->as_array();
            }

            return array('Artists' => $data);
        }
        catch (ORM_Validation_Exception $e)
        {

            return array(
                'status' => $e->errors()
            );
        }
    }

    public function create($params)
    {
        $art = ORM::factory('Artist');
        $art->name = $params['name'];
		$art->youtube = $params['youtube'];
		$art->website = $params['website'];
		$art->soundcloud = $params['soundcloud'];
		$art->twitter = $params['twitter'];
		$art->color = $params['color'];
      
        $art->save();
        $art->loaded();

        return array(
            'status' => __('Saved'),
            'artist_id' => $art->artist_id,
            'name' => $art->name,
			'website' => $art->website,
			'soundcloud' => $art->soundcloud,
			'youtube' => $art->youtube,
			'twitter' => $art->twitter,
			'color' => $art->color
           // 'address' => $cust->address,
        );

    }

    public function update($params)
    {
        $art = ORM::factory('Artist', $params['artist_id']);
        $art->name = $params['name'];
		$art->website = $params['website'];
		$art->soundcloud = $params['soundcloud'];
		$art->youtube = $params['youtube'];
		$art->twitter = $params['twitter'];
		$art->color = $params['color'];
		
        $art->save();
        $art->loaded();

        return array(
            'status' => __('Updated'),
            'artist_id' => $art->artist_id,
            'name' => $art->name,
			'website' => $art->website,
			'soundcloud' => $art->soundcloud,
			'youtube' => $art->youtube,
			'twitter' => $art->twitter,
			'color' => $art->color
            //'address' => $art->address,
        );
    }
  
    public function update_by($id, $params)
    {
        $art = ORM::factory('Artist', $id);
        $art->name = $params['name'];
		$art->website = $params['website'];
		$art->soundcloud = $params['soundcloud'];
		$art->youtube = $params['youtube'];
		$art->twitter = $params['twitter'];
		$art->color = $params['color'];
		
        //$cust->address = $params['address'];
        $art->save();
        $art->loaded();

        return array(
            'status' => __('Updated'),
            'artist_id' => $art->artist_id,
            'name' => $art->name,
			'name' => $art->name,
			'website' => $art->website,
			'soundcloud' => $art->soundcloud,
			'youtube' => $art->youtube,
			'twitter' => $art->twitter,
			'color' => $art->color
            //'address' => $art->address,
        );
    }

    public function delete($params)
    {
        $art = ORM::factory('Artist', $params['artist_id']);
        $art->delete();
        return array(
            'status' => __('Deleted'),
            'artist_id' => $params['artist_id'],
        );
    }
  
   public function delete_by($param)
    {
     
      try
        {
            $art = ORM::factory('Artist', $param);
            $art->delete();
              
        return array(
            'status' => __('Deleted'),
            'artist_id' => $param,
        );
        }
        catch (ErrorException $e)
        {
            return array(
                'status' => 'Data is Null',
                'cod'    => 'DATANULL',
            );
        }
        catch (Exception $e)
        {
            return array(
                'status' => 'Parametre no Exist',
                'cod'    => 'PARNEXS',
            );
        }
     /*
        $art = ORM::factory('Artist', $params['artist_id']);
        $art->delete();
        return array(
            'status' => __('Deleted'),
            'artist_id' => $params['artist_id'],
        );
        */
    }

    public function find_by($param, $value)
    {
        try
        {
            $iterator = ORM::factory('Artist')
                ->where($param, '=', $value)
                ->find_all()
                ->as_array();

            foreach ($iterator as $member) {
                $data[] = $member->as_array();
            }

            return array('Artist' => $data);
        }
        catch (ErrorException $e)
        {

            return array(
                'status' => 'Data is Null',
                'cod'    => 'DATANULL',
            );
        }
        catch (Exception $e)
        {

            return array(
                'status' => 'find by Parametre no Exist',
                'cod'    => 'PARNEXS',
            );
        }
    }

    public function find_like($param, $value)
    {
        try {
            $iterator = ORM::factory('Artist')
                ->where($param, 'like', "%$value%")
                ->find_all()
                ->as_array();

            foreach ($iterator as $member) {
                $data[] = $member->as_array();
            }

            return array('company' => $data);

        }
        catch (ORM_Validation_Exception $e)
        {

            return array(
                'status' => $e->errors()
            );
        }

    }
}
?>