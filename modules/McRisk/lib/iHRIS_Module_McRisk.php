<?php
class iHRIS_Module_McRisk extends I2CE_Module {
    public static function getMethods() {
        return array(
            'iHRIS_PageView->action_person_mrisk' => 'action_person_mcrisk',
            'iHRIS_PageView->action_person_continuous_mcrisk' => 'action_person_continuous_mcrisk'
            );
    }


    public function action_person_mcrisk($obj) {
        if (!$obj instanceof iHRIS_PageView) {
            return;
        }
        return $obj->addChildForms('person_mcrisk', 'siteContent');
    }
    public function action_person_continuous_mcrisk($obj) {
        if (!$obj instanceof iHRIS_PageView) {
            return;
        }
        return $obj->addChildForms('person_continuous_mcrisk', 'siteContent');
    }
}
?>