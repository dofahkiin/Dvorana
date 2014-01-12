<?php echo $this->Html->script('jquery-1.10.2.min', FALSE); ?>
<?php echo $this->Html->script('toastr.min'); ?>
<?php echo $this->Html->script('validation', FALSE); ?>

<?php echo $this->Html->css('toastr.min'); ?>

<div id="sadrzaj">

<?php
echo $this->Form->create('Setting');
echo $this->Form->input('value', array(
    'label' => 'Termini se mogu uređivati min. dana unaprijed:',
    'id' => 'value'));
echo $this->Form->submit('Sačuvaj podešavanja', array(
    'id' => 'submit'
));
echo $this->Form->end();
?>

</div>
