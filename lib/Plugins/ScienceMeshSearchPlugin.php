<?php

namespace OCA\ScienceMesh\Plugins;

use OC\User\User;
use OCP\IConfig;
use OCP\Share;
use OCP\IUserManager;
use OCP\IUserSession;
use OCA\ScienceMesh\RevaHttpClient;

class ScienceMeshSearchPlugin {
	protected $shareeEnumeration;
	/** @var IConfig */
	private $config;

	/** @var string */
	private $userId = '';

	public function __construct(IConfig $config, IUserManager $userManager, IUserSession $userSession) {
		$this->config = $config;
		$user = $userSession->getUser();
		if ($user !== null) {
			$this->userId = $user->getUID();
		}
		$this->shareeEnumeration = $this->config->getAppValue('core', 'shareapi_allow_share_dialog_user_enumeration', 'yes') === 'yes';
		$this->revaHttpClient = new RevaHttpClient($this->config);
	}

	public function search($search, $limit, $offset) {
		$result = json_decode($this->revaHttpClient->findAcceptedUsers($this->userId), true);
		if (!isset($result['accepted_users'])) {
			return [];
		}
		$users = $result['accepted_users'];
        error_log("Found " . count($users) . " users");
		// $users = array_filter($users, function ($user) use ($search) {
		// 	return (stripos($user['display_name'], $search) !== false);
		// });
		$users = array_slice($users, $offset, $limit);

		$result = [];
		foreach ($users as $user) {
			$serverUrl = parse_url($user['id']['idp']);
			$domain = $serverUrl["host"];
			$result[] = [
				'label' => $user['display_name'] ." (". $domain . ")",
				'value' => [
					'shareType' => Share::SHARE_TYPE_REMOTE,
					'shareWith' => $user['id']['opaque_id'] ."@". $user['id']['idp'],
				],
			
				// "label" => "Label",
				// "uuid" => $user['id']['opaque_id'],
				// "name" => $user['display_name'] ."@". $domain, // FIXME: should this be just the part before the @ sign?
				// "type" => "ScienceMesh",
				// "value" => [
				// 	"shareType" =>  \OCP\Share::SHARE_TYPE_REMOTE,
				// 	"shareWith" => $user['id']['opaque_id'] ."@". $domain, // FIXME: should this be just the part before the @ sign?
				// 	"server" => $user['id']['idp']
				// ]
			];
		}
		error_log("returning result:");
		error_log(var_export($result, true));
		return $result;
	}
}
