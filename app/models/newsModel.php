<?php namespace SIMS\App\Models;

use SIMS\Classes\Model;
use SIMS\Classes\Database;

class NewsModel extends Model{

	public function __construct()
	{
		$this->db = new Database();
		$this->table = "news";
	}

	public function validatetinyMCE($formData){
		$formData = trim( stripslashes( htmlspecialchars( strip_tags( str_replace (array( '(', ')'), '', $formData)), ENT_QUOTES)));
		return $formData;
	}

	public function addNews($role_id,$title,$content){

		$stmt = $this->db->prepare("INSERT INTO news (news_id,news_title,news_author,create_date,news_content,news_publish) VALUES (null,:news_title,:news_author,CURRENT_TIMESTAMP,:news_content,0)");

		$stmt->execute([":news_title"=>$title,":news_author"=>$role_id,":news_content"=>$content]);

		if($stmt){
			return true;
		}
		return false;
	}

	public function displayNews(){
		$stmt = $this->db->prepare("SELECT news_content FROM news WHERE news_id = 9");
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;

	}

}