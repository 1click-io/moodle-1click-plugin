<?php

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE___).'/lib.php');

$id = optional_param('id', 0, PARAM_INT);
$n = optional_param('n', 0 , PARAM_INT);

if($id){
	$cm = get_coursemodule_from_id('oneclick', $id, 0, false, MUST_EXIST);
	$course     = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
    $oneclick  = $DB->get_record('oneclick', array('id' => $cm->instance), '*', MUST_EXIST);
}elseif($n){
	$oneclick  = $DB->get_record('oneclick', array('id' => $n), '*', MUST_EXIST);
    $course = $DB->get_record('course', array('id' => $oneclick->course), '*', MUST_EXIST);
    $cm     = get_coursemodule_from_instance('oneclick', $oneclick->id, $course->id, false, MUST_EXIST);
}else{
	error("you must specify a course module ID or instance ID");
}	

require_login($course, true, $cm);
$context = context_module::instance($cm->id);

//add_to_log($course->id, 'oneclick', 'view', "view.php?id={$cm->id}", $oneclick->name, $cm->id);

$PAGE->set_url('/mod/oneclick/view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($oneclick->name));

$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($context);




echo $OUTPUT->header();		

// Replace the following lines with you own code
echo $OUTPUT->heading($oneclick->name);
//echo $OUTPUT->
$roomname = $oneclick->name;
echo <<< EOT
<script  src="https://1click.io/static/js/jquery.min.js" type="text/javascript"></script>
<script src="https://1click.io/static/js/adapter.js" type="text/javascript"></script>
<script  src="https://1click.io/static/js/oks.js" type="text/javascript"></script>  
EOT;
echo "<script>";
echo "var identity = '".$roomname."'";
//echo "var identity = 'chemistryclass'";
echo "</script>";

$html="<video id='remoteView' autoplay style='width: 480px;'> </video><br>" ;
$html.="<button onclick='video_call();' style='margin-right: 50px; margin-bottom: 20px;'>Start Call</button>" ;
$html.="<button onclick='hang_up(1);'>End Call</button>" ;
echo $html;
// Finish the page
echo $OUTPUT->footer();









?>
