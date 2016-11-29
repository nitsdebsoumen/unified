<style>
#content {
    overflow: inherit;
}
</style>
<?php //pr($users);?>
<div class="venue form">
<?php echo $this->Form->create('Venue',array('enctype'=>'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Add Venue'); ?></legend>
	<?php
    if(!empty($user_company) && $user_company['Company']['id']=='')
        { ?>
            <label>Company Name</label>
            <select name="data[Venue][user_id]" id="VenueUserId">
                <option value="<?php echo $user_company['User']['id']?>"><?php echo $user_company['User']['first_name'].' '.$user_company['User']['last_name'].'[No Company Details]';?></option>
                
            </select>    
        <?php }
        elseif($user_company!='')
        { ?>
            <label>Company Name</label>
            <select name="data[Venue][user_id]" id="VenueUserId">
                <option value="<?php echo $user_company['Company']['user_id']?>"><?php echo $user_company['Company']['company_name']?></option>
                
            </select>    
        <?php }
        else
        { ?>
        <label>Company Name</label>
            <select name="data[Venue][user_id]" id="VenueUserId">
                <?php foreach ($users as $key => $value) { ?>
                <option value="<?php echo $value['User']['id'];?>"><?php if($value['Company']['id']!=''){echo $value['Company']['company_name'];}else{ echo $value['User']['first_name'].' '.$value['User']['last_name'].'[No Company Details]'; } ?></option>
                <?php } ?>
            </select> 
        <?php }
        //echo $this->Form->input('post_id');
        echo $this->Form->input('venue_name');
        echo $this->Form->input('description');
        echo $this->Form->input('size');
        echo $this->Form->input('address');
        echo $this->Form->input('Event', array(
                                'label' => 'Events',
                                'type' => 'select',
                                'multiple' => 'checkbox',
                                'options' => $events
                                    )
                            );
        echo $this->Form->input('Facility', array(
                                'label' => 'Facility',
                                'type' => 'select',
                                'multiple' => 'checkbox',
                                'options' => $facilities
                                    )
                            );
        $policy=array('1'=>'Per hour','2'=>'Per day');
        echo $this->Form->input('policy_type',array(
                                        'empty' => '(Select policy type)',
                                        'label' => 'Policy Type',
                                        'options'=>$policy,
                                        'div' => FALSE,
                                    )
                                );

        echo $this->Form->input('price');
        echo $this->Form->input('sort_of_details'); ?>
        <div class="form-group profile-field">
                        <label for="" class="col-sm-3 right-text">Image:</label>
                        <div class="col-sm-9">
                             <input type="hidden"name="data[Venue][user_id]" value="" id="user_id" >
                             <div id="container"></div>
                             <div id="propertylistingmoreimage"></div>
                            <button id="somebutton" type="button">Add Image</button>
                        </div>
        <?php echo $this->Form->input('featured');
	?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
<script>
var c = 1;
$("#somebutton").click(function () {

    if(c<13){
        $("#propertylistingmoreimage").append('<input type="file" name="data[Venue][image][]" >');
    }
  c = c+1;
});
$(document).ready(function(){
    var uid = $("#VenueUserId").val();
    $("#user_id").val(uid);
});
$("#VenueUserId").change(function () {
    var uid = $(this).val();
    $("#user_id").val(uid);
});
</script>