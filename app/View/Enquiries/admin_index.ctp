<?php pr($enquiries);?>
<div class="categories index">
	<h2><?php echo __('Enquiries'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('Post Title'); ?></th>
			<th><?php echo $this->Paginator->sort('subject'); ?></th>
			<th><?php echo $this->Paginator->sort('Email'); ?></th>
			<th><?php echo $this->Paginator->sort('User Name'); ?></th>
			<th><?php echo $this->Paginator->sort('Query'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
			
	</tr>
	<?php foreach ($enquiries as $content): ?>
	<tr>
		<td><?php echo h($content['Enquiry']['id']); ?>&nbsp;</td>
		<td><?php echo h($content['Post']['post_title']);?></td>
		<td><?php echo h($content['Enquiry']['subject']);?></td>
		<td><?php echo h($content['Enquiry']['email']);?></td>
		<td><?php echo h($content['Enquiry']['user_name']);?></td>
		<td><?php echo h($content['Enquiry']['query']);?></td>
		<td><button type="button" class="btn btn-default reply_enquiry" data-id="<?php echo $content['Enquiry']['id']; ?>" data-toggle="modal" data-target="#myModal">Reply</button>
			<?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                        array('action' => 'delete', $content['Enquiry']['id']),
                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                        __('Are you sure you want to delete # %s?', $content['Enquiry']['id'])); ?>
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
          <h4 class="modal-title">Write Your Reply Mail</h4>
        </div>
        		<div class="right_bar">
                    <form class="form-horizontal" id="reply_form">
                        
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text">Reply Mail:</label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control border" id="reply" name="data[reply]" value="" required="required" placeholder="Write Your Mail" ></textarea>
                            </div>
                           <input type="hidden" id="quote" name="data[quote_id]" value=""> 
                        </div>
                        
                    </form>
                    <button type="button" class="btn btn-default" style="display: table;
                            margin: 0 auto;" id="submit">Submit</button>
                 
                </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<script>
		$('.reply_enquiry').click(function(){
            var qid = $(this).data('id');
           $("#quote").val(qid);
           
	     });
		$('#submit').click(function(){
           $.ajax({
	                url: "<?php echo $this->webroot;?>enquiries/ajaxAdminMail",
	                type:'POST',
	                dataType:'json',
	                data:$("#reply_form").serialize(),
	                success: function(result){
	                    if(result.ack==1){
	                    	$("#myModal").modal('hide');
	                    	alert('Reply Male Has Been Send');
	                    }
	               }
	        }); 
	     });

</script>