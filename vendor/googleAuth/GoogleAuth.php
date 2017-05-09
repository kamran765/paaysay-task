<?php
	class GoogleAuth
	{
		protected $client;

		function __construct()
		{
			$this->client = new Google_Client();
			$this->client->setClientId('805222795875-kt8c5nmn4ou2egcjvg51p21ufjjdbt48.apps.googleusercontent.com');
			$this->client->setClientSecret('kF0pAHoHIbBjPZkhtyx_CrDe');
			$this->client->setRedirectUri('http://localhost/paaysay/index.php');

			
			$this->client->setScopes(array("https://www.googleapis.com/auth/tasks.readonly","https://www.googleapis.com/auth/plus.login","https://www.googleapis.com/auth/userinfo.email","https://www.googleapis.com/auth/userinfo.profile","https://www.googleapis.com/auth/plus.me"));
		}
		public function cclient(){
			return $this->client;
		}
		public function isLoggedIn()
		{
			return isset($_SESSION['access_token']);
		}
		public function getAuthUrl()
		{
			return $this->client->createAuthUrl();
		}
		public function checkRedirectCode()
		{
			if (isset($_GET['code'])) {
			  $this->client->authenticate($_GET['code']);

			  $_SESSION['access_token'] = $this->client->getAccessToken();
			  return true;
			}
			return false;
		}
		public function userinfo(){
			$this->client->setAccessToken($_SESSION['access_token']);
			$service =new Google_Service_Oauth2($this->client);
			$userinfo = $service->userinfo->get();
			 return $userinfo;
			
			
			//   return $userInfo = json_decode($json,true);
		}
		public function getTasks()
		{
			if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
				$this->client->setAccessToken($_SESSION['access_token']);
				$service = new Google_Service_Tasks($this->client);
				$checkDefaultTaskList = $service->tasklists->get('@default');
				if (count($checkDefaultTaskList) == 0) {
				  $newTaskList = new Google_Service_Tasks_TaskList();
				  $newTaskList->title = '@default';
				  $createNewTaskList = $service->tasklists->insert($newTaskList);
				}
				$tasks = $service->tasks->listTasks('@default');
				return compact('tasks');
			}
		}
		public function addTask($task)
		{
			if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
				$this->client->setAccessToken($_SESSION['access_token']);
				$service = new Google_Service_Tasks($this->client);
				
				$newTask = new Google_Service_Tasks_Task;

			  	$newTask->setTitle($task);

			  	$insertTask = $service->tasks->insert('@default', $newTask);
			  	header('location: index.php');
			}
		}

		public function deleteAllTasks()
		{
			if (isset($_SESSION['access_token'],$_SESSION['access_token'])) {
				$this->client->setAccessToken($_SESSION['access_token']);
				$service = new Google_Service_Tasks($this->client);
				
			    $tasks = $service->tasks->listTasks('@default');  
			    foreach($tasks->getItems() as $task) {
			  	  $delete = $service->tasks->delete('@default', $task->getId());
			    }
			    
			  	header('location: index.php');
			}
		}

		public function deleteTask($task)
		{
			if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
				$this->client->setAccessToken($_SESSION['access_token']);
				$service = new Google_Service_Tasks($this->client);
				
			    $delete = $service->tasks->delete('@default', $task);

			  	header('location: index.php');
			}
		}

	}

?>