<?php namespace SIMS\App\Models;

use SIMS\Classes\Model;
use SIMS\Classes\Database;

class NewsModel extends Model
{

    public function __construct()
    {
        $this->db = new Database();
        $this->table = "news";
    }

    public function validatetinyMCE($formData)
    {
        $formData = htmlspecialchars($formData);
        return $formData;
    }

    public function addNews($role_id, $title, $content)
    {
        $stmt = $this->db->prepare("INSERT INTO news (news_id,news_title,news_author,create_date,last_updated,news_content,news_publish) VALUES (NULL,:news_title,:news_author,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,:news_content,0)");

        $stmt->execute([":news_title" => $title, ":news_author" => $role_id, ":news_content" => $content]);

        if ($stmt) {
            return true;
        }
        return false;
    }

    public function displayNews()
    {
        $stmt = $this->db->prepare("SELECT * FROM news LIMIT 10");
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;

    }

    public function getNews($news_id){
    	$stmt = $this->db->prepare("SELECT * FROM news WHERE news_id = :news_id");
    	$stmt->execute([":news_id"=>$news_id]);
    	$result = $stmt->fetchAll();
    	return $result;
    }

    public function setNews($news_id, $title, $content){
    	$stmt = $this->db->prepare("UPDATE `news` SET news_title = :news_title, news_content = :news_content, last_updated = CURRENT_TIMESTAMP WHERE news_id = :news_id");
    	$stmt->execute([":news_title"=>$title,
		    ":news_content"=>$content,
		    ":news_id"=>$news_id]);
    	if($stmt) {
		    return true;
	    }
	    return false;
    }

    public function deleteNews($news_id){
    	$stmt = $this->db->prepare("SELECT * FROM news WHERE news_id = :news_id");
    	$stmt->execute([":news_id"=>$news_id]);
    	$result = $stmt->fetchAll();
    	if($result){
    		$stmt = $this->db->prepare("DELETE FROM news WHERE news_id = :news_id");
    		$stmt->execute([":news_id"=>$news_id]);
    		if($stmt){
    			return true;
		    }
		    return false;
	    }
    }

    public function modalView($news_id){
    	$stmt = $this->db->prepare("SELECT news_title,news_content FROM news WHERE news_id = :news_id");
    	$stmt->execute([":news_id"=>$news_id]);
    	$result = $stmt->fetchAll();
    	return $result;
    }

	public function displayNewsIndex()
	{
		$stmt = $this->db->prepare("SELECT * FROM news ORDER BY create_date DESC LIMIT 5");
		$stmt->execute();
		$result = $stmt->fetchAll();

		return $result;

	}
}





