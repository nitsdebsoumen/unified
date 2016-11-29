<?php
//pr($contents);
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<div class="contents index">
    <h2 style="width:400px;float:left;"><?php echo __('Suggest Category'); ?></h2>
<!--	<a href="<?php echo $this->webroot.'admin/cms_page/add'; ?>" style="float:right">Content Add</a>-->
    <table cellpadding="0" cellspacing="0"  id="sortable">
        <thead>
            <tr>
                <th>
                    <?php echo $this->Paginator->sort('id'); ?>
                </th>
                <th>
                    <?php echo $this->Paginator->sort('category_name'); ?>
                </th>
                <th >
                    <?php echo $this->Paginator->sort('category_description'); ?>
                </th>
            
                
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($contents as $key => $content) :
            ?>
            <tr data-id="<?php echo $content['SuggestCategory']['id']; ?>">
                <td>
                    <?php echo ++$key; ?>&nbsp;
                </td>
                <td>
                    <?php echo h($content['SuggestCategory']['category_name']);?>
                </td>
                <td>
                    <?php echo substr(strip_tags($content['SuggestCategory']['category_description']), 0, 200).'...';?>
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

