<?php 
$title = "Groups";
$id = 2;

include 'header.php';

?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <button id="twitter" class="btn btn-round"><i class="fa fa-user"></i>Add group</button>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Doors</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Management</td>
                                    <td>
                                <table class="table table-hover">
                                    <thead>
                                        <th>Door</th>
                                        <th>Timezone</th>
                                    </thead>
                                    <tr>
                                        <td>Main entrance</td>
                                        <td>24 Hours</td>
                                        <td>
                                            <button class="btn btn-sm">Edit</button>&nbsp;
                                            <button class="btn btn-sm btn-danger">remove</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Backdoor</td>
                                        <td>24 Hours</td>
                                        <td>
                                            <button class="btn btn-sm">Edit</button>&nbsp;
                                            <button class="btn btn-sm btn-danger">remove</button>
                                        </td>
                                    </tr>
                                    <tr><td>
                                        <button class="btn btn-sm">add</button>
                                    </td></tr>
                                </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Workers</td>
                                    <td>
                                    <table class="table table-hover">
                                    <thead>
                                        <th>Door</th>
                                        <th>Timezone</th>
                                    </thead>
                                    <tr>
                                        <td>Main entrance</td>
                                        <td>Working hours</td>
                                        <td>
                                            <button class="btn btn-sm">Edit</button>&nbsp;
                                            <button class="btn btn-sm btn-danger">remove</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Backdoor</td>
                                        <td>24 Hours</td>
                                        <td>
                                            <button class="btn btn-sm">Edit</button>&nbsp;
                                            <button class="btn btn-sm btn-danger">remove</button>
                                        </td>
                                    </tr>
                                    <tr><td>
                                        <button class="btn btn-sm">add</button>
                                    </td></tr>
                                    </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Cleaners</td>
                                    <td>
                                    <table class="table table-hover">
                                    <thead>
                                        <th>Door</th>
                                        <th>Timezone</th>
                                    </thead>
                                    <tr>
                                        <td>Backdoor</td>
                                        <td>Evening</td>
                                        <td>
                                            <button class="btn btn-sm">Edit</button>&nbsp;
                                            <button class="btn btn-sm btn-danger">remove</button>
                                        </td>
                                    </tr>
                                    <tr><td>
                                        <button class="btn btn-sm">add</button>
                                    </td></tr>
                                    </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>               
        </div>
    </div>
</div>

<?php include 'footer.php';?>
