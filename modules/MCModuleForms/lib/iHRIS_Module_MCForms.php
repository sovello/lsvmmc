<?php
/**
* © Copyright 2009 IntraHealth International, Inc.
* 
* This File is part of I2CE 
* 
* I2CE is free software; you can redistribute it and/or modify 
* it under the terms of the GNU General Public License as published by 
* the Free Software Foundation; either version 3 of the License, or
* (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful, 
* but WITHOUT ANY WARRANTY; without even the implied warranty of 
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the 
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License 
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*
* @package vmmc
* @author Sovello Hildebrand <sovellohpmgani@gmail.com>
* @version v4.1
* @filesource
*/
/**
* Class iHRIS_Module_MCForms
*
* @access public
*/

class iHRIS_Module_MCForms extends I2CE_Module {

    public static function getMethods() {
        return array(
            'iHRIS_PageView->action_risk_reduction' => 'action_risk_reduction',
            'iHRIS_PageView->action_tb_screening' => 'action_tb_screening',
            'iHRIS_PageView->action_referral_linkages' => 'action_referral_linkages',
            'iHRIS_PageView->action_medical_history' => 'action_medical_history',
            'iHRIS_PageView->action_physical_exam' => 'action_physical_exam',
            'iHRIS_PageView->action_mc_procedure' => 'action_mc_procedure',
            'iHRIS_PageView->action_adverse_event' => 'action_adverse_event',
            'iHRIS_PageView->action_followup_notes' => 'action_followup_notes'
            );
    }


    public function action_risk_reduction($obj) {
        if (!$obj instanceof iHRIS_PageView) {
            return;
        }
        return $obj->addChildForms('risk_reduction', 'siteContent');
    }
    
    public function action_tb_screening($obj) {
        if (!$obj instanceof iHRIS_PageView) {
            return;
        }
        return $obj->addChildForms('tb_screening', 'siteContent');
    }
    
    public function action_referral_linkages($obj) {
        if (!$obj instanceof iHRIS_PageView) {
            return;
        }
        return $obj->addChildForms('referral_linkages', 'siteContent');
    }


    public function action_medical_history($obj) {
        if (!$obj instanceof iHRIS_PageView) {
            return;
        }
        return $obj->addChildForms('medical_history', 'siteContent');
    }


    public function action_physical_exam($obj) {
        if (!$obj instanceof iHRIS_PageView) {
            return;
        }
        return $obj->addChildForms('physical_exam', 'siteContent');
    }


    public function action_mc_procedure($obj) {
        if (!$obj instanceof iHRIS_PageView) {
            return;
        }
        return $obj->addChildForms('mc_procedure', 'siteContent');
    }


    public function action_adverse_event($obj) {
        if (!$obj instanceof iHRIS_PageView) {
            return;
        }
        return $obj->addChildForms('adverse_event', 'siteContent');
    }


    public function action_followup_notes($obj) {
        if (!$obj instanceof iHRIS_PageView) {
            return;
        }
        return $obj->addChildForms('followup_notes', 'siteContent');
    }

    /**
     * Return the array of hooks available in this module.
     * @return array
     */
    public static function getHooks() {
        $hooks = array();
        $hooks["validate_form_followup_notes"] = "validate_form_followup_notes";
        return $hooks;
    }
    
    protected $leave_type;
    protected $duration;
    protected $duration_limit;
    /**
     * Perform any extra validation for the person_leave_request form.
     * @param I2CE_Form $form
     */
    public function validate_form_followup_notes( $form ) {
        $parentform = $form->getField('parent')->getValue();
        if ( in_array('pr', $form->visit) ) {
          I2CE::raiseError("The parent is here: $parentform");
          $mcProcedure = array(
            'operator'=>'FIELD_LIMIT',
            'field'=>'parent',
            'style'=>'equals',
            'data'=>array(
              'value'=>$parentform
              )
            ); 
            $mcproc = I2CE_FormStorage::listFields('mc_procedure', array('procedure_date'), false, $mcProcedure);
            $mcprocdata = current($mcproc);
            $procdate = $this->getdate($mcprocdata['procedure_date']);
         $datePr = new DateTime($procdate);
        $dateSec = new DateTime($form->getField('visit_date')->getDBValue());
        if($datePr > $dateSec){ 
       // if($form->visit_date->compare( $procdate ) > -1 ) {
              $form->setInvalidMessage( "visit_date","This date must be greater than the MC Procedure date");
            }
        }
        if ( in_array('de', $form->visit) ) {
          I2CE::raiseError("The parent is here: $parentform");
        $previous = array(
            'operator'=>'AND',
            'operand'=>array(
                0=>array(
                    'operator'=>'FIELD_LIMIT',
                    'field'=>'visit',
                    'style'=>'equals',
                    'data'=>array(
                        'value'=>'visit|pr'
                        )
                    ),
                1=>array(
                    'operator'=>'FIELD_LIMIT',
                    'field'=>'parent',
                    'style'=>'equals',
                    'data'=>array(
                        'value'=>$parentform
                        )
                    )
                )
            );
        $date = I2CE_FormStorage::listFields('followup_notes', array('id','visit_date', 'visit'), false, $previous);
        $data = current($date);
        $datePr = new DateTime($data['visit_date']);
        $dateSec = new DateTime($form->getField('visit_date')->getDBValue());
        if($datePr > $dateSec){
        //if( $form->visit_date->compare( $this->getdate($data['visit_date']) ) > -1 ){
            $form->setInvalidMessage( "visit_date","This must be greater than the first visit date");
          }
        }
        
        if ( in_array('tr', $form->visit) ) {
          I2CE::raiseError("The parent is here: $parentform");
        $previous = array(
            'operator'=>'AND',
            'operand'=>array(
                0=>array(
                    'operator'=>'FIELD_LIMIT',
                    'field'=>'visit',
                    'style'=>'equals',
                    'data'=>array(
                        'value'=>'visit|de'
                        )
                    ),
                1=>array(
                    'operator'=>'FIELD_LIMIT',
                    'field'=>'parent',
                    'style'=>'equals',
                    'data'=>array(
                        'value'=>$parentform
                        )
                    )
                )
            );
        $date = I2CE_FormStorage::listFields('followup_notes', array('id','visit_date'), false, $previous);
        $data = current($date);
        $datePr = new DateTime($data['visit_date']);
        $dateSec = new DateTime($form->getField('visit_date')->getDBValue());
        if($datePr > $dateSec){
        //if( $form->visit_date->compare( $this->getdate($data['visit_date']) ) > -1 ){
            $form->setInvalidMessage( "visit_date","This must be greater than the second visit date");
          }
        }
        
        }
    /**
     * gets a date value from records read from the datafile
     * @param date $date, a date value as read from the data file
     * @returns date. formatted
     */
    protected function getDate($date, $date_format = 'Y-m-d H:m:s') {
        //first check the date e.g 16/05/2011
        $matches = array();
        if (($datetime = DateTime::createFromFormat($date_format,$date)) === false) {
            $this->addBadRecord("Bad date format [$date] for $date_format");
            return false;
        }
        $date = I2CE_Date::now(I2CE_Date::DATE, $datetime->getTimestamp(),true);
        if (!$date) {
            $this->addBadRecord("Invalid date ($date)");
            return false;
        }
        return $date;
    }
}
# Local Variables:
# mode: php
# c-default-style: "bsd"
# indent-tabs-mode: nil
# c-basic-offset: 4
# End:
