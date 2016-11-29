<style>
    table tr td {
        text-align: left;
    }
</style>

<div class="faqs index">
    <h2><?php echo __('Quotes'); ?></h2>
    <table style="width:100%;border:0px solid red;">

        <table cellpadding="0" cellspacing="0">

            <tr>
                <td style="width:10%;border:0px solid red;">&nbsp;</td>
            <a href="<?php echo($this->webroot); ?>admin/request_quotes/add" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New Quotes</a>  
            </tr>
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('quotes'); ?></th>
                <th><?php echo $this->Paginator->sort('user_id'); ?></th>
                <th><?php echo $this->Paginator->sort('post_id'); ?></th>
                <th><?php echo $this->Paginator->sort('status'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>

            <?php
            if (!empty($RequestQuotes)) :
                foreach ($RequestQuotes as $key => $RequestQuote) :
                    if($RequestQuote['Post']['user_id']==$this->Session->read('userid')){
                    ?>
                    <tr>
                        
                        <td>
                            <?php
                            echo ++$key;
                            ?>
                        </td>
                        
                        <td>
                           <!--  <img src="<?php echo $this->webroot; ?>/kycdoc/<?php echo $kycdocs['Kycdoc']['doc']; ?>" style="height:80px;" > -->
                        </td>    
                        
                        <td>
                        <?php echo $this->Html->link($RequestQuote['User']['first_name'].' '.$RequestQuote['User']['last_name'], array('controller' => 'users', 'action' => 'view', $RequestQuote['User']['id'])); ?>
                        </td>
                         <td>
                            <?php
                            echo h(strip_tags($RequestQuote['Post']['post_title']));
                            ?>
                        </td>
                                       
                        
                        <td><?php if($RequestQuote['RequestQuote']['status']==1){ ?> <img src="<?php echo $this->webroot; ?>/img/success-01-128.png" style="height:30px;" /><?php }else{ ?><img src="<?php echo $this->webroot; ?>/img/cross-512.png" style="height:30px;" /><?php } ?>&nbsp;
                        </td>

                        <td >
                             <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')),
                        array('action' => 'view', $RequestQuote['RequestQuote']['id']),
                        array('class' => 'btn btn-success btn-xs', 'escape'=>false)); ?>
                        <?php
                        echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')), array("controller" => "RequestQuotes",'action' =>'edit', $RequestQuote['RequestQuote']['id']), array('class' => 'btn btn-info btn-xs', 'escape' => false));
                        ?>
                        <?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                        array('action' => 'delete', $RequestQuote['RequestQuote']['id']),
                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                        __('Are you sure you want to delete # %s?', $RequestQuote['RequestQuote']['id'])); ?>
                        </td>

                  
                    </tr>
                    <?php }
                endforeach;
            else :
                ?>
                <tr>
                    <td colspan="6"><?php echo __('No Quotes found'); ?></td>
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
<?php
//echo($this->element('admin_sidebar'));?>