<?php

/**
 * Created with https://github.com/schmunk42/database-command
 */

class m130820_180117_update_slitSlider_tables extends CDbMigration
{

    public function safeUp()
    {
        if (Yii::app()->db->schema instanceof CMysqlSchema) {
            $options = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';
        } else {
            $options = '';
        }


        // Schema for table 'slider_slit'
        $this->createTable(
            "slider_slit_130819",
            array(
                 "id"                   => "int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
                 "status"               => "enum('hidden','published') NOT NULL",
                 "language"             => "varchar(8) NOT NULL",
                 "type"                 => "enum('html','image') NOT NULL",
                 "headline"             => "varchar(255)",
                 "subline"              => "varchar(255)",
                 "link"                 => "varchar(255)",
                 "body_html"             => "text",
                 "media_id"             => "int(11)",
                 "image_preset"         => "varchar(255)",
                 "group_id"             => "varchar(60)",
                 "rank"                 => "int(11) NOT NULL",
                 "data_orientation"     => "enum('horizontal','vertical')",
                 "data_slice1_rotation" => "varchar(5)",
                 "data_slice2_rotation" => "varchar(5)",
                 "data_slice1_scale"    => "varchar(5)",
                 "data_slice2_scale"    => "varchar(5)",
                 "start_date"           => "date",
                 "end_date"             => "date",
                 "created_at"           => "timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'",
                 "created_by"           => "int(11) NOT NULL",
                 "updated_at"           => "timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'",
                 "updated_by"           => "int(11) NOT NULL",
            ),
            $options
        );

        $sqlStatement = "SELECT * FROM slider_slit";
        $command      = $this->dbConnection->createCommand($sqlStatement);
        $command->execute(); // a non-query SQL statement execution
        // or execute an SQL query and fetch the result set
        $reader = $command->query();

        foreach ($reader AS $row) {
            $this->insert(
                'slider_slit_130819',
                array(
                     "id"                   => $row['id'],
                     "status"               => $row['status'],
                     "language"             => $row['language'],
                     "type"                 => $row['type'],
                     "headline"             => $row['headline'],
                     "subline"              => $row['subline'],
                     "link"                 => $row['link'],
                     "body_html"            => $row['bodyHtml'],
                     "media_id"             => $row['media_id'],
                     "image_preset"         => $row['image_preset'],
                     "group_id"             => $row['group_id'],
                     "rank"                 => $row['rank'],
                     "data_orientation"     => $row['data_orientation'],
                     "data_slice1_rotation" => $row['data_slice1_rotation'],
                     "data_slice2_rotation" => $row['data_slice2_rotation'],
                     "data_slice1_scale"    => $row['data_slice1_scale'],
                     "data_slice2_scale"    => $row['data_slice2_scale'],
                     "start_date"           => $row['start_date'],
                     "end_date"             => $row['end_date'],
                     "created_at"           => $row['created_at'],
                     "created_by"           => $row['created_by'],
                     "updated_at"           => $row['updated_at'],
                     "updated_by"           => $row['updated_by'],
                )
            );
        }

        $this->dropTable('slider_slit');
        $this->renameTable('slider_slit_130819','slider_slit');

    }

    public function safeDown()
    {
        echo 'Migration down not supported.';
    }

}

?>
