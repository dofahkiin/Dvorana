<?php
echo $this->Html->css('slider');
echo $this->Html->script(array('jquery-1.10.2.min', 'slider.min'), FALSE);
?>

<div class="full-width">
    <div class="inner">
        <div class="slide">
            <div>Dobrodošli na stranicu sportske dvorane.</div>
            <?php echo $this->Html->image('dvorana1.jpg', array('alt' => 'dvorana1', "width" => "1020", "height"=> "400")); ?>
        </div>
        <div class="slide">
            <div>Želimo vam prijatan boravak.</div>
            <?php echo $this->Html->image('dvorana2.jpg', array('alt' => 'dvorana2', "width" => "1020", "height"=> "400")); ?>
        </div>
        <div class="slide">
            <?php echo $this->Html->image('dvorana3.jpg', array('alt' => 'dvorana2', "width" => "1020", "height"=> "400")); ?>
        </div>
    </div>
    <div class="controls">
        <a href="#" class="left">&lt;</a>
        <a href="#" class="right">&gt;</a>
    </div>
    <div class="slide-nav"></div>
</div>

<div class="terms home">
<?php

if($userData == null){
    echo $this->element('login');
}
?>
</div>

<script>
    $('.full-width').fullWidth();
</script>