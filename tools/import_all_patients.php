#!/usr/bin/php
<?php
/*
 * © Copyright 2007, 2008 IntraHealth International, Inc.
 * 
 * This File is part of iHRIS
 * 
 * iHRIS is free software; you can redistribute it and/or modify
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
 */
/**
 * The page wrangler
 * 
 * This page loads the main HTML template for the home page of the site.
 * @package iHRIS
 * @subpackage DemoManage
 * @access public
 * @author Sovello Hildebrand <sovellohpmgani@gmail.com>
 * @copyright Copyright &copy; 2007, 2008 IntraHealth International, Inc. 
 * @version Botswana-v4.1
 */


require_once("./import_base.php");



/*********************************************
*
*      Process Class
*
*********************************************/

class EmployeeProcessor extends Processor {
    public function __construct($file){
        parent::__construct($file);
    }
     
    
    protected function mapData() {
        $mapped_data = parent::mapData();        
        return $mapped_data;
    }

    protected function getExpectedHeaders() {
        return  array(
            /*
            'MCAddressDistrict' => 'MCAddressDistrict',
            'UniqueKey' => 'UniqueKey',
            'Recstatus' => 'Recstatus',
            'Patientname' => 'Patientname',
            'Age' => 'Age',
            'Comingfrom' => 'Comingfrom',
            'btestedoffsite' => 'btestedoffsite',
            'ctestedaspartofotherservices' => 'ctestedaspartofotherservices',
            'OLDDATEOFHIVTEST' => 'OLDDATEOFHIVTEST',
            'Negative' => 'Negative',
            'Indeterminate' => 'Indeterminate',
            'IfNo' => 'IfNo',
            'cPainonerection' => 'cPainonerection',
            'hinguinalswelling' => 'hinguinalswelling',
            'iOther' => 'iOther',
            'ePainonurination' => 'ePainonurination',
            'Diagnosed' => 'Diagnosed',
            'OnMedication' => 'OnMedication',
            'Diagnosed1' => 'Diagnosed1',
            'OnMedication1' => 'OnMedication1',
            'Diagnosed11' => 'Diagnosed11',
            'OnMedication11' => 'OnMedication11',
            'OtheregTB' => 'OtheregTB',
            'Diagnosed111' => 'Diagnosed111',
            'OnMedication111' => 'OnMedication111',
            'fDifficultyinretractingforskinitching' => 'fDifficultyinretractingforskinitching',
            'Hasclienteverhadhadanysurgicalo' => 'Hasclienteverhadhadanysurgicalo',
            'Ifyesanycomplicationrelatedtothat' => 'Ifyesanycomplicationrelatedtothat',
            'WoundInfection' => 'WoundInfection',
            'Bleeding' => 'Bleeding',
            'Veinthrombosis' => 'Veinthrombosis',
            'Other' => 'Other',
            'Anybleedingproblemsinselforother' => 'Anybleedingproblemsinselforother',
            'aAnesthetics' => 'aAnesthetics',
            'Antiseptics' => 'Antiseptics',
            'Anyothermedications' => 'Anyothermedications',
            'Anysignificantabnormalityongeneral' => 'Anysignificantabnormalityongeneral',
            'Ifyesspecifyspecify' => 'Ifyesspecifyspecify',
            'Weightkg' => 'Weightkg',
            'Bloodpressure' => 'Bloodpressure',
            'Pulseratebeatsmin' => 'Pulseratebeatsmin',
            'aurethraldischarge1' => 'aurethraldischarge1',
            'gGenitalwarts1' => 'gGenitalwarts1',
            'bGenitalsoreulcer1' => 'bGenitalsoreulcer1',
            'hadhesionofprepucetoglans' => 'hadhesionofprepucetoglans',
            'hinguinalswelling1' => 'hinguinalswelling1',
            'cPainonerection1' => 'cPainonerection1',
            'iOther1' => 'iOther1',
            'dSwellingofthescrotum1' => 'dSwellingofthescrotum1',
            'khypospadias' => 'khypospadias',
            'ePainonurination1' => 'ePainonurination1',
            'lOther' => 'lOther',
            'fDifficultyinretractingforskinitching1' => 'fDifficultyinretractingforskinitching1',
            'ClientMedicallyclearedforMCproc' => 'ClientMedicallyclearedforMCproc',
            'Ifnowhy' => 'Ifnowhy',
            'Ifsurgeryisdelayschedulereturnv' => 'Ifsurgeryisdelayschedulereturnv',
            'STI' => 'STI',
            'Othersurgical' => 'Othersurgical',
            'Surgeonsname' => 'Surgeonsname',
            'Assistantname' => 'Assistantname',
            'Lidocaine1' => 'Lidocaine1',
            'Lidocaine2' => 'Lidocaine2',
            'Methodused' => 'Methodused',
            'IfOtherspecify' => 'IfOtherspecify',
            'Anyadverseeventoccurduringproce' => 'Anyadverseeventoccurduringproce',
            'BPsys' => 'BPsys',
            'Timestarted' => 'Timestarted',
            'Timefinished' => 'Timefinished',
            'Totalduration' => 'Totalduration',
            'BPdias' => 'BPdias',
            'BPsys1' => 'BPsys1',
            'Generalconditionsatdischarge' => 'Generalconditionsatdischarge',
            'Describeconditionofdressinginrelation' => 'Describeconditionofdressinginrelation',
            'Dayspostop' => 'Dayspostop',
            'Condition' => 'Condition',
            'Dayspostop1' => 'Dayspostop1',
            'Condition1' => 'Condition1',
            'AE1' => 'AE1',
            'IfYesAEformfilled1' => 'IfYesAEformfilled1',
            'Counseledonabstinence1' => 'Counseledonabstinence1',
            'Condomgiven1' => 'Condomgiven1',
            'IfYesAEformfilled' => 'IfYesAEformfilled',
            'Counseledonabstinence' => 'Counseledonabstinence',
            'Condomgiven' => 'Condomgiven',
            'Dayspostop11' => 'Dayspostop11',
            'Condition11' => 'Condition11',
            'AE11' => 'AE11',
            'IfYesAEformfilled11' => 'IfYesAEformfilled11',
            'Counseledonabstinence11' => 'Counseledonabstinence11',
            'Condomgiven11' => 'Condomgiven11',
            'DateofHIVtest' => 'DateofHIVtest',
            'Phonenumber' => 'Phonenumber',
            'HIVtestresult' => 'HIVtestresult'
            'Otherreferral' => 'Otherreferral',
            'Consentofferby' => 'Consentofferby',
            'Consentsigned' => 'Consentsigned',
            'MCPROCEDURE' => 'MCPROCEDURE',
            */
            
            'district' => 'MCAddressDistrict',
            'facility' => 'NameoffacilityorMCsite',
            'Village' => 'Village',
            'patient_number' => 'PatientIDnumber',
            'visit_date' => 'Date',
            'marital_status' => 'Maritalstatus',
            'hiv_tested' => 'ClienttestedforHIV',
            'onsite_testing' => 'Ifyesatestedonsite',
            'hiv_testresults' => 'Positive',
            'declined_test' => 'Nottested',
            'client_sti' => 'HasclienthadanySTIsinthelast3mo',
            'urethra_discharge' => 'aurethraldischarge',
            'genital_ulcer' => 'bGenitalsoreulcer',
            'pen_wart' => 'gGenitalwarts',
            'scrotum_swell' => 'dSwellingofthescrotum',
            'art' => 'ARTclinic',
            'procedure_date' => 'DateofMCprocedure',
            'pain' => 'Excesspain',
            'ex_bleeding' => 'Excessivebleeding',
            'anesthetic' => 'Anestheticrelatedevent',
            'ex_skin_removed' => 'Excessiveskinremoved',
            'adv_event' => 'AE',
            'visit_date_1' => 'Firstfollowupvisitidate',
            'visit_date_2' => 'Firstfollowupvisitidate1',
            'visit_date_3' => 'Firstfollowupvisitidate11',
            'penis_damage' => 'Damagetopenis',
            'cdf_count' => 'CD4count'
          );
    }
    
