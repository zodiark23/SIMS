<?php namespace SIMS\App\Models;

use SIMS\Classes\Model;
use SIMS\Classes\Database;


class RoleModel extends Model {

	public function __construct()
	{
		$this->db = new Database();
		$this->table = "roles";
	}

	/**
	 * Fetch all the right(s) of the logged in user.
	 */
	public function loadRights($role_id){

	    @session_start();
		$stmt = $this->db->prepare("SELECT r.rights_code FROM role_privilege rp LEFT JOIN rights r ON rp.rights_id=r.rights_id WHERE rp.role_id = $role_id");

		$stmt->execute();

		$result = $stmt->fetchAll();

		return $result;

	}

	/**
	 * Returns true if the logged in user have / has right(s) to that page.
	 */
	public function verifyRights($rights_code)
	{
		session_start();
		foreach ($_SESSION['userRights'] as $r) {
			if (in_array($rights_code, $r)) {
				return true;
			}
			return false;
		}
	}

	/**
	 * Returns the list of all role
	 */
    public function getRole(){
        $stmt = $this->db->prepare("SELECT * FROM roles WHERE role_id > 1 ORDER by role_name DESC");

        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;

    }

	/**
	 * Returns the list of all rights
	 */
    public function getRights(){

        $stmt = $this->db->prepare("SELECT * FROM rights WHERE rights_id > 1");

        $stmt->execute();

        $result = $stmt->fetchAll();

		return $result;

    }


	/**
	 * Enables checkboxes if it's enabled on the role
	 */
    public function setRights($role_id){

	    $stmt = $this->db->prepare("SELECT r.rights_code FROM role_privilege rp LEFT JOIN rights r ON rp.rights_id = r.rights_id WHERE rp.rights_id > 1 AND rp.role_id = :role_id");
		$stmt->execute([ "role_id" => $role_id]);

		$array2 = $stmt->fetchAll();

		$array_rights = [];

	    foreach ($array2 as $a){
		    array_push($array_rights,$a['rights_code']);
	    }

	    return $array_rights;
    }

	public function deleteRights($role_id){
		$stmt = $this->db->prepare("DELETE FROM role_privilege WHERE role_id=:role_id ");
		$stmt->execute([":role_id"=>$role_id]);

		if($stmt){
			return true;
		}

		return false;

	}


	/**
	 * Perform a delete
	 *
	 * Then insert all the new rights
	 *
	 *
	 */
    public function updateRights($role_id,$rights_id){

	    // Delete rights if the user submitted the form.

			$result = $this->deleteRights($role_id);


		    // Insert new rights if the user submitted the form.
		    if($result){

				foreach($rights_id as $rid){

					$stmt = $this->db->prepare("INSERT INTO role_privilege (privilege_id,role_id,rights_id) VALUES (null, :role_id, :rights_id)");
					$stmt->execute([":role_id"=>$role_id, ":rights_id"=>$rid]);

				}

				return true;
			}

		return false;

    }

    /*
     *  Add int $default parameter later (FOR CONFIRMATION)
     */
    public function addRole($role_name){

    	$stmt = $this->db->prepare("SELECT * FROM roles WHERE role_name = :role_name");
    	$stmt->execute([':role_name'=>$role_name,]);
    	$result = $stmt->fetchAll();
    	if($result){
    		return false;
	    }
    	$stmt = $this->db->prepare("INSERT INTO roles (role_id,role_name) VALUES (null,:role_name)");
    	$stmt->execute([':role_name'=>$role_name]);
    	if ($stmt){
    		return true;
	    }
	    return false;
    }

}
