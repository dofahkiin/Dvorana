<div class="terms form">
<?php echo $this->Form->create('Term'); ?>
	<fieldset>
		<legend><?php echo __('Edit Term'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('date');
		echo $this->Form->input('term');
		//echo $this->Form->input('client_id');
		echo $this->Form->input('status');
		echo $this->Form->input('price');
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Term.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Term.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Terms'), array('action' => 'index')); ?></li>
	</ul>
</div>
