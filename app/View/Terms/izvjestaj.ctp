<?php
echo $this->Html->css('jquery-ui', FALSE);

echo $this->Html->script('jquery-1.10.2.min', FALSE);
echo $this->Html->script('jquery-ui-1.10.3.custom.min', FALSE);
echo $this->Html->script('jquery.activity-indicator-1.0.0', FALSE);



$this->Paginator->options(array(
    'update' => '#content',
    'before' => "$('#load').activity()",
    'complete' => "$('#load').activity(false)",
    'evalScripts' => true
));
?>

<div id="sadrzaj">

    <div id="listaTermina">
        <div class="terms index">
            <h2><?php echo __('Termini'); ?></h2>
            <?php
            if ($userData['role'] == 'Klijent') {
                ?>

                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <th><?php echo $this->Paginator->sort('Datum'); ?></th>
                        <th><?php echo $this->Paginator->sort('Status'); ?></th>
                        <th><?php echo $this->Paginator->sort('Termin'); ?></th>
                        <th><?php echo $this->Paginator->sort('Sala'); ?></th>
                        <th><?php echo $this->Paginator->sort('Komentar'); ?></th>
                        <th><?php echo $this->Paginator->sort('Cijena'); ?></th>
                    </tr>

                    <?php foreach ($terms as $term): ?>
                        <tr>
                            <td><?php echo h($term['Term']['date']); ?>&nbsp;</td>
                            <td><?php echo h($term['Term']['status']); ?>&nbsp;</td>
                            <td><?php echo h($term[0]['term']); ?>&nbsp;</td>
                            <td><?php echo h($term['Hall']['name']); ?>&nbsp;</td>
                            <td><?php echo h($term['Term']['comment']); ?>&nbsp;</td>
                            <td><?php echo h($term['Term']['price']); ?>&nbsp;</td>
                        </tr>
                    <?php endforeach; ?>

                </table>

            <?php } else { ?>

                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <th><?php echo $this->Paginator->sort('Datum'); ?></th>
                        <th><?php echo $this->Paginator->sort('Status'); ?></th>
                        <th><?php echo $this->Paginator->sort('Termin'); ?></th>
                        <th><?php echo $this->Paginator->sort('Ime i prezime'); ?></th>
                        <th><?php echo $this->Paginator->sort('Sala'); ?></th>
                        <th><?php echo $this->Paginator->sort('Komentar'); ?></th>
                        <th><?php echo $this->Paginator->sort('Cijena'); ?></th>
                    </tr>

                    <?php foreach ($terms as $term): ?>
                        <tr>
                            <td><?php echo h($term[0]['date']); ?>&nbsp;</td>
                            <td><?php echo h($term['Term']['status']); ?>&nbsp;</td>
                            <td><?php echo h($term[0]['term']); ?>&nbsp;</td>
                            <td><?php echo h($term['User']['name']) . ' ' . h($term['User']['surname']); ?>&nbsp;</td>
                            <td><?php echo h($term['Hall']['name']); ?>&nbsp;</td>
                            <td><?php echo h($term['Term']['comment']); ?>&nbsp;</td>
                            <td><?php echo h($term['Term']['price']); ?>&nbsp;</td>
                        </tr>
                    <?php endforeach; ?>

                </table>

            <?php } ?>


            <p>
                <?php
                echo $this->Paginator->counter(array(
                    'format' => __('Stranica {:page} od {:pages}, prikazano {:current} termina od ukupno {:count}, počinje od {:start}, završava na {:end}')
                ));
                ?>    </p>

            <div class="paging">
                <?php
                echo $this->Paginator->prev('< ' . __('prethodni'), array(), null, array('class' => 'prev disabled'));
                echo $this->Paginator->numbers(array('separator' => ''));
                echo $this->Paginator->next(__('sljedeći') . ' >', array(), null, array('class' => 'next disabled'));
                ?>
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



    <?php
    echo $this->Html->script('search');
    ?>

</div>

<?php echo $this->Js->writeBuffer(); ?>




