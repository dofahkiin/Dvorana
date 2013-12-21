<?php echo $this->Html->script('jquery-1.10.2', FALSE); ?>

<?php
echo $this->Form->create('Setting');
echo $this->Form->input('value', array(
    'label' => 'Minimalni broj dana nakon kojih korisnik može mijenjati termin:'));
echo $this->Js->submit('Sačuvaj podešavanja', array(
    'before' => $this->Js->get('#sending')->effect('fadeIn'),
    'success' => $this->Js->get('#sending')->effect('fadeOut'),
    'update' => '#success'
));
echo $this->Form->end();
?>

<div id="sending" style="display: none; background-color: lightgreen">Sending...</div>
<div id="success"></div>