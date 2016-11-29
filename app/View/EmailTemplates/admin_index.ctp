<div class="categories index">
	<h2><?php echo __('Email Template'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('subject'); ?></th>
			<th><?php echo $this->Paginator->sort('Preview'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($emailtemplate as $content): ?>
	<tr>
		<td><?php echo h($content['EmailTemplate']['id']); ?>&nbsp;</td>
		<td><?php echo h($content['EmailTemplate']['subject']);?></td>
		<td><?php //echo ($content['EmailTemplate']['content']);?><button class="btn btn-info btn-lg email_template" data-id="<?php echo $content['EmailTemplate']['id']; ?>" data-toggle="modal"  >Preview</button> </td>
		<td class="actions">
			
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $content['EmailTemplate']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
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
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Email Template</h4>
        </div>
        <div class="modal-body" id="modal_body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<?php //echo $this->element('admin_sidebar'); ?>
<script>
$(document).ready(function(){
    $(".email_template").click(function(){
        var id = $(this).data('id');
        $.ajax({
        	url: "<?php echo $this->webroot;?>email_templates/ajaxEmailTemplate",
        	method:'post',
        	dataType:'json',
        	data:{email_id:id},
        	 success: function(result){
        		console.log(result);
        		if(result.Ack==1)
        		{
        			$("#modal_body").html('');
        			$("#modal_body").html(result.html);
        			$('#myModal').modal('show');
        		}
    		}
		});
    });
});
</script>