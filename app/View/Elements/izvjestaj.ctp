<div class="block">
    <div>
        <?php echo $this->Form->input('date', array(
            'label' => 'Datum:',
            'type' => 'text'));
        ?>
    </div>
    <?php
    echo $this->Form->input('od', array(
        'label' => 'Od:',
        'type' => 'text'));
    echo $this->Form->input('do', array(
        'label' => 'Do:',
        'type' => 'text'));
    ?>
</div>

<div class="block">
<div>
    <?php
    echo $this->Form->input('vrijemeT', array(
        'label' => 'Vrijeme',
        'type' => 'time',
        'interval' => 15,
        'timeFormat' => '24',
        'empty' => array("")));
    ?>
</div>
<?php
echo $this->Form->input('vrijemeOd', array(
    'label' => 'Vrijeme od:',
    'type' => 'time',
    'interval' => 15,
    'timeFormat' => '24',
    'empty' => array("")));
echo $this->Form->input('vrijemeDo', array(
    'label' => 'Vrijeme do:',
    'type' => 'time',
    'interval' => 15,
    'timeFormat' => '24',
    'empty' => array("")));
?>
</div>


