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


function getFacilities(){
  $facilityList = array();
  $facilities = I2CE_FormStorage::listFields('facility',array('id','name'));
  foreach($facilities as $id=>$data){
      $facilityList['facility|'.$id] = substr(preg_replace("/\s+/","",$data['name']), 0, 3);
    }
  return $facilityList;
}

//$facList = array();
$facList = getFacilities();
print_r($facList);
foreach( $facList as $facId => $name){
  $where = array(
    'operator'=>'FIELD_LIMIT',
    'field'=>'facility',
    'style'=>'equals',
    'data'=>array(
        'value'=>$facId
    )
  );
  $clients = I2CE_FormStorage::search('person',false,$where);
  $i=1;
  foreach($clients as $key=>$id){
      $patientNum = $name.'-'.$i;
      echo "Setting patient number = $patientNum\n";
      echo "Facility is facility $facId\n";
      $demoObj = $ff->createContainer('person|'.$id);
      $demoObj->populate();
      $demoObj->getField('patient_number')->setValue($patientNum);
      //$demoObj->save($user);
      //$demoObj->cleanup();
      $i++;
  }
}
