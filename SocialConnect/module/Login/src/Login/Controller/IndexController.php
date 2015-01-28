<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Login for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Login\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Http\Request;
use Zend\View\Model\ViewModel;
use SocialConnect\SocialConnect;
use Zend\View\Helper\ServerUrl;

class IndexController extends AbstractActionController {
	
    /* action part to fetch the data from sites*/
	public function loginAction() {
		$server = new ServerUrl();
		$host = $server->getHost();
		$request = new Request();
		$config = $this->getServiceLocator()->get('config');
		$error = '';
		if($this->params('type') == 'Google') {
			if($this->params('error') == 'access_denied'){
				$error ="There is some error occurs.";
			} else {
				$oauth = new SocialConnect();
							
				$oauth->provider="Google";
				$oauth->client_id = $config['google']['client_id'];
				$oauth->client_secret = $config['google']['client_secret'];
				$oauth->scope="https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me https://www.google.com/m8/feeds";
				$oauth->redirect_uri  = 'http://'.$host."/login/type/Google";
				
				$oauth->Initialize();
				
				$code = isset($_REQUEST["code"]) ?  ($_REQUEST["code"]) : "";
				$getData = '';
				if(empty($code)) {
					$oauth->Authorize();
				}else{
					$oauth->code = $code;
					$getData = json_decode($oauth->getUserProfile());
					$oauth->debugJson($getData);
				}
			}
		}	
		$viewModel = new ViewModel();
		$viewModel->setVariable('error', $error);
		return $viewModel;
	}
}
