<?php
    function adminer_object() {
        // required to run any plugin
        include_once "./plugins/plugin.php";

        // autoloader
        foreach (glob("plugins/*.php") as $filename) {
            include_once "./$filename";
        }

        $plugins = array(
            // specify enabled plugins here
            new AdminerEditCalendar,
            new AdminerEditTextarea,
            new AdminerEnumOption,
            new AdminerEnumTypes,
            new AdminerJsonColumn,
            new AdminerSqlLog,
            new FasterTablesFilter,
            new AdminerColorfields,
            new AdminerCopy,
            new AdminerImportFromFolder("upload"),
            new AdminerDisplayForeignKeyName,
            new AdminerTablesHide,
            new hideableColumns,
            new AdminerTablesHistory,
            new AdminerDisableTables,
            new AdminerTableHeaderScroll,
            new AdminerSuggestTableField,
            new searchAutocomplete,
            new AdminerRestoreMenuScroll,
            new AdminerReadableDates,
            new AdminerDumpArray,
        );

        /* It is possible to combine customization and plugins:
        class AdminerCustomization extends AdminerPlugin {
        }
        return new AdminerCustomization($plugins);
        */

        return new AdminerPlugin($plugins);
    }

// include original Adminer or Adminer Editor
    include "./adminer.php";
?>
