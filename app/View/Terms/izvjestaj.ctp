<?php
echo $this->Html->script('jquery-1.10.2', FALSE);
echo $this->Html->script('jquery.activity-indicator-1.0.0', FALSE);


$this->Paginator->options(array(
    'update' => '#content',
    'before' => "$('#load').activity()",
    'complete' => "$('#load').activity(false)",
    'evalScripts' => true
));
?>

<div id="listaTermina">
    <div class="terms index">
        <h2><?php echo __('Terms'); ?></h2>
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
                    <th class="actions"><?php // echo __('Actions'); ?></th>
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
                            <?php // echo $this->Html->link(__('View'), array('action' => 'view', $term['Term']['id'])); ?>
                            <?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $term['Term']['id'])); ?>
                            <?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $term['Term']['id']), null, __('Are you sure you want to delete # %s?', $term['Term']['id'])); ?>
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
                    <th class="actions"><?php // echo __('Actions'); ?></th>
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
                            <?php // echo $this->Html->link(__('View'), array('action' => 'view', $term['Term']['id'])); ?>
                            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $term['Term']['id'])); ?>
                            <?php // echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $term['Term']['id']), null, __('Are you sure you want to delete # %s?', $term['Term']['id'])); ?>
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
            <?php echo $this->Html->image('ajax-loader.gif', array('alt' => 'loading', "style" => "display:none;", "id" => "loading")); ?>

        </div>

    </div>
</div>



<div class="filtriranje">
    <h2><?php echo __('Filtriranje'); ?></h2>
    <?php
    echo $this->Form->create('Term', array('action' => 'search'));

    echo $this->element('izvjestaj');
    ?>
    <div class="block">
        <?php
        echo $this->Form->input('hall', array(
            'label' => 'Sala:',
            'type' => 'select',
            'options' => array(1 => 'Sala 1', 2 => 'Sala 2', 3 => 'Sala 3'),
            'empty' => 'Izaberi salu'));
        ?>


        <?php

        if ($userData['role'] == 'Menadžer') {
        echo $this->Form->input('status', array(
            'label' => 'Termin:',
            'type' => 'select',
            'options' => array("nepotvrđen" => "nepotvrđen",
                "potvrđen" => "potvrđen",
                "otkazan" => "otkazan",
                "završen" => "završen"),
            'empty' => 'Izaberi status'));
        ?>
    </div>
    <div class="block">
        <?php
        echo $this->Form->input('name', array(
            'label' => 'Ime:',
            'type' => 'text'));

        echo $this->Form->input('surname', array(
            'label' => 'Prezime:',
            'type' => 'text'));
        }
        ?>
    </div>
    <div class="block">
        <?php
        echo $this->Form->submit('Pretraži', array("id" => "search"));
        echo $this->Form->end();
        ?>
    </div>
</div>

<div id="load"></div>


<div id="pretraga">
</div>

<?php
echo $this->Html->script('search');
//echo $this->Html->script('jquery.activity-indicator-1.0.0');

//$this->Js->get('#search');
//$this->Js->event('click', $this->Js->alert('hey you!'));
//
?>

<?php echo $this->Js->writeBuffer(array('cache' => TRUE)); ?>




