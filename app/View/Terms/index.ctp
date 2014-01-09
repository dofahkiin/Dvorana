<?php
echo $this->Html->css(array(
    'reset', 'jquery-ui-1.10.3.custom',
    'jquery.weekcalendar', 'demo', 'toastr'));
echo $this->Html->script(array(
    'jquery-1.10.2', 'jquery-migrate-1.2.1', 'jquery-ui-1.10.3.custom.min',
    'jquery.weekcalendar', 'demo', 'toastr'));
?>

<div id="termSidebar">
    <div id="kalendar">
    <h2><?php echo __('Kalendar'); ?></h2>
    </div>
    <input id="noviTermin" type="submit" value="Novi termin">
    <div class="uputstvo" title="Klinite za prikaz značenja boja statusa">
        <?php echo $this->Html->image('uputstvo3.png', array('alt' => 'uputsvo_za_boje')); ?>
        <p>
            <strong>Savjet:</strong>
            Značenje boja termina.
        </p>
    </div>
</div>



<div class="terms index">
    <div id="cal">
        <div id='calendar'></div>
        <div id="event_edit_container">
            <form>
                <input type="hidden"/>
                <ul>
                    <li>
                        <span>Datum: </span><span class="date_holder"></span>
                    </li>
                    <li>
                        <label for="start">Početak termina: </label><select name="start" id="start">
                            <option value="">Izaberite početak termina</option>
                        </select>
                    </li>
                    <li>
                        <label for="end">Kraj termina: </label><select name="end" id="end">
                            <option value="">Izaberite kraj termina</option>
                        </select>
                    </li>
                    <li id="status">
                        <label>Status: </label>
                        <select name="status">
                            <option value="">Izaberite status</option>
                            <option value="potvrđen">potvrđen</option>
                            <option value="završen">završen</option>
                            <option value="otkazan">otkazan</option>
                        </select>

                    </li>
                    <li>
                        <label for="body">Komentar: </label><textarea name="body"></textarea>
                    </li>
                    <li>
                        <label for="price" class="price">Cijena: </label><label name="price" id="price" class="price"></label>
                    </li>
                    <li class="iznos">
                        <label for="iznos">Naplaćeni iznos:</label><input name="iznos" id="iznos"/>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>

<select name="hall" id="wc-hall" style="display:none;">
    <option value="1">Sala 1</option>
    <option value="2">Sala 2</option>
    <option value="3">Sala 3</option>
</select>

