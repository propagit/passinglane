<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controller: Dispatcher
 * Description: control main flow of the app
 * @author: namnd86@gmail.com
 */
class Dispatcher extends MX_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('nav_model');
		$this->load->model('meta_data_model');

	}



	public function index()
	{
		$this->user_dispatcher('passing');
	}

	function user_passing_dispatcher($controller='', $method='', $param1='',$param2='',$param3='',$param4='')
	{
		if ($method == 'ajax')
		{
			echo modules::run($controller . '/ajax/' . $param1); exit();
		}


		$meta_data = $this->meta_data_model->get_meta_data($controller, $method, $param1, $param2, $param3, $param4);
		$title = $meta_data['title'];
		$keywords = $meta_data['keywords'];
		$description = $meta_data['description'];



		$content = modules::run($controller, $method, $param1, $param2, $param3, $param4);


		$this->template->set_template('user');

		$this->template->write('title', $title);
		$this->template->write('keywords', $keywords);
		$this->template->write('description', $description);
		$data['nav'] = $this->nav_model->all();
		$data['services_menu'] = $this->nav_model->get_all_links(4);
		$data['products_menu'] = $this->nav_model->get_all_links(3);
		$data['cat_prods'] = $this->nav_model->get_all_categories();
		$this->template->write_view('header', 'user/header',$data);
		$this->template->write('content', $content);
		$this->template->write_view('footer', 'user/footer');
		$this->template->render();

	}



	function admin_dispatcher($controller='dashboard', $method='', $param='',$param2='')
	{
		if($controller=='cron')
		{
			//echo $controller;
			$content = modules::run('order' . '/admin/index', 'all_sales_report2', '');
			exit();
		}else{
			$is_admin_logged_in = modules::run('auth/is_admin_logged_in');
			if (!$is_admin_logged_in)
			{

					redirect('admin/login');

			}

			if (strpos($method, 'ajax') !== false)
			{
				echo modules::run('admin'.$controller . '/' . $method . '/' . $param, $param2); exit();
			}

			switch($controller)
			{
				case 'product':
						$title = 'Products Management';
						switch($method) {
							case 'category':
									$title = 'Manage Product Categories';
								break;
							case 'brand':
								break;
						}
					break;
				case 'position':
						$title = 'Manage Product Position';
					break;
				case 'customer':
						$title = 'Customers Management';
						switch($method)
						{
							case 'create':
								break;
							case 'edit':
								break;
						}
					break;
				case 'order':
						$title = 'Orders Management';
					break;
				case 'Page':
						$title = 'Pages Management';
					break;
				case 'gallery':
						$title = 'Galleries Management';
					break;
				case 'case_studies':
						$title = 'Manage Case Studies';
					break;
				case 'news':
						$title = 'Manage News Articles';
					break;
				case 'promotion':
						$title = 'Promotions';
					break;
				case 'dashboard':
				default:
						$title = 'Dashboard';
					break;
			}
			if(($controller == 'product' && $method == 'gallery') || ($controller == 'product' && $method == 'movephoto')){
				$this->template->set_template('popup');
			}else{
				$this->template->set_template('admin');
				$this->template->write_view('menu', 'admin/menu');
			}
			$content = modules::run('admin' . $controller, $method, $param,$param2);

			$this->template->write('title', $title);
			$this->template->write('content', $content);
			$this->template->render();
		}

	}

	function user_dispatcher($controller='', $method='', $param1='',$param2='',$param3='',$param4='')
	{
		if ($method == 'ajax')
		{
			echo modules::run($controller . '/ajax/' . $param1); exit();
		}


		$meta_data = $this->meta_data_model->get_meta_data($controller, $method, $param1, $param2, $param3, $param4);
		$title = $meta_data['title'];
		$keywords = $meta_data['keywords'];
		$description = $meta_data['description'];

		$content = modules::run($controller, $method, $param1, $param2, $param3, $param4);

		$this->template->set_template('passing');

		$this->template->write('title', $title);
		$this->template->write('keywords', $keywords);
		$this->template->write('description', $description);
		$data['nav'] = $this->nav_model->all();
		//$data['services_menu'] = $this->nav_model->get_all_links(4);
		//$data['products_menu'] = $this->nav_model->get_all_links(3);
		//$data['cat_prods'] = $this->nav_model->get_all_categories();
		$this->template->write_view('header', 'passing/header',$data);
		$this->template->write('content', $content);
		$this->template->write_view('footer', 'passing/footer');
		$this->template->render();

	}
}
/* End of file dispatcher.php */
/* Location: ./application/controllers/dispatcher.php */
