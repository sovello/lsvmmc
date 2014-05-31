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


}
# Local Variables:
# mode: php
# c-default-style: "bsd"
# indent-tabs-mode: nil
# c-basic-offset: 4
# End:
