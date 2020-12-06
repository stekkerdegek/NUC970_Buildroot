<?php

# GET /
function main_page() {
	error_log("message");
    return html('main.html.php');
}
