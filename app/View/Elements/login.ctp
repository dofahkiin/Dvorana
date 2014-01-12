<?php
echo $this->Html->css('slider');
echo $this->Html->script(array('jquery-1.10.2.min', 'slider.min'), FALSE);
?>

<div class="full-width">
    <div class="inner">
        <div class="slide">
            <img src="http://lorempixel.com/1020/400/sports" width="1020" height="400">
        </div>
        <div class="slide">
            <div>Nullam dictum magna sapien, sed adipiscing nibh. <br>Curabitur molestie elit et ultricies vehicula.
            </div>
            <img src="http://lorempixel.com/1020/400/city" width="1020" height="400">
        </div>
        <div class="slide">
            <div>Donec malesuada hendrerit velit, sed consequat. <br>Curabitur molestie elit et ultricies vehicula.
            </div>
            <img src="http://lorempixel.com/1020/400/cats" width="1020" height="400">
        </div>
        <div class="slide">
            <div>Maecenas augue dui, rhoncus a blandit non. <br>Curabitur molestie elit et ultricies vehicula.</div>
            <img src="http://lorempixel.com/1020/400/business" width="1020" height="400">
        </div>
    </div>
    <div class="controls">
        <a href="#" class="left">&lt;</a>
        <a href="#" class="right">&gt;</a>
    </div>
    <div class="slide-nav"></div>
</div>

<div id="home">

<div class="users form">
    <?php echo $this->Session->flash('auth'); ?>
    <?php echo $this->Form->create('User', array(
        'url' => array('controller' => 'users', 'action' => 'login')
    )); ?>
    <fieldset>
        <legend><?php echo __('Molimo vas unesite vaše korisničko ime i šifru'); ?></legend>
        <?php echo $this->Form->input('username', array(
            "label" => "Korisničko ime"
        ));
        echo $this->Form->input('password', array(
            "label" => "Lozinka"
        ));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Prijavi se'));
    echo "<a href=\"/users/add\">Registracija</a>";?>
</div>
</div>

<script>
    $('.full-width').fullWidth();
</script>

