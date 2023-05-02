<?php

require('../includes/connect_db.php');

$users = array();

$q = "SELECT * FROM users;";
$stmt = $link->prepare($q);
$stmt->execute();
$res = $stmt->get_result();
while ($row = mysqli_fetch_array($res)) {
    $user_obj = new stdClass();
    $user_obj->id = $row['user_id'];
    $user_obj->name = $row['first_name'] . ' ' . $row['last_name'];
    $user_obj->email = $row['email'];
    $user_obj->phone = $row['phone'];
    $user_obj->dob = $row['date_of_birth'];
    $user_obj->country = $row['country'];
    $user_obj->reg_date = $row['reg_date'];
    $user_obj->subscription_status = $row['subscription_status'];
    $user_obj->subscription_type = $row['subscription_type'];

    array_push($users, $user_obj);
}

foreach ($users as $user) {
    echo "<tr class=\"expandable-table-row\">
<td>{$user->id}</td>
<td>{$user->name}</td>
<td>{$user->email}</td>
</tr>
<tr class=\"expandable-table-extra\">
<td colspan=\"3\">
    <div class=\"details-container\">
        <div class=\"details\">
            <table class=\"table details-table\">
                <tbody>
                    <tr>
                        <td><strong>Phone</strong></td>
                        <td class=\"field-phone\">{$user->phone}</td>
                    </tr>
                    <tr>
                        <td><strong>Date of birth</strong></td>
                        <td>{$user->dob}</td>
                    </tr>
                    <tr>
                        <td><strong>Country code</strong></td>
                        <td class=\"field-country\">{$user->country}</td>
                    </tr>
                    <tr>
                        <td><strong>Joined on</strong></td>
                        <td>{$user->reg_date}</td>
                    </tr>
                    <tr>
                        <td><strong>Plan status</strong></td>
                        <td class=\"field-plan-status\">{$user->subscription_status}</td>
                    </tr>
                    <tr>
                        <td><strong>Plan type</strong></td>
                        <td class=\"field-plan-type\">{$user->subscription_type}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>
                            <button type=\"button\" class=\"btn btn-info admin-edit\" id-data=\"user-{$user->id}\" item-data=\"{$user->name}\">Edit</button>
                        </td>
                        <td>
                            <button type=\"button\" class=\"btn btn-danger admin-delete\" id-data=\"user-{$user->id}\" item-data=\"{$user->name}\">Delete</button>
                        </td>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
</td>
</tr>";
}

mysqli_close($link);

?>