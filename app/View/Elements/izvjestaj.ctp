<div class="datumi">

    <div id="radio">
        <input type="radio" id="radio1" name="radio" checked="checked"><label for="radio1">Datum</label>
        <input type="radio" id="radio2" name="radio"><label for="radio2">Opseg datuma</label>
    </div>

    <div id="datum">
        <?php echo $this->Form->input('date', array(
            'label' => 'Datum:',
            'type' => 'text'));
        ?>
    </div>


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


<div id="datumRange">
    <?php
    echo $this->Form->input('od', array(
        'label' => 'Od:',
        'type' => 'text'));
    echo $this->Form->input('do', array(
        'label' => 'Do:',
        'type' => 'text'));
    ?>
</div>


