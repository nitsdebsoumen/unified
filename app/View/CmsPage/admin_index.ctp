<?php
//pr($contents);
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<div class="contents index">
    <h2 style="width:400px;float:left;"><?php echo __('Contents'); ?></h2>
<!--	<a href="<?php echo $this->webroot.'admin/cms_page/add'; ?>" style="float:right">Content Add</a>-->
    <table cellpadding="0" cellspacing="0"  id="sortable">
        <thead>
            <tr>
                <th>
                    <?php echo $this->Paginator->sort('id'); ?>
                </th>
                <th>
                    <?php echo $this->Paginator->sort('page_name'); ?>
                </th>
                <th width="45%">
                    <?php echo $this->Paginator->sort('page_heading'); ?>
                </th>
                <th>
                    <?php echo __('Show In Header'); ?>
                </th>
                <th>
                    <?php echo __('Show In Footer'); ?>
                </th>
                <th>
                    <?php echo __('Actions'); ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($contents as $key => $content) :
            ?>
            <tr data-id="<?php echo $content['CmsPage']['id']; ?>">
                <td>
                    <?php echo ++$key; ?>&nbsp;
                </td>
                <td>
                    <?php echo h($content['CmsPage']['page_title']);?>
                </td>
                <td>
                    <?php echo substr(strip_tags($content['CmsPage']['page_description']), 0, 200).'...';?>
                </td>
                <td>
                    <?php echo ($content['CmsPage']['show_in_header'] == '1') ? 'True': 'False'; ?>
                </td>
                <td>
                    <?php echo ($content['CmsPage']['page_title'] == '1') ? 'True': 'False'; ?>
                </td>
                <td>
                    <?php
                    echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus')),
                    array('action' => 'add', $content['CmsPage']['id']),
                    array('class' => 'btn btn-info btn-xs', 'escape'=>false));
                    ?>
                    <?php
                    echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')),
                    array('action' => 'edit', $content['CmsPage']['id']),
                    array('class' => 'btn btn-info btn-xs', 'escape'=>false));
                    ?>
                    <?php
                    echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                    array('action' => 'delete', $content['CmsPage']['id']),
                    array('class' => 'btn btn-danger btn-xs', 'escape'=>false));
                    ?>
                </td>
            </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
    <p><?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?></p>
    <div class="paging">
	<?php
            echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
            echo $this->Paginator->numbers(array('separator' => ''));
            echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
    </div>
</div>

<script>
(function($) {
    var fixHelper = function(e, ui) {
        ui.children().each(function() {
            $(this).width($(this).width());
        });
        return ui;
    };

    $("#sortable tbody").sortable({
        update: function(event, ui) {  
            var sort_order = [];
            $('#sortable tbody tr').each(function() {
                $(this).children('td:first-child').html($(this).index() + 1);
                //$(this).attr('data-order', $(this).index() + 1);
                sort_order.push($(this).attr('data-id'));
            });
            
            $.ajax({
                url: '<?php echo $this->webroot; ?>admin/cms_page/ajaxorder',
                type: 'post',
                //dataType: 'json',
                data: {
                    sort_order: sort_order
                },
                success: function(data) {
                    //console.log(data);
                }
            });
        },
        helper: fixHelper
    }).disableSelection();
    
})(jQuery);
</script>