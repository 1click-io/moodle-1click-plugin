<?php

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/course/moodleform_mod.php');


class mod_oneclick_mod_form extends moodleform_mod{

	public function definition(){
		$mform = $this->_form;
		//adding the general fieldset where all the common settings are showed
		$mform->addElement('header', 'general', get_string('general', 'form'));

		$mform->addElement('text', 'name', get_string('newcallname', 'oneclick'),array('size'=>'64'));


		$mform->addElement('static', 'label1', 'Usage:', 'Use only alphanumeric characters');
		$mform->addElement('static', 'label1', 'Warning:', 'Room Name should be unique across all the courses');

		$mform->addElement('text', 'duration', get_string('callduration', 'oneclick'),array('size'=>'64'));




		if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEAN);
        }

        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximcharacters', '', 255), 'maxlength', 255, 'client');
		$mform->addHelpButton('name', 'newcallname', 'oneclick');


		$this->standard_coursemodule_elements();

		$this->add_action_buttons();

	}

}



?>

