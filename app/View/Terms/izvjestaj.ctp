<div class="terms index">
    <h2><?php echo __('Terms'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('date'); ?></th>
            <th><?php echo $this->Paginator->sort('status'); ?></th>
            <th><?php echo $this->Paginator->sort('term'); ?></th>
            <th><?php echo $this->Paginator->sort('hall_id'); ?></th>
            <th><?php echo $this->Paginator->sort('comment'); ?></th>
            <th><?php echo $this->Paginator->sort('price'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($terms as $term): ?>
            <tr>
                <td><?php echo h($term['Term']['date']); ?>&nbsp;</td>
                <td><?php echo h($term['Term']['status']); ?>&nbsp;</td>
                <td><?php echo h($term[0]['term']); ?>&nbsp;</td>
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
    <?php
    echo $this->Form->create('Term', array('action' => 'search'));
    echo $this->Form->input('date', array(
        'label' => 'Datum:',
        'type' => 'text'));
    echo $this->Form->input('od', array(
        'label' => 'Od:',
        'type' => 'text'));
    echo $this->Form->input('do', array(
        'label' => 'Do:',
        'type' => 'text'));
    echo $this->Form->input('hall', array(
        'label' => 'Sala:',
        'type' => 'select',
        'options' => array(1 => 'Sala 1', 2 => 'Sala 2', 3 => 'Sala 3'),
        'empty' => 'Izaberi salu'));
    echo $this->Form->input('status', array(
        'label' => 'Termin:',
        'type' => 'select',
        'options' => array("nepotvrđen" => "nepotvrđen",
                            "potvrđen" => "potvrđen",
                            "otkazan" => "otkazan",
                            "završen" => "završen"),
        'empty' => 'Izaberi status'));
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
    echo $this->Form->submit('Pretraži');
    echo $this->Form->end();
    ?>
</div>