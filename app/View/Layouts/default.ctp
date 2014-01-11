<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>

	</title>


    <script type="text/javascript">var myBaseUrl = '<?php echo $this->Html->url('/'); ?>';</script>


	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

        echo $this->Js->writeBuffer();
	?>
</head>
<body>
	<div id="container">
		<div id="header">

            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <?php
                    if($userData != null){
                        echo "<li><a href=\"/terms\">Termini</a></li>";
                        if($userData['role'] == 'Menadžer')
                        {
                            echo "<li><a href=\"/users\">Korisnici</a></li>";
                            echo "<li><a href=\"/settings/edit/\">Podešavanja</a></li>";
                        }

                        echo "<li><a href=\"/terms/izvjestaj\">Izvještaj</a></li>";
                        echo "<li><a href=\"/users/edit/". $userData['id']."\">Uredi profil</a></li>";
                        echo "<li><a href=\"/users/logout\">Logout(".$userData['name'].")</a></li>";
                    }
                    ?>

                </ul>
            </nav>

		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
</body>
</html>
