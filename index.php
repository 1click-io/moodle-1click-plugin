<?php

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');

require_once(dirname(__FILE__).'/lib.php');

$id = required_param('id', PARAM_INT);   // course

$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);

require_course_login($course);

//add_to_log($course->id, 'oneclick', 'view all', 'index.php?id='.$course->id, '');

$coursecontext = context_course::instance($course->id);

$PAGE->set_url('/mod/oneclick/index.php', array('id' => $id));
$PAGE->set_title(format_string($course->fullname));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($coursecontext);

echo $OUTPUT->header;

if (! $oneclicks = get_all_instances_in_course('oneclick', $course)) {
    notice(get_string('nonewoneclicks', 'oneclick'), new moodle_url('/course/view.php', array('id' => $course->id)));
}


$table = new html_table();
if ($course->format == 'weeks') {
    $table->head  = array(get_string('week'), get_string('name'));
    $table->align = array('center', 'left');
} else if ($course->format == 'topics') {
    $table->head  = array(get_string('topic'), get_string('name'));
    $table->align = array('center', 'left', 'left', 'left');
} else {
    $table->head  = array(get_string('name'));
    $table->align = array('left', 'left', 'left');
}

foreach($oneclicks as $oneclick){
	if (!$oneclick->visible) {
        $link = html_writer::link(
            new moodle_url('/mod/oneclick.php', array('id' => $oneclick->coursemodule)),
            format_string($oneclick->name, true),
            array('class' => 'dimmed'));
    } else {
        $link = html_writer::link(
            new moodle_url('/mod/oneclick.php', array('id' => $oneclick->coursemodule)),
            format_string($oneclick->name, true));
    }

    if ($course->format == 'weeks' or $course->format == 'topics') {
        $table->data[] = array($oneclick->section, $link);
    } else {
        $table->data[] = array($link);
    }
}

echo $OUTPUT->heading(get_string('modulenameplural', 'oneclick'), 2);
echo html_writer::table($table);
echo $OUTPUT->footer();






?>


