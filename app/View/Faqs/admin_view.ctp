<div class="blogs view">
    <h2><?php echo __('FAQ View'); ?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
			<?php echo h($faq['Faq']['id']); ?>
        </dd>
        <dt><?php echo __('Title'); ?></dt>
        <dd>
			<?php echo h($faq['Faq']['title']); ?>
        </dd>

        <dt><?php echo __('Description'); ?></dt>
        <dd>
			<?php echo h($faq['Faq']['description']); ?>
        </dd>
        <dt><?php echo __('Status'); ?></dt>
        <dd>
            <?php echo ($faq['Faq']['status'] == '1') ? 'Active': 'Deactive'; ?>
        </dd>
        <dt><?php echo __('Order'); ?></dt>
        <dd>
            <?php echo ($faq['Faq']['order']); ?>
        </dd>
    </dl>
</div>
<?php //echo($this->element('admin_sidebar'));?>
