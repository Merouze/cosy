<?php
require "../php2/vendor/autoload.php";
include "includes/_db.php";

// ******************* message from formulaire ***********************
// if (isset($_POST['task'])) {
//     $task = (strip_tags($_POST['task']));
//     $maxOrder = $dbMtdl->prepare("SELECT MAX(order_task) AS max_order from task");
//     $maxOrder->execute();
//     $addList = $dbMtdl->prepare("INSERT INTO `dtcosycaen` (`task`, `order_task`) VALUES (:task, :maxOrder)");
//     $addList->execute([
//         ':task' => $task,
//         ':maxOrder' => $maxOrder->fetchColumn() + 1
//     ]);

//     if ($addList->rowCount()) {
//         $_SESSION['notif'] = 'tâche ajoutée';
//     } else {
//         $_SESSION['error'] = 'impossible d\'ajouter la tâche';
//     }

    

//     header('Location: index.php');
//     exit;
// };
?>