<div class="categories view">
<h2><?php echo __('Sales'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($post['Sale']['id']); ?>
			&nbsp;
		</dd>
				<dt><?php echo __('User'); ?></dt>
		<dd><a href="http://107.170.152.166/team4/niwi/admin/users/view/<?php echo $post['User']['id']; ?>"><?php echo $post['User']['first_name'];?></a></a>
			&nbsp;
		</dd>
		<dt><?php echo __('Membership Plan'); ?></dt>
		<dd>
			<a href="http://107.170.152.166/team4/niwi/admin/membership_plans/view/<?php echo $post['MembershipPlan']['id']; ?>"><?php echo $post['MembershipPlan']['title'];?></a>
			&nbsp;
		</dd>
		<dt><?php echo __('From Date'); ?></dt>
		<dd>
			<?php echo h($post['Sale']['fromdate']); ?>
			&nbsp;
		</dd>
			<dt><?php echo __('To Date'); ?></dt>
		<dd>
			<?php echo h($post['Sale']['todate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Renew'); ?></dt>
		<dd>
			<?php echo h($post['Sale']['renew']==0?'No':'Yes'); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
