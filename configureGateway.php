<?php
/*
*IoT LoRa Gateway Controller
*Copyright (C) 2018-2019  Nebra LTD. T/a Pi Supply

*This program is free software: you can redistribute it and/or modify
*it under the terms of the GNU General Public License as published by
*the Free Software Foundation, either version 3 of the License, or
*(at your option) any later version.
*
*This program is distributed in the hope that it will be useful,
*but WITHOUT ANY WARRANTY; without even the implied warranty of
*MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*GNU General Public License for more details.
*
*You should have received a copy of the GNU General Public License
*along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/


include('inc/header.php');

$configHandler = fopen($configLocation, 'r');
$currentConfig = fread($configHandler, filesize($configLocation));

$jsonDecoded = json_decode($currentConfig,true)['gateway_conf'];
$jsonServers = $jsonDecoded['servers'][0];
?>

<div class="row align-items-center">
   <div class="text-center">
     <h1>IoT LoRa Gateway Configuration Tool</h1>
   </div>
</div>
<div class="row align-items-center">
   <div class="text-center">
     <p>This page modifies the packet forwarder configuration. After updating the configuration you will have to go to the system control's page to reload the software.</p>
   </div>
</div>
<br>
<div class="row">
  <div class="coullumn">
     <h1 class="ui top attached block header">Edit config file</h1>
     <form action="updateConf.php" method="post" class="ui form">
         <div class="ui bottom attached segment">
      <div class="field">
       <label for="emailAddr">Contact Email Address:</label> Contact email address in case of any issues.
       <input type="email" id="email" name="email" class="form-control" required <?php if($jsonDecoded['contact_email']!=null) { echo "value='".$jsonDecoded['contact_email']."'"; }?>/>
       </div>
      <div class="field">
       <label for="emailAddr"  >Gateway ID:</label> This is the same as the Gateway ID from the TTN Console.
       <input type="text" id="gatewayId" name="gatewayId" class="form-control" required <?php if($jsonServers['serv_gw_id']!=null) { echo "value='".$jsonServers['serv_gw_id']."'"; }?>/>
       </div>
      <div class="field">
       <label for="emailAddr"  >TTN Gateway Key:</label> This is the Gateway Key from the TTN Console
       <input type="text" id="ttnKey"name="ttnKey" class="form-control" required minlength=101 <?php if($jsonServers['serv_gw_key']!=null) { echo "value='".$jsonServers['serv_gw_key']."'"; }?>/>
       </div>
       <div class="field">
        <h3>Missing Fields?</h3>
        <p>Location, TTN Region, Server and more are all got by your gateway from the TTN Console. Use the TTN Console to setup these settings.</p>
        <p>Then reboot the packet forwarder from the controls page to update the settings</p>
          </div>


      <br/>
      <input type="submit" class="ui primary button" value="Update Configuration">
      </div>
     </form>
   </div>
  </div>
</div>
<?php
include('inc/footer.php');
?>
