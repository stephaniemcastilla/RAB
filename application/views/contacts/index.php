<div class="container">
    <h2>Contacts</h2>
    <!-- add contact form -->
    <div>
        <h3>Add a contact</h3>
        <form action="<?php echo URL; ?>contacts/addcontact" method="POST">
            <label>First Name</label>
            <input type="text" name="firstname" value="" required />
            <label>Last Name</label>
            <input type="text" name="lastname" value="" required />
            <label>Email</label>
            <input type="text" name="email" value="" />
            <label>Volunteer?</label>
            <input type="checkbox" name="is_volunteer" value="1" />
            <input type="submit" name="submit_add_contact" value="Submit" />
        </form>
    </div>
    <!-- main content output -->
    <div>
        <h3>Total Contacts</h3>
        <div>
            <?php echo $amount_of_contacts; ?>
        </div>
        <h3>Contacts</h3>
        <table class="table">
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>Id</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Email</td>
                <td>Volunteer?</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($contacts as $contact) { ?>
                <tr>
                    <td><?php if (isset($contact->id)) echo $contact->id; ?></td>
                    <td><?php if (isset($contact->firstname)) echo $contact->firstname; ?></td>
                    <td><?php if (isset($contact->lastname)) echo $contact->lastname; ?></td>
                    <td>
                        <?php if (isset($contact->email)) { ?>
                            <a href="<?php echo $contact->email; ?>"><?php echo $contact->email; ?></a>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if (isset($contact->is_volunteer)) { ?>
                            <a href="<?php echo $contact->is_volunteer; ?>"><?php echo $contact->is_volunteer; ?></a>
                        <?php } ?>
                    </td>
                    <td><a class="delete" href="<?php echo URL . 'contacts/deletecontact/' . $contact->id; ?>">x</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
