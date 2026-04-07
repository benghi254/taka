<?php


if (isset($_GET['idTrash']) && !empty($_GET['idTrash'])) {
    include_once '../modals/Ftrash.php';

    Ftrash::deleteTrash($_GET['idTrash']);
    header('Location: ../admin/listTrash.php');

} else {
    header('Location: ../admin/listTrash.php');
}