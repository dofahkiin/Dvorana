<div id="sadrzaj">

<div class="actions">
    <h3><?php echo __('Radnje'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Novi korisnik'), array('action' => 'add')); ?></li>
    </ul>
</div>
<div class="users index">
	<h2><?php echo __('Korisnici'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('Ime'); ?></th>
			<th><?php echo $this->Paginator->sort('Prezime'); ?></th>
			<th><?php echo $this->Paginator->sort('Korisničko ime'); ?></th>
			<th><?php echo $this->Paginator->sort('Telefon'); ?></th>
			<th><?php echo $this->Paginator->sort('Email'); ?></th>
			<th><?php echo $this->Paginator->sort('Rola'); ?></th>
			<th class="actions"><?php echo __('Radnje'); ?></th>
	</tr>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['surname']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['telephone']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['role']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Izmjeni'), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Form->postLink(__('Obriši'), array('action' => 'delete', $user['User']['id']), null, __('Jeste li sigurni da želite da obrišete korisnika # %s?', $user['User']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Stranica {:page} od {:pages}, prikazano {:current} korisnika od ukupno {:count}, počinje od {:start}, završava na {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('prethodni'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('sljedeći') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>

</div>