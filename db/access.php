<?php

/**
 * 
 * The variable name for the capability definitions array is $capabilities
 *
 * @package    mod_oneclick
 * @copyright  2014 Deepak Kushwaha
 * @license   1oneclick.io 
 */


defined('MOODLE_INTERNAL') || die();

$capabilities = array(


    'mod/oneclick:myaddinstance' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array(
            'user' => CAP_ALLOW
        ),

        'clonepermissionsfrom' => 'moodle/my:manageblocks'
    ),

	'mod/oneclick:addinstance' => array(
			'riskbitmask' => RISK_XSS,
	
			'captype' => 'write',
			'contextlevel' => CONTEXT_COURSE,
			'archetypes' => array(
					'editingteacher' => CAP_ALLOW,
					'manager' => CAP_ALLOW,
                    'user' =>CAP_ALLOW
			),
			'clonepermissionsfrom' => 'moodle/course:manageactivities'
	),

    'mod/oneclick:view' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_MODULE,
        'legacy' => array(
            'guest' => CAP_ALLOW,
            'student' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'admin' => CAP_ALLOW
        )
    ),

    'mod/oneclick:submit' => array(
        'riskbitmask' => RISK_SPAM,
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'legacy' => array(
            'student' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW
        )
    ),

);



?>
