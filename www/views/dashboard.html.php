<?php 
set('id', 0);
set('title', 'Dashboard');
?>

<div class="content">
    <div class="container-fluid">
       <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Master controller</h4>
                        <p class="card-category">Turn leds on/off on the nuc board gpio 40&45 </p>
                    
                        <center>
                        Red:

                        <a class="btn btn-info btn-sm" href="/?/gpio/45/0">On</a>
                        <a class="btn btn-danger btn-sm" href="/?/gpio/45/1">Off</a>

                        Yellow:
                        <a class="btn btn-info btn-sm" href="/?/gpio/40/0">On</a>
                        <a class="btn btn-danger btn-sm" href="/?/gpio/40/1">Off</a>
                               
                        </center>

                        <a href="https://docs.google.com/document/d/1ZOc3w04Ov9EECDrhrmd3qmBAxG5lbiUyGuRfasSbtHw/edit" target="docs">Here</a> you can find extra documentation

                    </div>
                    <div class="card-body">
                                This controller has
                        <div class="typography-line">
                            <p>
                                <span>Hardware</span>

                                <ul>
                                    <li>2 relays inputs - to connect to doorlocks</li>
                                    <li>2 wiegand inputs - to connect to keypad or NFC reader</li>
                                    <li>UTP connector - to connect to an LAN</li>
                                    <li>A voltage in - to connect 12 or 24V</li>
                                </ul>

                            </p>
                        </div>
                        <div class="typography-line">
                            <span>Configuration</span>
                            <blockquote>
                                <p class="blockquote blockquote-primary">
                                    <ol>
                                    <li>Add doors from this Master controller, or from other Slave controllers</li>
                                    <li>Add timezones (24h and working hours are predefined)</li>
                                    <li>Create groups with timezones</li>
                                    <li>Create users and assign them to a group</li>
                                    <li>Add keypad code or NFC token to the user</li>
                                </ol>
                                    <br>
                                    <br>
                                    <small>
                                        - these pages are mockups, to show future possibilities
                                    </small>
                                </p>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>              
    </div>
</div>

