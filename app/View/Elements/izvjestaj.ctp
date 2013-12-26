<?php
echo $this->Form->input('date', array(
'label' => 'Datum:',
'type' => 'text'));
echo $this->Form->input('od', array(
'label' => 'Od:',
'type' => 'text'));
echo $this->Form->input('do', array(
'label' => 'Do:',
'type' => 'text'));
echo $this->Form->input('vrijemeT', array(
'label' => 'Vrijeme termina:',
'type' => 'time',
'interval' => 15,
'timeFormat'=>'24',
'empty' => array("")));
echo $this->Form->input('vrijemeOd', array(
'label' => 'Vrijeme od:',
'type' => 'time',
'interval' => 15,
'timeFormat'=>'24',
'empty' => array("")));
echo $this->Form->input('vrijemeDo', array(
'label' => 'Vrijeme do:',
'type' => 'time',
'interval' => 15,
'timeFormat'=>'24',
'empty' => array("")));
echo $this->Form->input('hall', array(
'label' => 'Sala:',
'type' => 'select',
'options' => array(1 => 'Sala 1', 2 => 'Sala 2', 3 => 'Sala 3'),
'empty' => 'Izaberi salu'));

