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
        echo "<a href=\"". $this->webroot. "users/add\">Registracija</a>";?>
    </div>
</div>