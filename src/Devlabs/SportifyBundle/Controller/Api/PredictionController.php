<?php

namespace Devlabs\SportifyBundle\Controller\Api;

use Devlabs\SportifyBundle\Controller\Base\BaseApiController;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View as ViewAnnotation;

/**
 * Class PredictionController
 * @package Devlabs\SportifyBundle\Controller\Api
 */
class PredictionController extends BaseApiController
{
    protected $repositoryName = 'DevlabsSportifyBundle:Prediction';
}