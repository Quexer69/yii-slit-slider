
<?php

/**
 * Created with https://github.com/schmunk42/database-command
 */

class m130810_022151_init_slitSlider_tables extends CDbMigration {

	public function safeUp() {
        if (Yii::app()->db->schema instanceof CMysqlSchema) {
           $options = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';
        } else {
           $options = '';
        }

        // Schema for table 'slider_slit'
        $this->createTable("slider_slit", 
            array(
            "id"=>"int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
            "status"=>"enum('hidden','published') NOT NULL",
            "language"=>"varchar(8) NOT NULL",
            "type"=>"enum('html','image') NOT NULL",
            "headline"=>"varchar(255)",
            "subline"=>"varchar(255)",
            "link"=>"varchar(255)",
            "bodyHtml"=>"text",
            "keywords"=>"varchar(255)",
            "media_id"=>"int(11)",
            "page_name"=>"varchar(255)",
            "rank"=>"int(11) NOT NULL",
            "custom_attributes"=>"varchar(255)",
            "start_date"=>"date",
            "end_date"=>"date",
            "created_at"=>"timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'",
            "created_by"=>"int(11) NOT NULL",
            "updated_at"=>"timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'",
            "updated_by"=>"int(11) NOT NULL",
            ), 
        $options);

	}

	public function safeDown() {
		echo 'Migration down not supported.';
	}

}

?>
