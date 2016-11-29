<style>
    table tr td { text-align: left; }
</style>
<div class="skills index">
    <h2><?php echo __('SKILLS'); ?></h2>
    <table style="width:100%;border:0px solid red;">
         
        <table cellpadding="0" cellspacing="0">

            <tr>
                <td colspan="5">
                    <a href="<?php echo($this->webroot);?>admin/skills/add" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New Skill</a>
                </td>  
            </tr>
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('title'); ?></th>
                <th><?php echo $this->Paginator->sort('description'); ?></th>
                <th><?php echo $this->Paginator->sort('status'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
	<?php
        if(!empty($skills)) :
            foreach ($skills as $key => $skill) :
        ?>
                <tr>
                    <td>
                        <?php
                        echo ++$key;
                        ?>
                    </td>
                    <td>
                        <?php
                        echo h($skill['Skill']['skill_name']);
                        ?>
                    </td>
                    <td>
                        <?php
                        echo h(strip_tags($skill['Skill']['skill_desc']));
                        ?></td>
                    <td>
                        <?php
                        echo ($skill['Skill']['status'] == 1) ? 'Active' : 'Deactive';
                        ?>
                    </td>
                    <td >
                        <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                        array('action' => 'edit', $skill['Skill']['id']),
                        array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>
                        <?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                        array('action' => 'delete', $skill['Skill']['id']),
                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                        __('Are you sure you want to delete # %s?', $skill['Skill']['skill_name'])); ?>
                    </td>
                </tr>
        <?php
            endforeach;
        else :
        ?>
            <tr>
                <td colspan="6"><?php echo __('No skills found'); ?></td>
            </tr>
        <?php
        endif;
        ?>
        </table>
        <p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
        <div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
        </div>
</div>
<?php //echo($this->element('admin_sidebar'));?>