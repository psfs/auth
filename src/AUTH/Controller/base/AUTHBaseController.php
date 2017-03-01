<?php
namespace AUTH\Controller\base;
use PSFS\base\types\Controller;

/**
* Class AUTHBaseController
* @package AUTH\Controller\base* @author Fran López <fran.lopez84@hotmail.es>
* @version 1.0
* @Api AUTH
* Autogenerated controller [2017-03-01 11:22:41]
*/
abstract class AUTHBaseController extends Controller {

    const DOMAIN = 'AUTH';

    /**
    * Constructor por defecto
    */
    function __construct() {
        $this->init();
        $this->setDomain('AUTH')
            ->setTemplatePath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Templates');
    }

}
