<?php 
set('id', 3);
set('title', 'Doors');
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <button id="twitter" class="btn btn-round"><i class="fa fa-user"></i>Add controller</button>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>IP Adress</th>
                                <th>Doors</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>TopFloorController</td>
                                    <td>192.178.0.14</td>
                                    <td>
                                        <table class="table">
                                        <thead>
                                            <th>ID</th>
                                            <th>Name</th>
                                        </thead>
                                        <tr>
                                            <td>Relais 1</td>
                                            <td>Server room</td>
                                            <td>
                                                <button class="btn btn-sm">Edit</button>&nbsp;
                                                <button class="btn btn-sm btn-danger">remove</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Relais 2</td>
                                            <td></td>
                                            <td>
                                                <button class="btn btn-sm">Edit</button>&nbsp;
                                            </td>
                                        </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>MainController</td>
                                    <td>192.178.0.15</td>
                                    <td>
                                <table class="table table-hover">
                                    <thead>
                                        <th>ID</th>
                                        <th>Name</th>
                                    </thead>
                                    <tr>
                                        <td>Relais 1</td>
                                        <td>Main entrance</td>
                                        <td>
                                            <button class="btn btn-sm">Edit</button>&nbsp;
                                            <button class="btn btn-sm btn-danger">remove</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Relais 2</td>
                                        <td>Backdoor</td>
                                        <td>
                                            <button class="btn btn-sm">Edit</button>&nbsp;
                                            <button class="btn btn-sm btn-danger">remove</button>
                                        </td>
                                    </tr>
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

            