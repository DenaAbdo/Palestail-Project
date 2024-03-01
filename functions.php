<?php
function isFormEmpty($fields) {
    foreach ($fields as $field) {
        if (empty($_POST[$field])) {
            return true; // form is not complete
        }
    }
    return false; //form is complete
}
function processFormFields($fields) {
    $result = [];

    foreach ($fields as $field) {
        // Check if the field exists in $_POST
        if (isset($_POST[$field])) {
            // Sanitize the input using htmlspecialchars
            $result[$field] = htmlspecialchars($_POST[$field]);
            $_SESSION[$field] = htmlspecialchars($_POST[$field]);
            echo $_SESSION[$field];
        } else {
            // If the field is not set, set it to an empty string
            echo $result[$field]."is empty";
            //$result[$field] = '';
        }
    }
    return $result;
}
function processFormFields1($fields){
    $errors=[];
    foreach ($fields as $fieldName => $fieldData) {
        if ($fieldData['type'] === 'file') {
            $fieldValue =isset($_FILES[$fieldName])? $_FILES[$fieldName]: '';
        }
        else{
            $fieldValue = isset($_POST[$fieldName]) ? $_POST[$fieldName] : '';
        }

        if ($fieldData['required'] && empty($fieldValue)) {
            $errors[$fieldName] = "{$fieldData['label']} is required.";
           // echo "{$errors[$fieldName]} is required";
            //return true;
        } else {
            // Store the field value in the session
            $_SESSION[$fieldName] = $fieldValue;
        }
    }
    return $errors;
}
function generateForm($formFields, $errors) {
    foreach($formFields as $fieldName => $fieldType) {
        echo "<p>";
        echo "<label for='{$fieldName}' class='label'>{$fieldType['label']}:</label>";

        if ($fieldType['type'] === 'select') {
            // Handle <select> element
            echo "<select name='{$fieldName}' id='{$fieldName}' class='required'>";
            foreach ($fieldType['options'] as $optionValue => $optionLabel) {
                echo "<option value='{$optionValue}'";
                if (isset($_SESSION[$fieldName]) && $_SESSION[$fieldName] == $optionValue) {
                    echo " selected";
                }
                echo ">{$optionLabel}</option>";
            }
            echo "</select>";
        }else if($fieldType['type'] === 'file'){
            echo "<input type='{$fieldType['type']}' name='{$fieldName}' id='{$fieldName}' value='"; 
            echo isset($_FILES[$fieldName]) ? htmlspecialchars($_FILES[$fieldName]) : '';
            echo "' class='required'/>";
        }
        else {
            // Handle regular input fields
            echo "<input type='{$fieldType['type']}' name='{$fieldName}' id='{$fieldName}' value='"; 
            echo isset($_SESSION[$fieldName]) ? htmlspecialchars($_SESSION[$fieldName]) : '';
            echo "' class='required'/>";

            if (isset($errors[$fieldName])) {
                echo "<span style='color: red;'> {$errors[$fieldName]}</span>";
            }
        }

        echo "</p>";
    }
}
function bindParams($statement, $params) {
    foreach ($params as $paramName => $paramValue) {
        $statement->bindValue(':' . $paramName, $paramValue);
    }
}

?>