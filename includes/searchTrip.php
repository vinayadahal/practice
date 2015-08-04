<div class="searchTrip">
    <form method="POST" action="<?php echo baseUrl . 'search/' ?>" id="selectForm">
        <span>Search Trip</span>
        <select class="searchTripSelect" name='activity'>
            <option value="" disabled selected>Activity</option>
            <?php foreach ($dropDownActivity as $activity) { ?>
                <option><?php echo ucfirst($activity['category']); ?></option>
            <?php } ?>
        </select>
        <select class="searchTripSelect" name='area'>
            <option value="" disabled selected>Area</option>
            <?php foreach ($dropDownArea as $area) { ?>
                <option><?php echo ucfirst($area['area']); ?></option>
            <?php } ?>
        </select>
        <select class="searchTripSelect" name='duration'>
            <option value="" disabled selected>Duration</option>
            <?php foreach ($dropDownDuration as $duration) { ?>
                <option><?php echo $duration['duration']; ?></option>
            <?php } ?>
        </select>
        <input type="submit" value="Search" />
    </form>
</div>
