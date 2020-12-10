<?php

function find_users() {
    return find_objects_by_sql("SELECT * FROM `users`");
}

function find_user_by_id($id) {
    $sql =
        "SELECT * " .
        "FROM users " .
        "WHERE id=:id";
    return find_object_by_sql($sql, array(':id' => $id));
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

function update_user_obj($user_obj) {
    return update_object($user_obj, 'users', user_columns());
}

function create_user_obj($user_obj) {
    return create_object($user_obj, 'users', user_columns());
}

function delete_user_obj($man_obj) {
    delete_object_by_id($man_obj->id, 'users');
}

function delete_user_by_id($user_id) {
    delete_object_by_id($user_id, 'users');
}

function make_user_obj($params, $obj = null) {
    return make_model_object($params, $obj);
}

function user_columns() {
    return array('name', 'last_seen', 'remarks');
}
