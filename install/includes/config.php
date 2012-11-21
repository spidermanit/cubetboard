<?php

class Config {

    /**
     * Checks the validity of the POST data
     * @param array $post, the base url and database server details
     * @return boolean True if valid, else false
     */
    function checkPostData($post) {

        if (!empty($post['base_url']) && !empty($post['db_host']) && !empty($post['db_user'])
                && !empty($post['db_password']) && !empty($post['db_name']) 
                && !empty($post['admin_username']) && !empty($post['admin_pass'])) {

            return true;
        } else {
            return false;
        }
    }

    /**
     * Writes the configuration details to the respective files
     * @param array $post, the base url and database server details
     * @return boolean true if success, else false
     */
    function writeConfig($post) {

        $dbTemplatePath = "config_templates/database.php";
        $dbConfigPath = "../application/config/database.php";

        $configTemplatePath = "config_templates/config.php";
        $configPath = "../application/config/config.php";

        $db_file_contents = file_get_contents($dbTemplatePath);
        $config_file_contents = file_get_contents($configTemplatePath);

        $db_new_content = str_replace("%HOSTNAME%", $post['db_host'], $db_file_contents);
        $db_new_content = str_replace("%USERNAME%", $post['db_user'], $db_new_content);
        $db_new_content = str_replace("%PASSWORD%", $post['db_password'], $db_new_content);
        $db_new_content = str_replace("%DATABASE%", $post['db_name'], $db_new_content);
        

        $config_new_content = str_replace("%BASEURL%", $post['base_url'], $config_file_contents);

        $dbFileHandle = fopen($dbConfigPath, "w+");
        $configFileHandle = fopen($configPath, "w+");

        // In case its not done manually
        @chmod($dbConfigPath, 0777);
        @chmod($configPath, 0777);

        if (is_writable($dbConfigPath) && is_writable($configPath)) {

            if (fwrite($dbFileHandle, $db_new_content)) {

                if (fwrite($configFileHandle, $config_new_content)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function createExtraction($baseUrl) {

        $extTemplateJsPath = 'config_templates/extractor.js';
        $extJsAppPath = "../application/scripts/extractor.js";

//        $extTemplateControllerPath = 'config_templates/extractor.php';
//        $extControllerAppPath = "../application/controllers/extractor.php";

//        $extTemplateViewPath = 'config_templates/extractor_view.php';
//        $extViewAppPath = "../application/views/extractor_view.php";

        $extractionJsContent = file_get_contents($extTemplateJsPath);
//        $extControllerContent = file_get_contents($extTemplateControllerPath);
//        $extViewContent = file_get_contents($extTemplateViewPath);

        $ext_new_content = str_replace("%BASEURL%", $baseUrl, $extractionJsContent);


        $extJsFileHandle = fopen($extJsAppPath, 'w+');
//        $extControllerFileHandle = fopen($extControllerAppPath, 'w+');
//        $extViewFileHandle = fopen($extViewAppPath, 'w+');
        

//        @chmod($extJsAppPath, 0777);
//        @chmod($extControllerAppPath, 0777);
//        @chmod($extViewAppPath, 0777);


        if (is_writable($extJsAppPath)) {

            if (fwrite($extJsFileHandle, $ext_new_content)) {

		return true;                

            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}

?>
