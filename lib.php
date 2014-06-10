<?php


require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once($CFG->dirroot.'/course/lib.php');
////include 'invite.php';
//require_once('module.php'); 
//require_once('invite.php');


defined('MOODLE_INTERNAL') || die();
  

function oneclick_add_instance(stdClass $oneclick, mod_oneclick_mod_form $mform = null){
  global $DB;

  $roomname = $oneclick->name;
  $duration = $oneclick->duration;

  echo $roomname;
  echo $duration;

  create_room($roomname, $duration);



  return $DB->insert_record('oneclick', $oneclick);
}
function oneclick_update_instance(stdClass $oneclick, mod_oneclick_mod_form $mform = null){
  global $DB;

  $oneclick->id = $oneclick->instance;

  return $DB->update_record('oneclick', $oneclick);


}

function oneclick_delete_instance($id){

  global $DB;

  if (! $oneclick = $DB->get_record('oneclick', array('id' => $id))) {
        return false;
    }

    # Delete any dependent records here #

    $DB->delete_records('oneclick', array('id' => $oneclick->id));

    return true;

}

function create_room($name,$datetime){

  global $CFG;
 
  

$service_url = "https://1click.io/api/v1/conference/";
$curl = curl_init();
curl_setopt($curl, CURLOPT_HEADER, false);
$accesstoken= "Apikey ".$CFG->email.":".$CFG->apikey;
//$accesstoken = "Apikey deep.kush04@gmail.com:59db3e24045923cc0da98d472c9429809bd50d7e";

$data = array(
        'title'=>$name,
      //  'scheduled_time'=>$datetime,
        //'scheduled_time' => $datetime,
        'scheduled_duration' => '60',
        'layout' => 'dynamic',
        'conference_type'=>'multiway'
);
$data_string = json_encode($data);
curl_setopt($curl, CURLOPT_URL,$service_url);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($curl, CURLOPT_HTTPHEADER,array(
     'Content-Type: application/json',                                                                                
     'Accept: application/json',
     'user: '.$accesstoken,
     'Authorization: '.$accesstoken)
 );
curl_setopt($curl, CURLOPT_POST,true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$rest = curl_exec($curl);
$httpCode = curl_getinfo ( $curl, CURLINFO_HTTP_CODE );
//$data = curl_getinfo($curl);
//print_r($data);

if($httpCode == 201){
    echo "succesfully created room";
   /* echo "<form name='invite' method ='post' action='invite.php'>";
    echo "add invites email (put a , after each invite email) <br>";
    echo "<input type='text' name = 'email' size='60' ><br>";
    echo "<input type='hidden' value='".$name."' name='roomname'>";
    echo "<INPUT type='submit' value='Send invite'>";
    echo "</form>";*/
}
else if($httpCode == 404)
    echo "Already existing room";
/*if ($rest === false)
{
     throw new Exception('Curl error: ' . curl_error($crl));
    print_r('Curl error: ' . curl_error($curl));
}
*/
curl_close($curl);
//print_r($rest);
}





?>