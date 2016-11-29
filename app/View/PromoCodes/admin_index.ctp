<style>
    table tr td {
        text-align: left;
    }
</style>

<div class="faqs index">
    <h2><?php echo __('Promo Codes'); ?></h2>
    <table style="width:100%;border:0px solid red;">

        <table cellpadding="0" cellspacing="0">

            <tr>
                <td style="width:10%;border:0px solid red;">&nbsp;</td>
            <a href="<?php echo($this->webroot); ?>admin/promo_codes/add" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New Promo Code</a>  
            </tr>
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('promo_title'); ?></th>
                <th><?php echo $this->Paginator->sort('code'); ?></th>
                <th><?php echo $this->Paginator->sort('no_of_use'); ?></th>
                <th><?php echo $this->Paginator->sort('discount'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>

            <?php
            if (!empty($promocodes)) :
                foreach ($promocodes as $key => $promocode) :
                    ?>
                    <tr>
                        <td>
                            <?php
                            echo ++$key;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $promocode['PromoCode']['promo_title'];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $promocode['PromoCode']['code'];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $promocode['PromoCode']['no_of_use'];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $promocode['PromoCode']['discount'].'%';
                            ?>
                        </td>
                        <td >
                        <?php
                        echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')), array('action' => 'view', $promocode['PromoCode']['id']), array('class' => 'btn btn-success btn-xs', 'escape' => false));
                        ?>
                        <?php
                        echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')), array('action' => 'edit', $promocode['PromoCode']['id']), array('class' => 'btn btn-info btn-xs', 'escape' => false));
                        ?>
                        <?php
                        echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')), array('action' => 'delete', $promocode['PromoCode']['id']), array('class' => 'btn btn-danger btn-xs', 'escape' => false), __('Are you sure you want to delete # %s?', $promocode['PromoCode']['id']));
                        ?>
                        </td>


                    </tr>
                 <?php
                endforeach;
            else :
                ?>
                <tr>
                    <td colspan="6"><?php echo __('No Promo Codes found'); ?></td>
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