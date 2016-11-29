<?php
//pr($faqcategories);
?>
<style>
    table tr td { text-align: left; }
</style>
<div class="faqs index">
    <h2><?php echo __('FAQ Categories'); ?></h2>
    <table style="width:100%;border:0px solid red;">
        <tr>
            <td style="width:70%;border:0px solid red;">&nbsp;</td>
        <a href="<?php echo($this->webroot);?>admin/faqs/addcategory" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New FAQ Category</a>  
        </tr>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
	<?php
        if(!empty($faqcategories)) :
            foreach ($faqcategories as $key => $category) :
        ?>
            <tr>
                <td>
                        <?php
                        echo ++$key;
                        ?>
                </td>
                <td>
                        <?php
                        echo h($category['Faqcategory']['name']);
                        ?>
                </td>
                <td>
                        <?php
                        echo h($category['Faqcategory']['desc']);
                        ?></td>
                <td>
                        <?php
                        echo ($category['Faqcategory']['status'] == 1) ? 'Active' : 'Deactive';
                        ?>
                </td>
                <td >
                        <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')),
                        array('action' => 'view', $category['Faqcategory']['id']),
                        array('class' => 'btn btn-success btn-xs', 'escape'=>false)); ?>
                            <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                        array('action' => 'editcategory', $category['Faqcategory']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>
                            <?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                        array('action' => 'deletecategory', $category['Faqcategory']['id']),
                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                        __('Are you sure you want to delete # %s?', $category['Faqcategory']['id'])); ?>
                </td>
            </tr>
        <?php
            endforeach;
        else :
        ?>
            <tr>
                <td colspan="6"><?php echo __('No faq found'); ?></td>
            </tr>
        <?php
        endif;
        ?>
        </table>
       
	
</div>
<?php //echo($this->element('admin_sidebar'));?>