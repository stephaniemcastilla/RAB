<div class="container">
    <h2>View Volunteer</h2>
    <!-- add volunteer form -->
    <?php foreach ($volunteer as $volunteer) { ?>
    <div>
        <h4><?php if (isset($volunteer->firstname)) echo $volunteer->firstname; ?>
        <?php if (isset($volunteer->firstname)) echo $volunteer->lastname; ?></h4>
        <?php if (isset($volunteer->firstname)) echo $volunteer->email; ?>
    </div>
    <?php } ?>
</div>