<?php defined('SYSPATH') OR die('No Direct Script Access');

class Controller_Artists extends Controller_Rest
{

    protected $_rest;

    public function before()
    {
        parent::before();
        $this->_rest = Model_RestAPI::factory('ArtistModel', $this->_user);
    }


    public function action_index()
    {
        try {
            // here I am asking if a parameter was sent in the url
           if ($this->request->param('param1')!==null){
                $this->action_find_by();
            }else{
                $this->rest_output($this->_rest->get($this->_params));
            }  
        } catch (Kohana_HTTP_Exception $khe) {
            $this->_error($khe);
            return;
        } catch (Kohana_Exception $e) {
            $this->_error('An internal error has occurred', 500);
            throw $e;
        }
    }


    public function action_create()
    {
        try {
            $this->rest_output($this->_rest->create($this->_params));
        } catch (Kohana_HTTP_Exception $khe) {
            $this->_error($khe);
            return;
        } catch (Kohana_Exception $e) {
            $this->_error('An internal error has occurred', 500);
            throw $e;
        }
    }


    public function action_update()
    {
        try {
            // id of the item to update. eg. api/artists/1, value = 1
            $id = $this->request->param('param1');
            // update the item with id with the new params
            $this->rest_output($this->_rest->update_by( $id, $this->_params));
        } catch (Kohana_HTTP_Exception $khe) {
            $this->_error($khe);
            return;
        } catch (Kohana_Exception $e) {
            $this->_error('An internal error has occurred', 500);
            throw $e;
        }
    }

    public function action_delete()
    { 
        try {
            // id of the item to delete. eg. api/artists/1, value = 1
            $id = $this->request->param('param1');
            $this->rest_output($this->_rest->delete_by($id)); //call to delete artist 
          
        } catch (Kohana_HTTP_Exception $khe) {
            $this->_error($khe);
            return;
        } catch (Kohana_Exception $e) {
            $this->_error('An internal error has occurred', 500);
            throw $e;
        }
    }

    // This method is to search a artist for id
    public function action_find_by()
    {
        try {
            // can be artist_id or name
            $param = $this->request->param('param1');
          
            // the value you are looking for
            $value = $this->request->param('param2');
          
            $this->rest_output(
                $this->_rest->find_by($param,$value));
        } catch (Kohana_HTTP_Exception $khe) {
            $this->_error($khe);
            return;
        } catch (Kohana_Exception $e) {
            $this->_error('An internal error has occurred', 500);
            throw $e;
        }

    }

    public function action_findLike()
    {
        $param = $this->request->param('param1');
        $value = $this->request->param('param2');
        try {
            $this->rest_output(array(
                $this->_rest->findLike($param,$value),
            ));
        } catch (Kohana_HTTP_Exception $khe) {
            $this->_error($khe);
            return;
        } catch (Kohana_Exception $e) {
            $this->_error('An internal error has occurred', 500);
            throw $e;
        }

    }

    public function action_mayra(){
        echo 'ejemplo';
    }

}