    protected function _processRow() {
      if(!empty($this->mapped_data['patient_number']) ){
          $this->loadAllPatientData();
        }
    }
    
    public function loadAllPatientData(){
      $personObj = $this->ff->createContainer('person');
      $personObj->facility = array('facility', $this->getFacility($this->mapped_data['facility'], $this->mapped_data['district']));
      $personObj->patient_number = substr(trim($this->mapped_data['district']),0,2) .'-'. trim($this->mapped_data['patient_number']);
      $personObj->getField('visit_date')->setFromDB(trim($this->mapped_data['visit_date']));
      $personid = $this->save($personObj);
      $parent = 'person|'.$personid;
      
      $mHistObj = $this->ff->createContainer('medical_history');
      $mHistObj->client_sti = $this->yesNo($this->mapped_data['client_sti']);
      $mHistObj->setParent($parent);
      $this->save($mHistObj);
      
      $refObj = $this->ff->createContainer('referral_linkages');
      $refObj->art = $this->yesNo($this->mapped_data['art']);
      $refObj->cdf_count = $this->mapped_data['cdf_count'];
      //$refObj->pre_art = 
      $refObj->setParent($parent);
      $this->save($refObj);
      
      $demoObj = $this->ff->createContainer('demographic');
      $demoObj->marital_status = array('marital_status', $this->simpleListID($this->mapped_data['marital_status'],'marital_status'));
      $demoObj->setParent($parent);
      $this->save($demoObj);
      
      $pExamObj = $this->ff->createContainer('physical_exam');
      $pExamObj->genital_ulcer = $this->yesNo($this->mapped_data['genital_ulcer']);
      $pExamObj->pen_wart = $this->yesNo($this->mapped_data['pen_wart']);
      $pExamObj->scrotum_swell = $this->yesNo($this->mapped_data['scrotum_swell']);
      $pExamObj->urethra_discharge = $this->yesNo($this->mapped_data['urethra_discharge']);
      $pExamObj->setParent($parent);
      $this->save($pExamObj);

      $mcObj = $this->ff->createContainer('mc_procedure');
      $mcObj->getField('procedure_date')->setFromDB($this->mapped_data['procedure_date']);
      $mcObj->setParent($parent);
      $this->save($mcObj);

      $riskRedObj = $this->ff->createContainer('risk_reduction');
      $riskRedObj->declined_test = $this->yesNo($this->mapped_data['declined_test']);
      $riskRedObj->hiv_tested = $this->yesNo($this->mapped_data['hiv_tested']);
      //$riskRedObj->hiv_testingdate = 
      $riskRedObj->getField('hiv_testresults')->setFromDB('hiv_testresults|'.$this->simpleListID($this->mapped_data['hiv_testresults'],'hiv_testresults'));
      $riskRedObj->onsite_testing = $this->yesNo($this->mapped_data['onsite_testing']);
      $riskRedObj->setParent($parent);
      $this->save($riskRedObj);
      
      $advEvent = $this->ff->createContainer('adverse_event');
      $advEvent->adv_event = $this->yesNo($this->mapped_data['adv_event']);
      $advEvent->getField('anesthetic')->setFromDB('anesthetic|'.$this->simpleListID($this->mapped_data['anesthetic'],'anesthetic'));
      //$advEvent->hiv_testingdate = 
      $advEvent->getField('ex_bleeding')->setFromDB('ex_bleeding|'.$this->simpleListID($this->mapped_data['ex_bleeding'],'ex_bleeding'));
      $advEvent->getField('ex_skin_removed')->setFromDB('ex_skin_removed|'.$this->simpleListID($this->mapped_data['ex_skin_removed'],'ex_skin_removed'));
      $advEvent->getField('pain')->setFromDB('pain|'.$this->simpleListID($this->mapped_data['pain'],'pain'));
      $advEvent->getField('penis_damage')->setFromDB('penis_damage|'.$this->simpleListID($this->mapped_data['penis_damage'],'penis_damage'));
      $advEvent->setParent($parent);
      $this->save($advEvent);
      
      $visits = array('pr', 'de', 'tr');
      foreach($visits as $id=>$visit){
          $folObj = $this->ff->createContainer('followup_notes');
          $folObj->getField('visit_date')->setFromDB($this->mapped_data['visit_date_'.($id+1)]);
          $folObj->getField('visit')->setFromDB('visit|'.$visit);
          $folObj->setParent($parent);
          $this->save($folObj);
        }
    }
  
