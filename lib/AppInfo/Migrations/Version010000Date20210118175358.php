<?php

declare(strict_types=1);

namespace OCA\ScienceMesh\Migration;

use Closure;
use Doctrine\DBAL\Schema\Schema;
use OCP\DB\ISchemaWrapper;
use OCP\Migration\IOutput;
use Doctrine\DBAL\Types\Types;
use OCP\Migration\ISchemaMigration;
use OCP\Migration\SimpleMigrationStep;

/**
 * Auto-generated migration step: Please modify to your needs!
 */
class Version010000Date20210118175358 implements ISchemaMigration {

	/**
	 * @param IOutput $output
	 * @param Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 */
	public function preSchemaChange(IOutput $output, Closure $schemaClosure, array $options) {
	}

	/**
	 * @param IOutput $output
	 * @param Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 */
	public function changeSchema(Schema $schema, array $options) {

        $prefix = $options['tablePrefix'];
		if (!$schema->hasTable("{$prefix}sciencemesh")) {
			$table = $schema->createTable("{$prefix}sciencemesh");
			$table->addColumn('apikey', 'string', [
				'notnull' => true,
			]);
			$table->addColumn('sitename', 'string', [
				'notnull' => true,
			]);
			$table->addColumn('siteurl', 'string', [
				'notnull' => true,
			]);
			$table->addColumn('siteid', 'string', [
				'notnull' => false,
			]);
			$table->addColumn('country', 'string', [
				'notnull' => true,
				'length' => 3,
			]);
			$table->addColumn('iopurl', 'string', [
				'notnull' => true,
			]);
			$table->addColumn('numusers', Types::BIGINT, [
				'notnull' => true,
				'default' => 0,
				'unsigned' => true,
			]);
			$table->addColumn('numfiles', Types::BIGINT, [
				'notnull' => true,
				'default' => 0,
				'unsigned' => true,
			]);
			$table->addColumn('numstorage', Types::BIGINT, [
				'notnull' => true,
				'default' => 0,
				'unsigned' => true,
			]);
		}
	}

	/**
	 * @param IOutput $output
	 * @param Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 */
	public function postSchemaChange(IOutput $output, Closure $schemaClosure, array $options) {
	}
}
