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


$dir = getcwd();
chdir("../pages");
$i2ce_site_user_access_init = null;
$wd = getcwd();
require_once( $wd . DIRECTORY_SEPARATOR . 'config.values.php');

$local_config = $wd . DIRECTORY_SEPARATOR .'local' . DIRECTORY_SEPARATOR . 'config.values.php';
if (file_exists($local_config)) {
    require_once($local_config);
}

if(!isset($i2ce_site_i2ce_path) || !is_dir($i2ce_site_i2ce_path)) {
    echo "Please set the \$i2ce_site_i2ce_path in $local_config";
    exit(55);
}

require_once ($i2ce_site_i2ce_path . DIRECTORY_SEPARATOR . 'I2CE_config.inc.php');
@I2CE::initializeDSN($i2ce_site_dsn,   $i2ce_site_user_access_init,    $i2ce_site_module_config);         

require_once $i2ce_site_i2ce_path . DIRECTORY_SEPARATOR . 'tools' . DIRECTORY_SEPARATOR . 'CLI.php';

$ff = I2CE_FormFactory::instance();
$user = new I2CE_User();

$allParents = I2CE_FormStorage::listFields('followup_notes',array('parent'));
$uniqueParent = array();

foreach($allParents as $key=>$data){
    if(!in_array($data['parent'], $uniqueParent)){
        $uniqueParent[] = $data['parent'];
      }
  }

$i=1;
foreach( $uniqueParent as $id=> $parent){
    //I2CE::raiseError("Current person is $parent");
    $whereParentf = array(
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
                        'value'=>$parent
                        )
                    )
                )
            );
    $whereParent = array(
            'operator'=>'AND',
            'operand'=>array(
                0=>array(
                    'operator'=>'FIELD_LIMIT',
                    'field'=>'visit',
                    'style'=>'equals',
                    'data'=>array(
                        'value'=>'visit|tr'
                        )
                    ),
                1=>array(
                    'operator'=>'FIELD_LIMIT',
                    'field'=>'parent',
                    'style'=>'equals',
                    'data'=>array(
                        'value'=>$parent
                        )
                    )
                )
            );

    $personsf = I2CE_FormStorage::search('followup_notes', false, $whereParentf);
    
    $persons = I2CE_FormStorage::search('followup_notes', false, $whereParent);
        
    $mstatus = array('m','s');

    $intvl = array(21,22,34,41,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40);
    
        echo "$i\n";
        $pObjf = $ff->createContainer('followup_notes|'.current($personsf));
        $pObj = $ff->createContainer('followup_notes|'.current($persons));
        $pObj->populate();
        $pObjf->populate();
        $date1 = randomDate('2012-02-01', '2012-09-15');
        
        if( $pObj->visit == array('visit','pr') ){
          echo "First visit ".$date1."\n";
          $pObj->getField('visit_date')->setFromDB($date1);
        }
        
        if( $pObj->visit == array('visit','de') ){
          $dbDate = $pObjf->getField('visit_date')->getDBValue();
          $fdObj = new DateTime( $dbDate);
          $fdObj->add(new DateInterval('P'.$intvl[rand(0,19)].'D'));
          echo "Second visit ".$fdObj->format('Y-m-d H:i:s') ."\n";
          $pObj->getField('visit_date')->setFromDB($fdObj->format('Y-m-d H:i:s') );
        }
        
        if( $pObj->visit == array('visit','tr') ){
          $dbDate = $pObjf->getField('visit_date')->getDBValue();
          $fdObj = new DateTime( $dbDate);
          $fdObj->add(new DateInterval('P'.$intvl[rand(0,19)].'D'));
          $pObj->getField('visit_date')->setFromDB($fdObj->format('Y-m-d H:i:s') );          
          echo "Third visit ".$fdObj->format('Y-m-d H:i:s') ."\n";
          $pObj->getField('visit_date')->setFromDB($fdObj->format('Y-m-d H:i:s') );
        }
        
        $pObj->getField('anesthetic')->setFromDB('anesthetic|'.$mstatus[rand(0,1)]);
        $pObj->getField('appearance')->setFromDB('appearance|'.$mstatus[rand(0,1)]);
        $pObj->getField('erectile_dysfunction')->setFromDB('erectile_dysfunction|'.$mstatus[rand(0,1)]);
        $pObj->getField('ex_bleeding')->setFromDB('ex_bleeding|'.$mstatus[rand(0,1)]);
        $pObj->getField('ex_skin_removed')->setFromDB('ex_skin_removed|'.$mstatus[rand(0,1)]);
        $pObj->getField('infection')->setFromDB('infection|'.$mstatus[rand(0,1)]);
        $pObj->getField('ins_skin_removed')->setFromDB('ins_skin_removed|'.$mstatus[rand(0,1)]);
        $pObj->getField('pain')->setFromDB('pain|'.$mstatus[rand(0,1)]);
        $pObj->getField('penis_damage')->setFromDB('penis_damage|'.$mstatus[rand(0,1)]);
        $pObj->getField('psycho_behavior')->setFromDB('psycho_behavior|'.$mstatus[rand(0,1)]);
        $pObj->getField('skin_torsion')->setFromDB('skin_torsion|'.$mstatus[rand(0,1)]);
        $pObj->getField('swelling')->setFromDB('swelling|'.$mstatus[rand(0,1)]);
        $pObj->getField('urinate_problem')->setFromDB('urinate_problem|'.$mstatus[rand(0,1)]);
        $pObj->getField('wound_delay')->setFromDB('wound_delay|'.$mstatus[rand(0,1)]);
        $pObj->save($user);
        $pObj->cleanup();
        $i++;
    
  }
  
  
$where2 =  array(
        'operator'=>'FIELD_LIMIT',
        'field'=>'reference',
        'style'=>'null'
      );
function randomDate($start_date, $end_date)
{
    // Convert to timetamps
    $min = strtotime($start_date);
    $max = strtotime($end_date);

    // Generate random number using above bounds
    $val = rand($min, $max);

    // Convert back to desired date format
    return date('Y-m-d H:i:s', $val);
}

