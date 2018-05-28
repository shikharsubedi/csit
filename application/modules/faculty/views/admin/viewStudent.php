<div class="section">
	<h4>View Student's</h4>
    <div class="content">
        <?php if($student): ?>
        <table>            
            <tr>
                <td>Name: </td>
                <td><?php echo $student->getName() ?></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td><?php echo $student->getPhone() ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?php echo $student->getEmail() ?></td>
            </tr><tr>
                <td>Date Applied</td>
                <td><?php echo date_format($student->getCreated(), "M d,Y"); ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?php echo $student->getAddress() ?></td>
            </tr>
            <tr>
                <td>Comments</td>
                <td><?php echo $student->getComments() ?></td>
            </tr>
        </table>
    <?php endif; ?>
    </div>
</div>