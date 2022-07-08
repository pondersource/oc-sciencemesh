<?php

namespace OCA\ScienceMesh\Migration;

use Closure;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use OCP\IDBConnection;
use OCP\Migration\IOutput;
use OCP\Migration\ISchemaMigration;


class Version0001Date20211201101630 implements ISchemaMigration {

	/** @var IDBConnection */

	public function __construct(IDBConnection $connection) {
		$this->connection = $connection;
	}

	public function changeSchema(Schema $schema, array $options) {

        $prefix = $options['tablePrefix'];

        $shares = $schema->createTable("{$prefix}sciencemesh_shares");
		$users = $schema->createTable("{$prefix}sciencemesh_users");
		$shares->addColumn(
			'opaque_id',
			Types::STRING,
			['notnull' => true]
		);
		$shares->addColumn(
			'resource_id',
			Types::STRING,
			['notnull' => true]
		);
		$shares->addColumn(
			'permissions',
			Types::INTEGER,
			[]
		);
		$shares->addColumn(
			'grantee',
			Types::INTEGER,
			[]
		);
		$shares->addColumn(
			'owner',
			Types::INTEGER,
			[]
		);
		$shares->addColumn(
			'creator',
			Types::INTEGER,
			[]
		);
		$shares->addColumn(
			'ctime',
			Types::INTEGER,
			['notnull' => true]
		);
		$shares->addColumn(
			'mtime',
			Types::INTEGER,
			['notnull' => true]
		);
		$shares->addColumn(
			'is_external',
			Types::BOOLEAN,
			['notnull' => false]
		);
		$shares->addColumn(
			'foreign_id',
			Types::INTEGER,
			[]
		);
		$shares->setPrimaryKey(['opaque_id']);
		$users->addColumn(
			'id',
			Types::INTEGER,
			['notnull' => true, 'autoincrement' => true, 'unsigned' => true]
		);
		$users->addColumn(
			'idp',
			Types::STRING,
			['notnull' => true]
		);
		$users->addColumn(
			'opaque_id',
			Types::STRING,
			['notnull' => true]
		);
		$users->addColumn(
			'type',
			Types::INTEGER,
			[]
		);
		$users->setPrimaryKey(['id']);
	}
}
