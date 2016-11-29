<style>
    table tr td {
        text-align: left;
    }
</style>
<div class="privacies index">
    <h2><?php echo __('SEO KEYWORDS'); ?></h2>
    <table cellpadding="0" cellspacing="0">
<!--        <tr><a href="<?php //echo($this->webroot); ?>admin/Seos/add" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New SEO Keyword</a>
        </tr> -->
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('page_name'); ?></th>
            <th>Keyword</th>

            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($seos as $value): ?>
            <tr>
                <td><?php echo h($value['Seo']['id']); ?></td>
                <td><?php echo h($value['Seo']['page_name']); ?></td>
                <td><?php echo h($value['Seo']['meta_keyword']); ?></td>
                <!--<td>
                <?php echo $this->Html->link($privacy['User']['id'], array('controller' => 'users', 'action' => 'view', $privacy['User']['id'])); ?>
                </td>!-->

                <td >
                    <?php
                    echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')), array('action' => 'edit', $value['Seo']['id']), array('class' => 'btn btn-info btn-xs', 'escape' => false));
                    ?>
                    <?php
                    /*echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')), array('action' => 'delete', $value['Seo']['id']), array('class' => 'btn btn-danger btn-xs', 'escape' => false), __('Are you sure you want to delete # %s?', $value['Seo']['id']));*/
                    ?>
                <!--	<?php echo $this->Html->link(__('View'), array('action' => 'view', $privacy['Analytic']['id'])); ?>!-->

                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
