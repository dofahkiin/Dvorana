<div class="terms index">
    <h2><?php echo __('Terms'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('date'); ?></th>
            <th><?php echo $this->Paginator->sort('term'); ?></th>
            <th><?php echo $this->Paginator->sort('status'); ?></th>
            <th><?php echo $this->Paginator->sort('hall_id'); ?></th>
            <th><?php echo $this->Paginator->sort('comment'); ?></th>
            <th><?php echo $this->Paginator->sort('price'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($terms as $term): ?>
            <tr>
                <td><?php echo h($term['Term']['date']); ?>&nbsp;</td>
                <td><?php echo h($term['Term']['term']); ?>&nbsp;</td>
                <td><?php echo h($term['Term']['status']); ?>&nbsp;</td>
                <td><?php echo h($term['Term']['hall_id']); ?>&nbsp;</td>
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
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>	</p>
    <div class="paging">
        <?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('New Term'), array('action' => 'add')); ?></li>
    </ul>
</div>