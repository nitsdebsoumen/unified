<style>
    select {
    font-size: 100%;
    vertical-align: middle;
    }
</style>
<script>
    $(document).ready(function () {
        $("#BlogAdminEditForm").validationEngine();
    });
</script>

<div class="blogs form">
<?php echo $this->Form->create('Adminrolemeta',array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Set Privilege'); ?></legend>
        <label><?php echo $adminrole['Adminrole']['name']; ?></label>
        
        <div class="add_previlege row">
            <?php
            foreach($adminrolemeta as $k => $v){
                if($v['Adminrolemeta']['meta_value'] != 0) {
            ?>
            <div class="form-group">
                <select name="data[Adminrolemeta][meta_key][]">
                    <option value="">Select Privilege</option>
                    <option value="manage_logo" <?php echo ($v['Adminrolemeta']['meta_key'] == 'manage_logo') ? 'selected' : ''; ?>>Manage Logo</option>
                    <option value="manage_settings" <?php echo ($v['Adminrolemeta']['meta_key'] == 'manage_settings') ? 'selected' : ''; ?>>Manage Settings</option>
                    <option value="admin_roles" <?php echo ($v['Adminrolemeta']['meta_key'] == 'admin_roles') ? 'selected' : ''; ?>>Admin Roles</option>
                    <option value="contents" <?php echo ($v['Adminrolemeta']['meta_key'] == 'contents') ? 'selected' : ''; ?>>Contents</option>
                    <option value="faq" <?php echo ($v['Adminrolemeta']['meta_key'] == 'faq') ? 'selected' : ''; ?>>FAQ</option>
                    
                    <option value="banner" <?php echo ($v['Adminrolemeta']['meta_key'] == 'Banner') ? 'selected' : ''; ?>>Admin Roles</option>
                    <option value="home_slider" <?php echo ($v['Adminrolemeta']['meta_key'] == 'home_slider') ? 'selected' : ''; ?>>Home_Slider</option>
                    <option value="footer" <?php echo ($v['Adminrolemeta']['meta_key'] == 'footer') ? 'selected' : ''; ?>>Footer</option>
                    <option value="email_templates" <?php echo ($v['Adminrolemeta']['meta_key'] == 'email_templates') ? 'selected' : ''; ?>>Email Templates</option>  
                    <option value="users" <?php echo ($v['Adminrolemeta']['meta_key'] == 'users') ? 'selected' : ''; ?>>Users</option>  
                    <option value="categories" <?php echo ($v['Adminrolemeta']['meta_key'] == 'categories') ? 'selected' : ''; ?>>Categories</option> 
                    <option value="membership_plan" <?php echo ($v['Adminrolemeta']['meta_key'] == 'membership_plan') ? 'selected' : ''; ?>>Membership Plan</option> 
                    <option value="contact_us" <?php echo ($v['Adminrolemeta']['meta_key'] == 'contact_us') ? 'selected' : ''; ?>>Contact Us</option> 
                    <option value="seo_keywords_management" <?php echo ($v['Adminrolemeta']['meta_key'] == 'seo_keywords_management') ? 'selected' : ''; ?>>SEO Keywords Management</option> 
                    <option value="language_management" <?php echo ($v['Adminrolemeta']['meta_key'] == 'language_management') ? 'selected' : ''; ?>>Language Management</option> 
                    <option value="sitemaps" <?php echo ($v['Adminrolemeta']['meta_key'] == 'sitemaps') ? 'selected' : ''; ?>>Sitemaps</option>  
                    <option value="analytics" <?php echo ($v['Adminrolemeta']['meta_key'] == 'analytics') ? 'selected' : ''; ?>>Analytics</option>            


                </select>
                <button class="remove btn btn-danger" type="button">Remove</button>
            </div>
            <?php
                }
            }
            ?>
        </div>
        <div class="form-group">
            <button class="add_more btn btn-info" type="button">Add More</button>
        </div>
                
	<?php
        //echo $this->Form->input('id');
        //echo $this->Form->input('roleid');
	?>

    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<script>
    (function($){
        $('.add_more').click(function(){
            var html = '<div class="form-group">'+
                '<select name="data[Adminrolemeta][meta_key][]">'+
                    '<option value="">Select Privilege</option>'+
                    '<option value="manage_logo">Manage Logo</option>'+
                    '<option value="manage_settings">Manage Settings</option>'+
                    '<option selected="" value="admin_roles">Admin Roles</option>'+
                    '<option value="contents">Contents</option>'+
                    '<option value="faq">FAQ</option>'+
                    '<option value="banner">Admin Roles</option>'+
                    '<option value="home_slider">Home_Slider</option>'+
                    '<option value="footer">Footer</option>'+
                    '<option value="email_templates">Email Templates</option>'+
                    '<option value="users">Users</option>'+
                    '<option value="categories">Categories</option>'+
                    '<option value="membership_plan">Membership Plan</option>'+
                    '<option value="contact_us">Contact Us</option>'+
                    '<option value="seo_keywords_management">SEO Keywords Management</option>'+
                    '<option value="language_management">Language Management</option>'+
                    '<option value="sitemaps">Sitemaps</option>'+
                    '<option value="analytics">Analytics</option>'+
                '</select>'+
                '<button class="remove btn btn-danger">Remove</button>'+
            '</div>';
            
            $('.add_previlege').append(html);
        });
        
        $(document).on('change', 'select[name="data[Adminrolemeta][meta_key][]"]', function(){
            var change_val = $(this);
            $('select[name="data[Adminrolemeta][meta_key][]"]').not(this).each(function(){
                if($(this).val() == change_val.val()) {
                    alert('Already Exists!');
                    $(change_val).prop('selectedIndex',0);
                }
            });
        });
        
        $(document).on('click', '.remove',function(){
            $(this).closest('.form-group').remove();
        });
    })(jQuery);
</script>
