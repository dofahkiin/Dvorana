<?php
$this->Paginator->options(array(
    'update' => '#listaPretrage',
    'before' => $this->Js->get('#loading')->effect('fadeIn',
            array('buffer' => false)),
    'complete' => $this->Js->get('#loading')->effect('fadeOut',
            array('buffer' => false))
));

?>

<div id="listaPretrage">
    <div class="terms index">
        <h2><?php echo __('Pretraga'); ?></h2>
        <?php
        if ($userData['role'] == 'Klijent') {
            ?>

            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th><?php echo $this->Paginator->sort('date'); ?></th>
                    <th><?php echo $this->Paginator->sort('status'); ?></th>
                    <th><?php echo $this->Paginator->sort('term'); ?></th>
                    <th><?php echo $this->Paginator->sort('Sala'); ?></th>
                    <th><?php echo $this->Paginator->sort('comment'); ?></th>
                    <th><?php echo $this->Paginator->sort('price'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
                <?php foreach ($terms as $term): ?>
                    <tr>
                        <td><?php echo h($term['Term']['date']); ?>&nbsp;</td>
                        <td><?php echo h($term['Term']['status']); ?>&nbsp;</td>
                        <td><?php echo h($term[0]['term']); ?>&nbsp;</td>
                        <td><?php echo h($term['Hall']['name']); ?>&nbsp;</td>
                        <td><?php echo h($term['Term']['comment']); ?>&nbsp;</td>
                        <td><?php echo h($term['Term']['price']); ?>&nbsp;</td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), array('action' => 'view', $term['Term']['id'])); ?>
                            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $term['Term']['id'])); ?>
                            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $term['Term']['id']), null, __('Are you sure you want to delete # %s?', $term['Term']['id'])); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php } else { ?>

            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th><?php echo $this->Paginator->sort('date'); ?></th>
                    <th><?php echo $this->Paginator->sort('status'); ?></th>
                    <th><?php echo $this->Paginator->sort('term'); ?></th>
                    <th><?php echo $this->Paginator->sort('name'); ?></th>
                    <th><?php echo $this->Paginator->sort('Sala'); ?></th>
                    <th><?php echo $this->Paginator->sort('comment'); ?></th>
                    <th><?php echo $this->Paginator->sort('price'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
                <?php foreach ($terms as $term): ?>
                    <tr>
                        <td><?php echo h($term['Term']['date']); ?>&nbsp;</td>
                        <td><?php echo h($term['Term']['status']); ?>&nbsp;</td>
                        <td><?php echo h($term[0]['term']); ?>&nbsp;</td>
                        <td><?php echo h($term['User']['name']) . ' ' . h($term['User']['surname']); ?>&nbsp;</td>
                        <td><?php echo h($term['Hall']['name']); ?>&nbsp;</td>
                        <td><?php echo h($term['Term']['comment']); ?>&nbsp;</td>
                        <td><?php echo h($term['Term']['price']); ?>&nbsp;</td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), array('action' => 'view', $term['Term']['id'])); ?>
                            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $term['Term']['id'])); ?>
                            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $term['Term']['id']), null, __('Are you sure you want to delete # %s?', $term['Term']['id'])); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php } ?>


        <p>
            <?php
            echo $this->Paginator->counter(array(
                'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
            ));
            ?>    </p>

        <div class="paging">
            <?php
            echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
            echo $this->Paginator->numbers(array('separator' => ''));
            echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
            ?>
        </div>

    </div>

</div>

<?php
echo $this->Js->writeBuffer(array('cache' => TRUE));
?>