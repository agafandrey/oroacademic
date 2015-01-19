<?php

namespace OroCRM\Bundle\AccountBundle\Migrations\Schema\v1_0;

use Doctrine\DBAL\Schema\Schema;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class AcademicProjectBundle implements Migration
{
    /**
     * @inheritdoc
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        /** Generate table academic_project **/
        $table = $schema->createTable('academic_project');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('name', 'string', ['length' => 255, 'notnull' => false]);
        $table->addColumn('summary', 'text');
        $table->addColumn('owner_business_unit_id', 'integer', ['notnull' => false]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);

        $table->setPrimaryKey(['id']);
        /** End of generate table academic_project **/

        /** Generate table academic_issue_priority **/
        $table = $schema->createTable('academic_issue_priority');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('weight', 'integer', ['notnull' => false]);
        $table->addColumn('label', 'string', ['length' => 255, 'notnull' => false]);

        $table->setPrimaryKey(['id']);
        /** End of generate table academic_issue_priority **/

        /** Generate table academic_issue_resolution **/
        $table = $schema->createTable('academic_issue_resolution');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('resolution_code', 'string', ['length' => 255, 'notnull' => false]);
        $table->addColumn('label', 'string', ['length' => 255, 'notnull' => false]);

        $table->setPrimaryKey(['id']);
        /** End of generate table academic_issue_resolution **/

        /** Generate table academic_issue_status **/
        $table = $schema->createTable('academic_issue_status');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('status_code', 'string', ['length' => 255, 'notnull' => false]);
        $table->addColumn('label', 'string', ['length' => 255, 'notnull' => false]);

        $table->setPrimaryKey(['id']);
        /** End of generate table academic_issue_status **/
    }
}
