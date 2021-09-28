<?php



	define('DB_NAME', 'kgis_gis');	//MySQL database
	define('DB_USER', 'kgis_usr');		//MySQL database username 
	define('DB_PASSWORD', 'YiaL9ceh3(IU');		//MySQL database password 
	define('DB_HOST', '127.0.0.1'); // MySQL hostname 
		  
	$error="Error in connection";
	$errorCode="101";
	$status = true;
	
	error_reporting(1);
	
	$format ='json'; //xml is the default
	
	$ResponseErr = array();
	
	
	
	$mysqli = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	
	
	$mysqli -> set_charset("utf8");

	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();

	}
	

	if(isset($_REQUEST['action']) && $_REQUEST['action']!=''){
	  
	  	include"commonFunctions.php";
		
		$status_code 				= "1";
		$action 	 				= $_REQUEST['action'];
		$todate		 				= date('Y:m:d H:m:s');
		$email 		 				= isset($_REQUEST['email'])?stripslashes($_REQUEST['email']):'';
		$species 					= isset($_REQUEST['species'])?stripslashes($_REQUEST['species']):'';
		$user_id 					= isset($_REQUEST['user_id'])?stripslashes($_REQUEST['user_id']):'';
		$user_name   				= isset($_REQUEST['user_name'])?stripslashes($_REQUEST['user_name']):'';
		$password 	 				= isset($_REQUEST['password'])?$_REQUEST['password']:'';
		$lat 	 					= isset($_REQUEST['lat'])?$_REQUEST['lat']:'';
		$lon 	 					= isset($_REQUEST['lon'])?$_REQUEST['lon']:'';
		$latlon 	 				= isset($_REQUEST['latlon'])?$_REQUEST['latlon']:'';
		$data_id 	 				= isset($_REQUEST['data_id'])?$_REQUEST['data_id']:'';
		$date_created 				= isset($_REQUEST['date_created'])?$_REQUEST['date_created']:'';
		$date_modified 				= isset($_REQUEST['date_modified'])?$_REQUEST['date_modified']:'';
		$type_of_point 				= isset($_REQUEST['type_of_point'])?$_REQUEST['type_of_point']:'';
		$name 	 					= isset($_REQUEST['name'])?$_REQUEST['name']:'';
		$address 	 				= isset($_REQUEST['address'])?$_REQUEST['address']:'';
		$trunk_diameter				= isset($_REQUEST['trunk_diameter'])?$_REQUEST['trunk_diameter']:'';
		$trunk_status				= isset($_REQUEST['trunk_status'])?$_REQUEST['trunk_status']:'';
		$trunk_problems				= isset($_REQUEST['trunk_problems'])?$_REQUEST['trunk_problems']:'';
		$komi_diameter 				= isset($_REQUEST['komi_diameter'])?$_REQUEST['komi_diameter']:'';
		$komi_status 				= isset($_REQUEST['komi_status'])?$_REQUEST['komi_status']:'';
		$komi_problems 				= isset($_REQUEST['komi_problems'])?$_REQUEST['komi_problems']:'';
		$diseases 					= isset($_REQUEST['diseases'])?$_REQUEST['diseases']:'';
		$recommended 				= isset($_REQUEST['recommended'])?$_REQUEST['recommended']:'';
		$info_name 	 				= isset($_REQUEST['info_name'])?$_REQUEST['info_name']:'';
		$cond_name 	 				= isset($_REQUEST['cond_name'])?$_REQUEST['cond_name']:'';
		$action_name 	 			= isset($_REQUEST['action_name'])?$_REQUEST['action_name']:'';
		$extra_name 	 			= isset($_REQUEST['extra_name'])?$_REQUEST['extra_name']:'';
		$assignment_name 	 		= isset($_REQUEST['assignment_name'])?$_REQUEST['assignment_name']:'';
		$condition_notes 			= isset($_REQUEST['condition_notes'])?$_REQUEST['condition_notes']:'';
		$height 	 				= isset($_REQUEST['height'])?$_REQUEST['height']:'';
		$komi_height 				= isset($_REQUEST['komi_height'])?$_REQUEST['komi_height']:'';
		$trunk_slope 				= isset($_REQUEST['trunk_slope'])?$_REQUEST['trunk_slope']:'';
		$available_growth 			= isset($_REQUEST['available_growth'])?$_REQUEST['available_growth']:'';
		$overall_health 			= isset($_REQUEST['overall_health'])?$_REQUEST['overall_health']:'';
		$stability 					= isset($_REQUEST['stability'])?$_REQUEST['stability']:'';
		$action_type 				= isset($_REQUEST['action_type'])?$_REQUEST['action_type']:'';
		$action_notes 				= isset($_REQUEST['action_notes'])?$_REQUEST['action_notes']:'';
		$obstacles 					= isset($_REQUEST['obstacles'])?$_REQUEST['obstacles']:'';
		$pavement 					= isset($_REQUEST['pavement'])?$_REQUEST['pavement']:'';
		$class 						= isset($_REQUEST['class'])?$_REQUEST['class']:'';
		$nearby 					= isset($_REQUEST['nearby'])?$_REQUEST['nearby']:'';
		$extras_notes 				= isset($_REQUEST['extras_notes'])?$_REQUEST['extras_notes']:'';
		$obstacle_to_humans 		= isset($_REQUEST['obstacle_to_humans'])?$_REQUEST['obstacle_to_humans']:'';
		$invoice 					= isset($_REQUEST['invoice'])?$_REQUEST['invoice']:'';
		$point_assignment_title 	= isset($_REQUEST['point_assignment_title'])?$_REQUEST['point_assignment_title']:'';
		$point_assignment_category 	= isset($_REQUEST['point_assignment_category'])?$_REQUEST['point_assignment_category']:'';
		$unit_point_assignment 		= isset($_REQUEST['unit_point_assignment'])?$_REQUEST['unit_point_assignment']:'';
		$point_assignment_quantity 	= isset($_REQUEST['point_assignment_quantity'])?$_REQUEST['point_assignment_quantity']:'';
		$point_assignment_quantity_initial 	= isset($_REQUEST['point_assignment_quantity_initial'])?$_REQUEST['point_assignment_quantity_initial']:'';
		$assignment_notes 			= isset($_REQUEST['assignment_notes'])?$_REQUEST['assignment_notes']:'';
		$end_date					= isset($_REQUEST['end_date'])?$_REQUEST['end_date']:'';
        $assig_id				    = isset($_REQUEST['assig_id'])?$_REQUEST['assig_id']:'';
        $order_amount_completed		= isset($_REQUEST['order_amount_completed'])?$_REQUEST['order_amount_completed']:'';
        $response		            = isset($_REQUEST['response'])?$_REQUEST['response']:'';
        $info_quantity	            = isset($_REQUEST['info_quantity'])?$_REQUEST['info_quantity']:'';
        $is_point	                = isset($_REQUEST['is_point'])?$_REQUEST['is_point']:'';
        $number_people	            = isset($_REQUEST['number_people'])?$_REQUEST['number_people']:'';
        $start_hour	                = isset($_REQUEST['start_hour'])?$_REQUEST['start_hour']:'';
        $end_hour	                = isset($_REQUEST['end_hour'])?$_REQUEST['end_hour']:'';
        $equip_title	            = isset($_REQUEST['equip_title'])?$_REQUEST['equip_title']:'';
        $green_areas	            = isset($_REQUEST['green_areas'])?$_REQUEST['green_areas']:'';
        $trunk_height               = isset($_REQUEST['trunk_height'])?$_REQUEST['trunk_height']:'';
        $info_quantity	            = isset($_REQUEST['info_quantity'])?$_REQUEST['info_quantity']:'';
        $roots_space	            = isset($_REQUEST['roots_space'])?$_REQUEST['roots_space']:'';
        $height		                = isset($_REQUEST['height'])?$_REQUEST['height']:'';
        $border_length	            = isset($_REQUEST['border_length'])?$_REQUEST['border_length']:'';
        $border_bush	            = isset($_REQUEST['border_bush'])?$_REQUEST['border_bush']:'';
        $characteristics	        = isset($_REQUEST['characteristics'])?$_REQUEST['characteristics']:'';
        $area_in_square_meters	    = isset($_REQUEST['area_in_square_meters'])?$_REQUEST['area_in_square_meters']:'';
        $pump_automation_types	    = isset($_REQUEST['pump_automation_types'])?$_REQUEST['pump_automation_types']:'';
        $extra_pump         	    = isset($_REQUEST['extra_pump'])?$_REQUEST['extra_pump']:'';
        $type_of_pump       	    = isset($_REQUEST['type_of_pump'])?$_REQUEST['type_of_pump']:'';
        $area               	    = isset($_REQUEST['area'])?$_REQUEST['area']:'';
        $type_of_condition          = isset($_REQUEST['type_of_condition'])?$_REQUEST['type_of_condition']:'';
        $size_category              = isset($_REQUEST['size_category'])?$_REQUEST['size_category']:'';
        $extra_condition_drop       = isset($_REQUEST['extra_condition_drop'])?$_REQUEST['extra_condition_drop']:'';
        $sub_over_terrain	        = isset($_REQUEST['sub_over_terrain'])?$_REQUEST['sub_over_terrain']:'';
        $extra_pillar               = isset($_REQUEST['extra_pillar'])?$_REQUEST['extra_pillar']:'';
        $type_of_automation         = isset($_REQUEST['type_of_automation'])?$_REQUEST['type_of_automation']:'';
        $head_multi_dropdown        = isset($_REQUEST['head_multi_dropdown'])?$_REQUEST['head_multi_dropdown']:'';
        
		switch($action){
		
		
			case 'getoptions':
						get_options();
						
					break;
			
			case 'getcommands':
						get_commands();
						
					break;
		
			case 'getspecies_types':
						getspecies_types();
						
					break;
		
					
			case 'update_tb_infotable':
						update_tb_infotable();	
						
					break;
					
			case 'update_lc_infotable':
						update_lc_infotable();	
						
					break;
					
			case 'update_bb_infotable':
						update_bb_infotable();	
						
					break;
					
			case 'update_dp_infotable':
						update_dp_infotable();
					break;
					
			case 'update_pd_infotable':
						update_pd_infotable();
					break;
					
			case 'update_tb_condtable':
				    	update_tb_condtable();	
						
					break;
			
			case 'update_bb_condtable':
				    	update_bb_condtable();	
						
					break;
			
			case 'update_dp_condtable':
				    	update_dp_condtable();	
						
					break;
				
			case 'update_pd_condtable':
				    	update_pd_condtable();	
						
					break;
					
					
			case 'update_lc_condtable':
				    	update_lc_condtable();	
						
					break;
					
			case 'updatepolyinfotable':
						updatepolyinfotable();	
						
					break;
					
			
			case 'updatepolycondtable':
						updatepolycondtable();	
						
					break;
					
			case 'updateactiontable':
						updateactiontable();	
						
					break;
					
			case 'updateextratable':
						updateextratable();	
						
					break;		
			
			case 'updateassignmenttable':
						updateassignmenttable();	
						
					break;	
					
			case 'getinfo':
						getinfo_tab();	
						
					break;
					
			case 'geteditdata':
						geteditdata();	
						
					break;
					
			case 'getequipment':
						getequipdata();	
						
					break;
			
			case 'respondcommands':
						updateresponsecommand();	
						
					break;
					
					
	
			case 'login':
			
					if($email != '' && $password != ''){
					
						login();	
					}
					else{
						echo json_encode(array('State'=>'false','Response'=>'Missing Username or Password'));
					}
					break;
								
			
			default:	
					echo json_encode(array('State'=>'false','Response'=>'No Action Found.'));
		}
	
  	$mysqli -> close();

	}else{
	
		header('Content-type: application/json');
		echo json_encode(array('State'=>'false','Response'=>'Action Missing'));
		
	}
	
?>