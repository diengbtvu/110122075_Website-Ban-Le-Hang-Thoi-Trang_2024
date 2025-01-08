<?php

function validateRequiredFields($fields) {
    foreach ($fields as $field) {
        if (empty($_POST[$field])) {
            return false;
        }
    }
    return true;
}

function showAlert($message, $redirect = null) {
    echo '<script type="text/javascript">';
    echo "alert('$message');";
    if ($redirect) {
        echo "window.location.href='$redirect';";
    }
    echo '</script>';
}

function checkDuplicateValue($table, $column, $value, $excludeId = null) {
    try {
        $conn = connectdb();
        $value = strtolower(trim($value));
        
        $sql = "SELECT COUNT(*) FROM $table WHERE LOWER($column) = :value";
        $params = [':value' => $value];
        
        if ($excludeId !== null) {
            $sql .= " AND id != :id";
            $params[':id'] = $excludeId;
        }
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->fetchColumn() > 0;
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        return false;
    }
}

function redirectWithMessage($location, $message) {
    $_SESSION['message'] = $message;
    header("Location: $location");
    exit();
}
?>
