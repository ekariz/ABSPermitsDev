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
 *  resourcePath="/researchers",
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
class Researchers extends REST_Controller {

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
     *   path="researchers",
     *   description="get",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="get researchers",
     *       notes="Returns a string",
     *       nickname="list researchers",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="id",
     *           description="researcher ORCID iD",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *       ),
     *       @SWG\ResponseMessages(
     *          @SWG\ResponseMessage(
     *            code=400,
     *            message="Invalid ID"
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
        $orcidid  = $this->get('orcidid');
        $offset   = $this->get('offset');
        $limit    = $this->get('limit');

        $this->load->model('servicesmodel');
        $data = [];

        $skip_cols = [
        'accesstoken',
        'tokentype',
        'tokenscope',
        'refreshtoken',
        'tokenexpiry',
        'auditdate',
        'audittime',
        'audittime',
        'auditip',
        'docphoto',
        'docidpass',
        'docid',
        'setup',
        'regdate',
        'regtime',
        'hasuploads',
        'verifycode',
        'verifydate',
        'email',
        'password',
        'email',
        'pinno',
        'dob',
        'idpassip',
        'idpassdi',
        'idpassdx',
        'institutionname',
        'qualification',
        'specarea',
        'mobile',
        'postaddress',
        'postcode',
        'postaddress',
        'town',
        'prmaddress',
        'prmpcode',
        'prmtown',
        'prmphone',
        'prmresidence',
        'secaddress',
        'secpcode',
        'sectown',
        'secphone',
        'secresidence',
        'empaddress',
        'emppcode',
        'emppzip',
        'emppcode',
        'emptown',
        'emphone',
        'empctncode',
        'empcountry',
        'idpassno',
        ];

        if($orcidid == null) {
         $this->set_response([
            'status'  => FALSE,
            'message' => 'Researcher ID Not Found'
         ], REST_Controller::HTTP_NOT_FOUND);
        }

        $data['orcidid'] = $orcidid;

        if($limit == null) {
         $limit == 20;
        }

        if($offset == null) {
         $offset == 0;
        }

        $response = $this->servicesmodel->get('researchers', $data , $limit, $offset, $skip_cols);

       //if(!empty($response->response)) {
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
 * @SWG\Model(id="Researchers", required="orcidid, fullname",
 *     @SWG\Property(name="orcidid",type="string"),
 *     @SWG\Property(name="fullname",type="string"),
 * )
*/
