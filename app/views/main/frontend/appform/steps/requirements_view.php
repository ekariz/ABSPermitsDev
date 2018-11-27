
<div class="col-md-12 form-group">
    <label for="resourcetype">Type of Genetic Resource,Genetic Information or Traditional Knowledge to be collected  *</label>
    <?php echo form_dropdown('resourcetype', $resource_list, $resourcetype ,'id="resourcetype" class="form-control  input-sm"  required="required" onchange="show_other_resource_type();" ');  ?>
    <div class="help-block with-errors"></div>
</div>

<div id="div_resourcetypeother" class="col-md-12 form-group" style="display:none">
    <label for="resourcetypeother">Describe other resource type *:</label>
    <input type="text" class="form-control input-sm" id="resourcetypeother" name="resourcetypeother"  value="<?php echo $resourcetypeother; ?>" placeholder="" data-toggle="tooltip" data-placement="top" title="Type of genetic resource to be collected ">
    <div class="help-block with-errors"></div>
</div>

<div class="col-md-12 form-group">
    <label for="speciesname">Species name of the Genetic Resource,Genetic Information or Traditional Knowledge to be collected  *:</label>
    <input type="text" class="form-control input-sm" id="speciesname" name="speciesname"  value="<?php echo $speciesname; ?>" placeholder="" required data-toggle="tooltip" data-placement="top" title="Species name of the genetic resource to be collected">
    <div class="help-block with-errors"></div>
</div>


<div class="col-md-12 form-group">
    <label for="commonname">Common/vernacular name of the Genetic Resource,Genetic Information or Traditional Knowledge to be collected *:</label>
    <input type="text" class="form-control input-sm" id="commonname" name="commonname"  value="<?php echo $commonname; ?>" placeholder="" required data-toggle="tooltip" data-placement="top" title="Common name of the generic resource to be collected">
    <div class="help-block with-errors"></div>
</div>


<div class="col-md-12 form-group">
    <label for="projectarea">Is the project area inside a conservation area, gazetted forest or protected area? *:</label>
    <?php echo form_dropdown('projectarea', $yesno_list, $projectarea ,'id="projectarea" class="form-control  input-sm"  required="required"  ');  ?>
    <div class="help-block with-errors"></div>
</div>

<!--
<div class="col-md-12 form-group">
    <label for="resourceallocationpurpose">Purpose of genetic resource collection *:</label>
    <input type="text" class="form-control input-sm" id="resourceallocationpurpose" name="resourceallocationpurpose"  value="<?php echo $resourceallocationpurpose; ?>" placeholder="" required data-toggle="tooltip" data-placement="top" title="Purpose of genetic resource allocation">
    <div class="help-block with-errors"></div>
</div>
-->

<fieldset>
<legend> Purpose of collection (Check all that apply) </legend>
 <?php
  if($purposes_list){
   if(sizeof($purposes_list)>0){
     foreach($purposes_list as $pupcode=>$pupname){
        $input_id = "purpose[{$pupcode}]";
        $checked  =  isset($purpose[$pupcode]) && $purpose[$pupcode]==$pupcode ? 'checked' :'';

echo <<<ROW
<div class="  col-md-5 ">
<label>
    <input  type="checkbox"  id="{$input_id}" name="{$input_id}" value="{$pupcode}" class="form-control-checkbox" {$checked} >
    {$pupname}
</label>
</div>
ROW;

     }
   }
  }
 ?>

<div class="col-md-12 form-group">
   &nbsp;
</div>

<div class="col-md-12 form-group">
    <label for="purposeother">Specify If 'Other' Purpose of genetic resource collection *:</label>
</div>

<div class="col-md-12 form-group">
    <input type="text" class="form-control input-sm" id="purposeother" name="purposeother"  value="<?php echo $purposeother; ?>" placeholder="Specify..." data-toggle="tooltip" data-placement="top" title="Specify If 'Other' Purpose of genetic resource collection">
    <div class="help-block with-errors"></div>
</div>

</fieldset>
