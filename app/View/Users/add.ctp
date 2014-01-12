<div id="sadrzaj">
<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('surname');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('telephone');
		echo $this->Form->input('email');
    if($userData['role'] == 'Menadžer')
    {
		echo $this->Form->input('role', array(
            'options' => array('Klijent' => 'Klijent', 'Menadžer'=>'Menadžer')
        ));
    }
    // TODO ispravi role problem
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

</div>