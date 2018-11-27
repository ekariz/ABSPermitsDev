<?php
use Swagger\Annotations as SWG;
/**
 * @package
 * @category
 * @subpackage
 *
 * @SWG\Resource(
 *  apiVersion="0.2",
 *  swaggerVersion="1.2",
 *  resourcePath="/institutions",
 *  basePath="http://api.abs.co.ke/docs/json",
 *  produces="['application/json']",
 * )
 */
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Institutions extends REST_Controller {

    function __construct()
    {
        parent::__construct();
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, PUT,DELETE, OPTIONS");
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
            exit(0);
        }

    }

    /**
     *
     * @SWG\Api(
     *   path="institutions",
     *   description="get",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="get institutions",
     *       notes="Returns a string",
     *       nickname="list institutions",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="id",
     *           description="institutions id",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="instcode",
     *           description="institutions code",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *       ),
     *       @SWG\ResponseMessages(
     *          @SWG\ResponseMessage(
     *            code=400,
     *            message="Invalid username"
     *          ),
     *          @SWG\ResponseMessage(
     *            code=404,
     *            message="Not found"
     *          )
     *       )
     *     )
     *   )
     * )
     */

    public function index_get()
    {
        $id       = $this->get('id');
        $instcode = $this->get('instcode');
        $offset   = $this->get('offset');
        $limit    = $this->get('limit');
        $this->load->model('servicesmodel');
        $data = [];
        $skip_cols = ['instphoto','photourl','thumburl','charges'];

        if($id == null) {
          if($instcode != null) {
            $data['instcode'] = $instcode;
          }

        $response = $this->servicesmodel->get('institutions', $data , null, null, $skip_cols);

       } else {
         if($limit == null) { $limit == 20; }
         if($offset == null) { $offset == 0; }
         $data = array('id' => $id, );
         if($instcode != null) {
           $data['instcode'] = $instcode;
         }
         $response = $this->servicesmodel->get('institutions', $data , $limit, $offset, $skip_cols);
       }

       if($response) {
         $this->response($response, REST_Controller::HTTP_OK);
       } else {
         $this->set_response([
            'status'  => FALSE,
            'message' => 'Response could not be found'
        ], REST_Controller::HTTP_NOT_FOUND);
       }

    }


}
/**
 * @SWG\Model(id="Institutions", required="instcode, instname",
 *     @SWG\Property(name="instcode",type="string"),
 *     @SWG\Property(name="instname",type="string"),
 * )
*/
