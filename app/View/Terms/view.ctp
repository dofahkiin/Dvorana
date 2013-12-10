<div class="terms view">
<h2><?php echo __('Term'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($term['Term']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($term['Term']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Term'); ?></dt>
		<dd>
			<?php echo h($term['Term']['term']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client Id'); ?></dt>
		<dd>
			<?php echo h($term['Term']['client_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($term['Term']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($term['Term']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($term['Term']['comment']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Term'), array('action' => 'edit', $term['Term']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Term'), array('action' => 'delete', $term['Term']['id']), null, __('Are you sure you want to delete # %s?', $term['Term']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Terms'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Term'), array('action' => 'add')); ?> </li>
	</ul>
</div>
