<style>
    table tr td { text-align: left; }
</style>
<div class="privacies index">
    <h2><?php echo __('Newsletter'); ?></h2>
    <a  id="reply"class="btn btn-info pull-right"><i class="fa fa-plus"></i> Reply Newsletter</a>
    <table style="width:100%;border:0px solid red;">
        <tbody>
            <tr>
                <td style="width:70%;border:0px solid red;">&nbsp;</td>
            </tr>
        </tbody>
    </table>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th width="12%"><input type="checkbox" id="sel_all" value="1"/>Select All</th>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('email'); ?></th>
            <th class="actions"><?php echo __('Actions');?></th>
        </tr>
	<?php foreach ($newsletters as $value): ?>
        <tr>
            <td>
                <input type="checkbox" class="check" name="email[]" value="<?php echo ($value['Newsletter']['email']); ?>">
            </td>
            <td>
                <?php echo h($value['Newsletter']['id']); ?>
            </td>
            <td>
                <?php echo h($value['Newsletter']['email']); ?>
            </td>
            <td>
                <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                array('action' => 'edit', $value['Newsletter']['id']),
                array('class' => 'btn btn-info btn-xs', 'escape'=>false)); ?>
                <?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                array('action' => 'delete', $value['Newsletter']['id']),
                array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                __('Are you sure you want to delete # %s?', $value['Newsletter']['id'])); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="contact_modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Reply</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo $this->webroot . 'admin/newsletters/index'; ?>" method="post">
                    <div class="form-group">
                        <input type="text" name="to" value="" required="" />
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" value="" required="" />
                    </div>
                    <div class="form-group">
                        <textarea name="message" rows="6" required=""></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit" name="reply">Reply</button>
                    </div>

                </form>
            </div>
            <!--<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>-->
        </div>

    </div>
</div>
<script>
    (function ($) {
        var total_check = $("input[name='email[]']").length;
        
        $('#sel_all').click(function(){
            if($(this).is(':checked')) {
                $('input[name="email[]"]').prop('checked', true);
            } else {
                $('input[name="email[]"]').prop('checked', false);
            }
            
        });
        
        $("input[name='email[]']").click(function(){
            var check_count = $("input[name='email[]']:checked").length;
            if(check_count == total_check) {
                $('#sel_all').prop('checked', true);
            } else {
                $('#sel_all').prop('checked', false);
            }
        });
        
        $('#reply').click(function () {
            var emails = [];
            $("input[name='email[]']:checked").each(function () {
                emails.push($(this).val());
            });
            $('#contact_modal input[name="to"]').val(emails);
            $('#contact_modal input[name="subject"]').val('Newsletter');
            $('#contact_modal').modal('show');
        });
        
        
    })(jQuery);
</script>



