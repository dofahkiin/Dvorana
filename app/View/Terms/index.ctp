<?php
echo $this->Html->css(array(
    'reset', 'jquery-ui-1.10.3.custom',
    'jquery.weekcalendar', 'demo'));
echo $this->Html->script(array(
    'jquery-1.10.2', 'jquery-migrate-1.2.1', 'jquery-ui-1.10.3.custom.min',
    'jquery.weekcalendar', 'demo'));
?>

<div class="terms index">
    <div id="cal">
        <div id='calendar'></div>
        <div id="event_edit_container">
            <form>
                <input type="hidden"/>
                <ul>
                    <li>
                        <span>Date: </span><span class="date_holder"></span>
                    </li>
                    <li>
                        <label for="start">Start Time: </label><select name="start">
                            <option value="">Select Start Time</option>
                        </select>
                    </li>
                    <li>
                        <label for="end">End Time: </label><select name="end">
                            <option value="">Select End Time</option>
                        </select>
                    </li>
                    <li id="status">
                        <label>Status: </label>
                        <select name="status">
                            <option value="nepotvrđen">nepotvrđen</option>
                            <option value="potvrđen">potvrđen</option>
                            <option value="završen">završen</option>
                            <option value="otkazan">otkazan</option>
                        </select>

                    </li>
                    <li>
                        <label for="body">Body: </label><textarea name="body"></textarea>
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