    public function yesNo($yesno){
      $yesno = trim($yesno);
      if(($yesno === true) || ($yesno == 1)){
        return 1;
        }
      else{
        return 0;
        }
    }
    
    public function simpleListID($simplelist, $form, $field='name'){
      if(!empty($simplelist)){
        $where = array(
            'operator'=>'FIELD_LIMIT',
            'field'=>$field,
            'style'=>'lowerequals',
            'data'=>array(
                'value'=>strtolower(trim($simplelist))
              )
          );
      $listVals = I2CE_FormStorage::search($form,false,$where);
      if(count($listVals) >= 1){
          return current($listVals);
        }
      elseif(count($listVals) < 1 ){
          if($form == 'district'){
              $formObj = $this->ff->createContainer('district');
              $formObj->name=trim($simplelist);
              $formObj->region=array('region',1);
            }
          else{
            $formObj = $this->ff->createContainer($form);
            $formObj->$field = trim($simplelist);
          }
          $formID = $this->save($formObj);
          $formObj->cleanup();
          return $formID;
        }
      }
      return 5000;
    }
    
    public function getFacility($facility, $district){
      if(!empty($facility) ){
        $where = array(
          'operator'=>'FIELD_LIMIT',
          'field'=>'name',
          'style'=>'lowerequals',
          'data'=>array(
              'value'=>strtolower(trim($facility))
            )
        );
        
        $listVals = I2CE_FormStorage::search('facility',false,$where);
      if(count($listVals) >= 1){
        return current($listVals);
        }
      elseif(count($listVals) < 1){
          $distID = $this->simpleListID($district,'district','name');
          
          $formObj = $this->ff->createContainer('facility');
          $formObj->name = trim($facility);
          $formObj->district = array('district',$distID);
          $formID = $this->save($formObj);
          $formObj->cleanup();
          return $formID;
        }
      }
      return 5000;
    }
  }




/*********************************************
*
*      Execute!
*
*********************************************/

ini_set('memory_limit','2G');

if (count($arg_files) != 1) {
    usage("Please specify the name of a spreadsheet to process");
}

reset($arg_files);
$file = current($arg_files);
if($file[0] == '/') {
    $file = realpath($file);
} else {
    $file = realpath($dir. '/' . $file);
}
if (!is_readable($file)) {
    usage("Please specify the name of a spreadsheet to import: " . $file . " is not readable");
}

I2CE::raiseMessage("Loading from $file");


$processor = new EmployeeProcessor($file);
$processor->run();

echo "Processing Statistics:\n";
print_r( $processor->getStats());




# Local Variables:
# mode: php
# c-default-style: "bsd"
# indent-tabs-mode: nil
# c-basic-offset: 4
# End: