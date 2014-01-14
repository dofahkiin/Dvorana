<div id="sadrzaj">
<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Novi korisnik'); ?></legend>
	<?php
		echo $this->Form->input('name', array(
            "label" => "Ime"
        ));
		echo $this->Form->input('surname', array(
            "label" => "Prezime"
        ));
		echo $this->Form->input('username', array(
            "label" => "Korisničko ime"
        ));
		echo $this->Form->input('password', array(
            "label" => "Lozinka"
        ));
		echo $this->Form->input('telephone', array(
            "label" => "Telefon"
        ));
		echo $this->Form->input('email', array(
            "label" => "Email"
        ));
    if($userData['role'] == 'Menadžer')
    {
		echo $this->Form->input('role', array(
            'options' => array('Klijent' => 'Klijent', 'Menadžer'=>'Menadžer'), array(
                "label" => "Rola"
            )
        ));
    }
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

</div>