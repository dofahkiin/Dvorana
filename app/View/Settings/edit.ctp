<?php echo $this->Html->script('jquery-1.10.2', FALSE); ?>
<?php echo $this->Html->script('toastr'); ?>
<?php echo $this->Html->script('validation', FALSE); ?>

<?php echo $this->Html->css('toastr'); ?>

<?php
echo $this->Form->create('Setting');
echo $this->Form->input('limit', array(
    'label' => 'Termini se mogu uređivati/rezervisati minimalno dana unaprijed:',
    'id' => 'value',
    'value' => $this->request->data['Setting']['value']));
echo $this->Form->submit('Sačuvaj podešavanja', array(
    'id' => 'submit'
));
echo $this->Form->end();
?>
