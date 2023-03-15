<?php
array_walk_recursive($data, 'encode_items');

$this->output->set_header('Content-Type: application/json; charset=utf-8');
$content = json_encode($data);

if (!$content)
    echo json_last_error_msg();

echo $content;

function encode_items(&$item, $key)
{
    $item = utf8_encode($item);
}

