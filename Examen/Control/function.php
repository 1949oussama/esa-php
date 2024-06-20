<?php
// Définir les chemins vers les fichiers
$user_file = '../Fichier/users.txt'; 

function getUserCsvFilePath($username) {
    return __DIR__ . "/../Fichier/todos_{$username}.csv";
}

function authentifier($username, $password) {
    //Chemin absolu au script actuel
    $file_path = __DIR__ . '/../Fichier/users.txt';
    if (!file_exists($file_path)) {
        die("Cannot open file: $file_path");
    }

    $file = fopen($file_path, 'r');
    if (!$file) {
        die("Cannot open file: $file_path");
    }

    // Lire et traiter le fichier
    while (($line = fgets($file)) !== false) {
        $data = explode(':', trim($line));
        if ($data[0] === $username && $data[1] === $password) {
            fclose($file);
            return true;
        }
    }

    fclose($file);
    return false;
}

function inscrire($username, $password) {
    global $user_file;
    // Vérifier si l'utilisateur existe déjà
    $users = file($user_file, FILE_IGNORE_NEW_LINES);
    foreach ($users as $user) {
        list($stored_username, $stored_password) = explode(':', $user);
        if ($stored_username === $username) {
            return false; // L'utilisateur existe déjà
        }
    }
    // Ajouter le nouvel utilisateur
    if (file_put_contents($user_file, "$username:$password\n", FILE_APPEND) === false) {
        die("Erreur lors de l'écriture dans le fichier des utilisateurs.");
    }
    // Créer un fichier CSV pour le nouvel utilisateur
    $user_csv = getUserCsvFilePath($username);
    $handle = fopen($user_csv, 'w');
    fclose($handle);

    return true;
}

function update_password($username, $new_password) {
    global $user_file;
    $users = file($user_file, FILE_IGNORE_NEW_LINES);
    $updated_users = [];
    $user_found = false;

    foreach ($users as $user) {
        list($stored_username, $stored_password) = explode(':', $user);
        if ($stored_username === $username) {
            $updated_users[] = "$username:$new_password";
            $user_found = true;
        } else {
            $updated_users[] = $user;
        }
    }

    if ($user_found) {
        file_put_contents($user_file, implode("\n", $updated_users) . "\n");
        return true;
    } else {
        return false;
    }
}

function getTodos($username) {
    $file = getUserCsvFilePath($username);
    $todos = [];

    if (file_exists($file)) {
        $handle = fopen($file, 'r');
        while (($data = fgetcsv($handle)) !== FALSE) {
            $todos[] = [
                'nom_tache' => $data[0],
                'categorie' => $data[1],
                'priorite' => $data[2],
                'statut' => $data[3],
                'recurrence' => $data[4],
                'date_debut' => $data[5],
                'date_creation' => $data[6],
                'description' => $data[7]
            ];
        }
        fclose($handle);
    }

    return $todos;
}

// Fonction pour sauvegarder les tâches dans le fichier todo.csv
function saveTodos($username, $todos) {
    $file = getUserCsvFilePath($username);
    $handle = fopen($file, 'w');

    foreach ($todos as $todo) {
        fputcsv($handle, $todo);
    }

    fclose($handle);
}

// Fonction pour ajouter une nouvelle tâche
function add_task($username, $todo) {
    $task['date_creation'] = date('Y-m-d H:i:s');
    $todos = getTodos($username);
    $todos[] = $todo;
    saveTodos($username, $todos);
}

// Fonction pour éditer une tâche
function edit_task($username, $index, $newTodo) {
    $todos = getTodos($username);
    if (isset($todos[$index])) {
        $task['date_creation'] = $todos[$index]['date_creation'];
        $todos[$index] = $newTodo;
        saveTodos($username, $todos);
    }
    return false;
}

// Fonction pour supprimer une tâche
function delete_task($username, $index) {
    $todos = getTodos($username);
    if (isset($todos[$index])) {
        unset($todos[$index]);
        saveTodos($username, array_values($todos));
    }
    return false;
}

// Fonction pour filtrer les tâches par statut
function filterTodos($todos, $filter) {
    if ($filter == 'tous') {
        return $todos;
    }
    return array_filter($todos, function($todo) use ($filter) {
        return $filter == 'realises' ? $todo['statut'] == 'realise' : $todo['statut'] == 'non_realise';
    });
}

// Fonction pour trier les tâches par différents critères
function sortTodos($todos, $sort) {
    usort($todos, function($a, $b) use ($sort) {
        switch ($sort) {
            case 'tri_nom_asc':
                return strcmp($a['nom_tache'], $b['nom_tache']);
            case 'tri_nom_desc':
                return strcmp($b['nom_tache'], $a['nom_tache']);
            case 'tri_categorie_asc':
                return strcmp($a['categorie'], $b['categorie']);
            case 'tri_categorie_desc':
                return strcmp($b['categorie'], $a['categorie']);
            case 'tri_priorite_asc':
                return strcmp($a['priorite'], $b['priorite']);
            case 'tri_priorite_desc':
                return strcmp($b['priorite'], $a['priorite']);
            case 'tri_date_debut_asc':
                return strtotime($a['date_debut']) - strtotime($b['date_debut']);
            case 'tri_date_debut_desc':
                return strtotime($b['date_debut']) - strtotime($a['date_debut']);
            case 'tri_date_creation_asc':
                return strtotime($a['date_creation']) - strtotime($b['date_creation']);
            case 'tri_date_creation_desc':
                return strtotime($b['date_creation']) - strtotime($a['date_creation']);
            default:
                return 0;
        }
    });
    return $todos;
}

// Fonction pour rechercher les tâches par nom
function searchTodos($todos, $search) {
    if (empty($search)) {
        return $todos;
    }
    return array_filter($todos, function($todo) use ($search) {
        return stripos($todo['nom_tache'], $search) !== false;
    });
}

function toggle_task_status($username, $index) {
    $todos = getTodos($username);
    if (isset($todos[$index])) {
        $todos[$index]['statut'] = ($todos[$index]['statut'] == 'realise') ? 'non_realise' : 'realise';
        saveTodos($username, $todos);
    }
}

?>
