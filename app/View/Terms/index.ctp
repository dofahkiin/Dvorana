<?php
echo $this->Html->css(array(
    'reset','jquery-ui-1.10.3.custom',
    'jquery.weekcalendar','demo'));
echo $this->Html->script(array(
    'jquery-1.10.2','jquery-migrate-1.2.1','jquery-ui-1.10.3.custom.min',
    'jquery.weekcalendar','demo'));


?>

<div class="terms index">
	<h2><?php echo __('Terms'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('term'); ?></th>
			<th><?php echo $this->Paginator->sort('client_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($terms as $term): ?>
	<tr>
		<td><?php echo h($term['Term']['id']); ?>&nbsp;</td>
		<td><?php echo h($term['Term']['date']); ?>&nbsp;</td>
		<td><?php echo h($term['Term']['term']); ?>&nbsp;</td>
		<td><?php echo h($term['Term']['client_id']); ?>&nbsp;</td>
		<td><?php echo h($term['Term']['status']); ?>&nbsp;</td>
		<td><?php echo h($term['Term']['price']); ?>&nbsp;</td>
		<td><?php echo h($term['Term']['comment']); ?>&nbsp;</td>
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
<div id="cal">
    <h1>jQuery Week Calendar (full demo)</h1>

    <div id='calendar'></div>
    <div id="event_edit_container">
        <form>
            <input type="hidden" />
            <ul>
                <li>
                    <span>Date: </span><span class="date_holder"></span>
                </li>
                <li>
                    <label for="start">Start Time: </label><select name="start"><option value="">Select Start Time</option></select>
                </li>
                <li>
                    <label for="end">End Time: </label><select name="end"><option value="">Select End Time</option></select>
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
    <div id="about">
        <h2>Summary</h2>
        <p>
            This calendar implementation demonstrates further usage of the calendar with editing and deleting of events.
            It stops short however of implementing a server-side back-end which is out of the scope of this plugin. It
            should be reasonably evident by viewing the demo source code, where the points for adding ajax should be.
            Note also that this is **just a demo** and some of the demo code itself is rough. It could certainly be
            optimised.
        </p>
        <p>
            ***Note: This demo is straight out of SVN trunk so may show unreleased features from time to time.
        </p>
        <h2>Demonstrated Features</h2>
        <p>
            This calendar implementation demonstrates the following features:
        </p>
        <ul class="formatted">
            <li>Adding, updating and deleting of calendar events using jquery-ui dialog. Also includes
                additional calEvent data (body field) not defined by the calEvent data structure to show the storage
                of the data within the calEvent</li>
            <li>Dragging and resizing of calendar events</li>
            <li>Restricted timeslot rendering based on business hours</li>
            <li>Week starts on Monday instead of the default of Sunday</li>
            <li>Allowing calEvent overlap with staggered rendering of overlapping events</li>
            <li>Use of the 'getTimeslotTimes' method to retrieve valid times for a given event day. This is used to populate
                select fields for adding, updating events.</li>
            <li>Use of the 'eventRender' callback to add a different css class to calEvents in the past</li>
            <li>Use of additional calEvent data to enforce readonly behaviour for a calendar event. See the event
                titled "i'm read-only"</li>
        </ul>
    </div>


</div>
