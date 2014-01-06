<div id="userEdit">
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Izmjeni korisnika'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('name', array("label" => "Ime"));
        echo $this->Form->input('surname',array("label" => "Prezime"));
        echo $this->Form->input('username',array("label" => "Korisničko ime"));
        echo $this->Form->input('telephone',array("label" => "Telefon"));
        echo $this->Form->input('email',array("label" => "Email"));
        echo $this->Form->input('role', array(
            'options' => array('Menadžer' => 'Menadžer', 'Klijent' => 'Klijent'),
            "label" => "Rola"));
        echo $this->Form->input('password', array(
            'value' => '',
            'autocomplete' => 'off',
            'required' => false,
            'label' => "Šifra"));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Sačuvaj')); ?>
</div>