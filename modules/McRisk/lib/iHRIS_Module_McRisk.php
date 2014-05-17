<?php
class iHRIS_Module_McRisk extends I2CE_Module {
    public static function getMethods() {
        return array(
            'iHRIS_PageView->action_person_mcrisk' => 'action_person_mcrisk'
            );
    }


    public function action_person_mcrisk($obj) {
        if (!$obj instanceof iHRIS_PageView) {
            return;
        }
        return $obj->addChildForms('person_mcrisk', 'siteContent');
    }
}
?>