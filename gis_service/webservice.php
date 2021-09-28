<?php
header("content-type: text/html;charset=utf-8");
include"config.php";

////////////////////////////////////////////////////////
//////////////////////////////////////////////////////

function login(){
	
	
	global $mysqli;
	global $email;
	global $password;
	
	$online_status = 1;
	$ResponseStatus = array();	

	$domain = strstr($email, '@');
	if($domain)
		$where_cls	= "email='".$email."'";
	else
		$where_cls	= "email='".$email."'";
		
		
	$query = "SELECT * FROM user_info WHERE ".$where_cls;
	$res2 =$mysqli -> query($query) or die(queryFailed());
	$hash = $res2 -> fetch_assoc();
	
	if (password_verify($password, $hash['password'])) {
	
	
	$res =$mysqli -> query($query) or die(queryFailed());
	    if($res->num_rows > 0){
		
		    while($row = $res -> fetch_assoc()){
		
			array_push($ResponseStatus,$row);	
	    	}
		
		$status=true;
		
	    }else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>109, 'error_message'=>'Invalid username '));
	    }
	}
    else {
            
        $status = false;
		$ResponseStatus = array(array('error_code'=>109, 'error_message'=>'Invalid password'));
    }

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
}

function getequipdata(){
	
	
	global $mysqli;
	
	$ResponseStatus = array();	
	
	
	$query = "SELECT * FROM equipment_table";
	
	
	$res =$mysqli -> query($query);
	if($res->num_rows > 0){
		
		while($row = $res -> fetch_assoc()){
		
			array_push($ResponseStatus,$row);	
		}
		
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>109, 'error_message'=>'Invalid Data'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
}

function getspecies_types(){
	
	
	global $mysqli;
	global $user_id;
	global $species;
	
	$ResponseStatus = array();	
	$where_cls	= "base_species='".$species."'";
	
	
	$query = "SELECT * FROM species_types WHERE ".$where_cls;
	
	
	$res =$mysqli -> query($query);
	if($res->num_rows > 0){
		
		while($row = $res -> fetch_assoc()){
		
			array_push($ResponseStatus,$row);	
		}
		
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>109, 'error_message'=>'Invalid ID'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
}

function get_options(){
	
	
	global $mysqli;
	global $user_id;
	
	$ResponseStatus = array();	
	
	$query = "SELECT * FROM info_options";
	
	$res =$mysqli -> query($query);
	if($res->num_rows > 0){
		
		while($row = $res -> fetch_assoc()){
		
			array_push($ResponseStatus,$row);	
		}
		
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>109, 'error_message'=>'Invalid ID'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
}

function get_commands(){
	
	
	global $mysqli;
	global $user_id;
	
	$ResponseStatus = array();	
#	$where_cls	= "user_id='".$user_id."'";
	$where_cls	= "user_id='".$user_id."' AND is_submitted = '0'";
	
	
	
	$query = "SELECT * FROM create_assignment WHERE ".$where_cls;
	
	#echo $query; 
	$res =$mysqli -> query($query);
	if($res->num_rows > 0){
		
		while($row = $res -> fetch_assoc()){
		
			array_push($ResponseStatus,$row);	
		}
		
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('State'=>109, 'Response'=>'No Command found'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
}

function getinfo_tab(){
	
	
	global $mysqli;
	global $user_id;
	
	$ResponseStatus = array();	
	$where_cls	= "user_id='".$user_id."'";
	
	
	$query = "SELECT * FROM information_table WHERE ".$where_cls;
	
	$res =$mysqli -> query($query);
	if($res->num_rows > 0){
		
		 $res -> fetch_field();
		while($row = $res -> fetch_assoc()){
		  
		    #$row["info_name"]=base64_encode($row["info_name"]);
			array_push($ResponseStatus,$row);
			
		}
		
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>109, 'error_message'=>'Invalid ID'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
}

function geteditdata(){
	
	
	global $mysqli;
	global $data_id;
	
	$ResponseStatus = array();	
	
	$query = "SELECT * FROM condition_table c, action_table a, extra_table e,assignment_table ass where '".$data_id."' = c.data_id AND '".$data_id."' = a.data_id AND '".$data_id."' = e.data_id AND '".$data_id."' = ass.data_id";
	$res =$mysqli -> query($query);
	if($res->num_rows > 0){
		
		while($row = $res -> fetch_assoc()){
		
			array_push($ResponseStatus,$row);	
		}
		
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>109, 'error_message'=>'Invalid ID'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
}

function update_tb_infotable(){
		
	global $mysqli;
	global $date;
	global $lat;
	global $lon;
	global $user_id;
	global $data_id;
	global $date_created;	
	global $date_modified;
	global $type_of_point;
	global $info_name;
	global $species;
	global $address;
	global $trunk_diameter;
	global $komi_diameter;
	global $height;
	global $komi_height;
	global $trunk_slope;
	global $available_growth;
	global $is_point;
	global $green_areas;
	global $trunk_height;
	global $info_quantity;
	
	$query = "Insert INTO information_table_trees_bushes".
       "(is_point,lat,lon,user_id,data_id,green_areas,type_of_point,info_name,species,address,trunk_diameter,komi_diameter,height,trunk_height,komi_height,trunk_slope,available_growth,info_quantity)".
       "VALUES('$is_point','$lat','$lon','$user_id','$data_id','$green_areas','$type_of_point','$info_name','$species','$address','$trunk_diameter','$komi_diameter','$height','$trunk_height','$komi_height','$trunk_slope','$available_growth','$info_quantity') ON DUPLICATE KEY UPDATE is_point='$is_point', lat='$lat', lon = '$lon',user_id = '$user_id',type_of_point= '$type_of_point',info_name= '$info_name',species='$species',address='$address',trunk_diameter='$trunk_diameter',komi_diameter='$komi_diameter',height='$height',komi_height='$komi_height',trunk_slope='$trunk_slope',available_growth='$available_growth'";
	
	$retval =$mysqli -> query($query);

	if($retval)
	{
	
		$ResponseStatus = array(array('code'=>1, 'message'=>'Successfully Inserted'));
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>109, 'message'=>'ERROR'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
	
}

function update_lc_infotable(){
		
	global $mysqli;
	global $date;
	global $latlon;
	global $lat;
	global $lon;
	global $user_id;
	global $data_id;
	global $date_created;	
	global $date_modified;
	global $type_of_point;
	global $info_name;
	global $species;
	global $address;
	global $is_point;
	global $green_areas;
	global $characteristics;
    global $area_in_square_meters;
	
	$query = "Insert INTO information_table_land_cover".
       "(latlon ,is_point,lat,lon,user_id,data_id,green_areas,type_of_polygon,info_name,species,address,characteristics,area_in_square_meters)".
       "VALUES('$latlon','$is_point','$lat','$lon','$user_id','$data_id','$green_areas','$type_of_point','$info_name','$species','$address','$characteristics','$area_in_square_meters')ON DUPLICATE KEY UPDATE info_name ='$$info_name'";
	$retval =$mysqli -> query($query);

	if($retval)
	{
	
		$ResponseStatus = array(array('code'=>1, 'message'=>'Successfully Inserted'));
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>10, 'message'=>'ERROR'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
	
}

function update_bb_infotable(){
		
	global $mysqli;
	global $date;
	global $lat;
	global $lon;
	global $user_id;
	global $data_id;
	global $date_created;	
	global $date_modified;
	global $type_of_point;
	global $info_name;
	global $species;
	global $address;
	global $is_point;
	global $height;
	global $border_length;
    global $border_bush;
    global $latlon;
	
	$query = "Insert INTO information_table_border_bush".
       "(latlon,is_point,lat,lon,user_id,info_name,data_id,species,address,height,border_length,border_bush)".
       "VALUES('$latlon','$is_point','$lat','$lon','$user_id','$info_name','$data_id','$species','$address','$height','$border_length','$border_bush')ON DUPLICATE KEY UPDATE height ='$height'";
	$retval =$mysqli -> query($query);

	if($retval)
	{
	
		$ResponseStatus = array(array('code'=>1, 'message'=>'Successfully Inserted'));
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>10, 'message'=>'ERROR'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
	
}

function update_dp_infotable(){
		
	global $mysqli;
	global $date;
	global $lat;
	global $lon;
	global $user_id;
	global $data_id;
	global $date_created;	
	global $date_modified;
	global $type_of_point;
	global $info_name;
	global $address;
    global $area_in_square_meters;
    global $sub_over_terrain;
    global $extra_pillar;
    global $type_of_automation;
    global $head_multi_dropdown;
    global $latlon;
	
	$query = "Insert INTO information_table_drain_pillar".
       "(latlon,is_point,lat,lon,user_id,data_id,sub_over_terrain,extra_pillar,type_of_automation,head_multi_dropdown,area_in_square_meters,info_name,address)".
       "VALUES('$latlon','$is_point','$lat','$lon','$user_id','$data_id','$sub_over_terrain','$extra_pillar','$type_of_automation','$head_multi_dropdown','$area_in_square_meters','$info_name','$address')ON DUPLICATE KEY UPDATE info_name ='$$info_name'";
	$retval =$mysqli -> query($query);

	if($retval)
	{
	
		$ResponseStatus = array(array('code'=>1, 'message'=>'Successfully Inserted'));
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>10, 'message'=>'ERROR'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
	
}

function update_pd_infotable(){
		
	global $mysqli;
	global $date;
	global $lat;
	global $lon;
	global $user_id;
	global $data_id;
	global $date_created;	
	global $date_modified;
	global $type_of_point;
	global $name;
	global $address;
    global $area;
    global $pump_automation_types;
    global $extra_pump;
    global $type_of_pump;
    global $head_multi_dropdown;
	
	$query = "Insert INTO information_table_pump_drill".
       "(is_point,lat,lon,user_id,data_id,pump_automation_types,extra_pump,type_of_pump,head_multi_dropdown,area,name,address)".
       "VALUES('$is_point','$lat','$lon','$user_id','$data_id','$pump_automation_types','$extra_pump','$type_of_pump','$head_multi_dropdown','$area','$name','$address')ON DUPLICATE KEY UPDATE name ='$name'";
	$retval =$mysqli -> query($query);

	if($retval)
	{
	
		$ResponseStatus = array(array('code'=>1, 'message'=>'Successfully Inserted'));
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>10, 'message'=>'ERROR'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
	
}

function updatepolyinfotable(){
		
	global $mysqli;
	global $date;
	global $latlon;
	global $user_id;
	global $data_id;
	global $date_created;	
	global $date_modified;
	global $type_of_point;
	global $info_name;
	global $species;
	global $address;
	global $info_quantity;
	global $is_point;
	
	$query = "Insert INTO information_table".
       "(is_point,latlon,user_id,data_id,type_of_point,info_name,species,address,info_quantity)".
       "VALUES('$is_point','$latlon','$user_id','$data_id','$type_of_point','$info_name','$species','$address','$info_quantity') ON DUPLICATE KEY UPDATE is_point='$is_point',user_id = '$user_id', latlon='$latlon',type_of_point= '$type_of_point',info_name= '$info_name',species='$species',address='$address',info_quantity='$info_quantity'";
	
	$retval =$mysqli -> query($query);

	if($retval)
	{
	
		$ResponseStatus = array(array('code'=>1, 'message'=>'Successfully Inserted'));
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>109, 'message'=>'ERROR'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
	
}

function update_tb_condtable(){
		
	global $mysqli;
	global $date;
	global $data_id;
	global $overall_health;	
	global $cond_name;
	global $address;
	global $stability;
	global $trunk_status;
	global $trunk_problems;
	global $komi_status;
	global $komi_problems;
	global $diseases;
	global $recommended;
	global $condition_notes;
	global $roots_space;
	
	$query = "Insert INTO condition_table_trees_bushes".
       "(data_id,overall_health,cond_name,address,roots_space,stability,trunk_status,trunk_problems,komi_status,komi_problems,diseases,recommended,condition_notes)".
       "VALUES('$data_id','$overall_health','$cond_name','$address','$roots_space','$stability','$trunk_status','$trunk_problems','$komi_status','$komi_problems','$diseases','$recommended','$condition_notes') ON DUPLICATE KEY UPDATE overall_health ='$overall_health', cond_name='$cond_name',address='$address',stability='$stability',trunk_status='$trunk_status',trunk_problems='$trunk_problems',komi_status='$komi_status',komi_problems='$komi_problems',diseases='$diseases',recommended='$recommended',condition_notes='$condition_notes'";
	
	$retval =$mysqli -> query($query);

	if($retval)
	{
	
		$ResponseStatus = array(array('code'=>1, 'message'=>'Condition Table Updated'));
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>109, 'message'=>'ERROR Condition Table'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
	
}

function update_bb_condtable(){
		
	global $mysqli;
	global $date;
	global $data_id;
	global $overall_health;	
	global $cond_name;
	global $address;
	global $stability;
	global $damages_from_diseases;
	global $damages;
	global $diseases;
	global $recommended;
	global $condition_notes;
	
	$query = "Insert INTO condition_table_border_bush".
       "(data_id,overall_health,cond_name,address,stability,diseases,recommended,condition_notes)".
       "VALUES('$data_id','$overall_health','$cond_name','$address','$stability','$diseases','$recommended','$condition_notes') ON DUPLICATE KEY UPDATE overall_health ='$overall_health', cond_name='$cond_name',address='$address',stability='$stability',diseases='$diseases',recommended='$recommended',condition_notes='$condition_notes'";

	$retval =$mysqli -> query($query);

	if($retval)
	{
	
		$ResponseStatus = array(array('code'=>1, 'message'=>'Condition Table Updated'));
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>109, 'message'=>'ERROR Condition Table'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
	
}

function update_dp_condtable(){
		
	global $mysqli;
	global $date;
	global $data_id;
	global $overall_health;	
	global $cond_name;
	global $address;
	global $stability;
	global $type_of_condition;
	global $size_category;
	global $condition_notes;
	
	$query = "Insert INTO condition_table_drain_pillar".
       "(data_id,overall_health,cond_name,address,stability,type_of_condition,size_category,condition_notes)".
       "VALUES('$data_id','$overall_health','$cond_name','$address','$stability','$type_of_condition','$size_category','$condition_notes') ON DUPLICATE KEY UPDATE overall_health ='$overall_health', cond_name='$cond_name',address='$address',stability='$stability',condition_notes='$condition_notes'";

	$retval =$mysqli -> query($query);

	if($retval)
	{
	
		$ResponseStatus = array(array('code'=>1, 'message'=>'Condition Table Updated'));
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>109, 'message'=>'ERROR Condition Table'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
	
}

function update_pd_condtable(){
		
	global $mysqli;
	global $date;
	global $data_id;
	global $overall_health;	
	global $cond_name;
	global $address;
	global $stability;
	global $type_of_condition;
	global $size_category;
	global $extra_condition_drop;
	global $condition_notes;
	
	$query = "Insert INTO condition_table_pump_drill".
       "(data_id,overall_health,cond_name,address,stability,extra_condition_drop,type_of_condition,size_category,condition_notes)".
       "VALUES('$data_id','$overall_health','$cond_name','$address','$stability','$extra_condition_drop','$type_of_condition','$size_category','$condition_notes') ON DUPLICATE KEY UPDATE overall_health ='$overall_health', cond_name='$cond_name',address='$address',stability='$stability',condition_notes='$condition_notes'";

	$retval =$mysqli -> query($query);

	if($retval)
	{
	
		$ResponseStatus = array(array('code'=>1, 'message'=>'Condition Table Updated'));
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>109, 'message'=>'ERROR Condition Table'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
	
}

function update_lc_condtable(){
		
	global $mysqli;
	global $date;
	global $data_id;
	global $overall_health;	
	global $cond_name;
	global $address;
	global $stability;
	global $damages_from_diseases;
	global $damages;
	global $diseases;
	global $recommended;
	global $condition_notes;
	
	$query = "Insert INTO condition_table_land_cover".
       "(data_id,overall_health,cond_name,address,damages,stability,diseases,damages_from_diseases,recommended,condition_notes)".
       "VALUES('$data_id','$overall_health','$cond_name','$address','$damages','$stability','$diseases','$damages_from_diseases','$recommended','$condition_notes') ON DUPLICATE KEY UPDATE overall_health ='$overall_health', cond_name='$cond_name',address='$address',stability='$stability',diseases='$diseases',recommended='$recommended',condition_notes='$condition_notes'";

	$retval =$mysqli -> query($query);

	if($retval)
	{
	
		$ResponseStatus = array(array('code'=>1, 'message'=>'Condition Table Updated'));
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>109, 'message'=>'ERROR Condition Table'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
	
}

function updatepolycondtable(){
		
	global $mysqli;
	global $date;
	global $data_id;
	global $overall_health;	
	global $cond_name;
	global $condition_notes;
	
	$query = "Insert INTO condition_table".
       "(data_id,overall_health,cond_name,condition_notes)".
       "VALUES('$data_id','$overall_health','$cond_name','$condition_notes') ON DUPLICATE KEY UPDATE overall_health ='$overall_health', cond_name='$cond_name',condition_notes='$condition_notes'";
	
	$retval =$mysqli -> query($query);

	if($retval)
	{
	
		$ResponseStatus = array(array('code'=>1, 'message'=>'Condition Table Updated'));
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>109, 'message'=>'ERROR Condition Table'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
	
}

function updateactiontable(){
		
	global $mysqli;
	global $date;
	global $data_id;	
	global $action_type;
	global $action_name;
	global $action_notes;
	
	$query = "Insert INTO action_table".
       "(data_id,action_type,action_name,action_notes)".
       "VALUES('$data_id','$action_type','$action_name','$action_notes') ON DUPLICATE KEY UPDATE action_type='$action_type',action_name='$action_name',action_notes='$action_notes'";
	$retval =$mysqli -> query($query);

	if($retval)
	{
	
		$ResponseStatus = array(array('code'=>1, 'message'=>'Action Table Updated'));
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>109, 'message'=>'ERROR Action Table'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
	
}

function updateresponsecommand(){
		
	global $mysqli;
	global $user_id;
	global $assig_id;	
	global $order_amount_completed;
	global $response;
	
	global $number_people;
	global $start_hour;
	global $end_hour;
	global $equip_title;
	
    $todate = date('y-m-d h:i:s');
    $query =  "Update create_assignment SET is_submitted = '1', quantity_order_amount_completed = '" .$order_amount_completed."',date_submitted='".$todate."', response = '".$response."', number_of_persons = '" .$number_people ."',start_hour='".$start_hour."', end_hour = '".$end_hour."', equipment_title = '".$equip_title."' WHERE assig_id ='".$assig_id."'&& user_id ='".$user_id."'"; 

	
	$retval =$mysqli -> query($query);

	if($retval)
	{
	
		$ResponseStatus = array(array('code'=>1, 'message'=>'Successfully Inserted'));
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>109, 'message'=>'ERROR Response'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
	
}

function updateextratable(){
		
	global $mysqli;
	global $date;
	global $data_id;
	global $obstacles;	
	global $extra_name;
	global $pavement;
	global $class;
	global $nearby;
	global $obstacle_to_humans;
	global $extras_notes;
	
	$query = "Insert INTO extra_table".
       "(data_id,obstacles,extra_name,pavement,class,nearby,obstacle_to_humans,extras_notes)".
       "VALUES('$data_id','$obstacles','$extra_name','$pavement','$class','$nearby','$obstacle_to_humans','$extras_notes') ON DUPLICATE KEY UPDATE obstacles='$obstacles',extra_name='$extra_name',pavement='$pavement',class='$class',nearby='$nearby',obstacle_to_humans='$obstacle_to_humans',extras_notes='$extras_notes'";
	
	$retval =$mysqli -> query($query);

	if($retval)
	{
	
		$ResponseStatus = array(array('code'=>1, 'message'=>'Extra Table Updated'));
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>109, 'message'=>'ERROR Extra Table'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
	
}

function updateassignmenttable(){
		
	global $mysqli;
	global $date;
	global $data_id;
	global $invoice;	
	global $assignment_name;
	global $point_assignment_category;
	global $unit_point_assignment;
	global $point_assignment_quantity;
	global $point_assignment_quantity_initial;
	global $assignment_notes;
	
	$query = "Insert INTO assignment_table".
       "(data_id,invoice,assignment_name,point_assignment_category,unit_point_assignment,point_assignment_quantity,point_assignment_quantity_initial,assignment_notes)".
       "VALUES('$data_id','$invoice','$assignment_name','$point_assignment_category','$unit_point_assignment','$point_assignment_quantity','$point_assignment_quantity_initial','$assignment_notes') ON DUPLICATE KEY UPDATE invoice='$invoice',assignment_name='$assignment_name',point_assignment_category='$point_assignment_category',unit_point_assignment='$unit_point_assignment',point_assignment_quantity='$point_assignment_quantity',point_assignment_quantity_initial='$point_assignment_quantity_initial',assignment_notes='$assignment_notes'";
	
	$retval =$mysqli -> query($query);

	if($retval)
	{
	
		$ResponseStatus = array(array('code'=>1, 'message'=>'Assignment Table Updated'));
		$status=true;
		
	}else{
	
		$status = false;
		$ResponseStatus = array(array('error_code'=>109, 'message'=>'ERROR Assignment Table'));
	}

	header('Content-type: application/json');
	echo json_encode(array('State'=>$status,'Response'=>$ResponseStatus));
	
}

?>