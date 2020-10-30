<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UploadFileClass_model extends CI_Model {
	protected $upload_config;

	
	private $file_img_default = array('jpeg','jpg','png','gif');
	private $mime_types_default = array('image/jpeg', 'image/jpg', 'image/png','image/gif');
	private $max_filesize = 200000;
	private $min_filesize = 100;
	private $max_file_age = 300; // 1*5*60 hours * minutes * seconds : Temp file age in seconds
	
	private $arr_file_types = null;
	private $filename_sanitized = null;
	private $filename_original = null;
	private $name_of_file = null;
	private $file_name = null;
	private $upload_path_real = null;
	
	public function __construct()
	{
		parent::__construct();
		// $_file = array_keys($_FILES)[0];
		// $this->files = $_FILES[$_file];
		$this->cleanupTargetDir = true;
		$this->load->config('upload_data_array');
		$this->mime_type_arr = $this->config->item("mime_type_arr");
		$this->extention_type_arr = $this->config->item("extention_type_arr");
	}
	public function init( $upload_config )
	{
		$this->arr_file_types = explode('|',$upload_config['allowed_types']);
		$this->setMaxFilesize($upload_config['max_size']);
		$this->upload_path = $upload_config['upload_path_temp'];
		$this->upload_path_real = $upload_config['upload_path_real'];
		$this->file_name = $upload_config['file_name'];
		
		//$this->setFileTypes();
		//$this->setMimeTypes();
/* 		var_dump($this->file_types);
		echo "<hr>";
		var_dump($this->mime_types); */
	}
	
	public function setMaxFilesize($maxFilesize)
	{
		$this->max_filesize = $maxFilesize;
		return $this;
	}       
	public function setCleanupTargetDir($cleanup=false)
	{
		$this->cleanupTargetDir = $cleanup;
		return $this;
	}
	public function setMinFilesize($minFilesize)
	{
		$this->min_filesize = $minFilesize;
		return $this;
	}
	public function setFileTypes()
	{
		if(count($this->arr_file_types) > 0){ 
			foreach($this->arr_file_types as $arr){
				$arrTypes[] = $this->extention_type_arr[$arr];
			}
		}else{
			$arrTypes = $file_img_default;
		}
		$this->file_types = $arrTypes;
		return $this;
	}
	
	public function setMimeTypes()
	{
		if(count($this->arr_file_types) > 0){ 
			foreach($this->arr_file_types as $arr){
				$arrMime[] = $this->mime_type_arr[$arr];
			}
		}else{
			$arrMime = $mime_types_default;
		}
		$this->mime_types = $arrMime;
		return $this;
	}
	
	public function setUploadPath($uploadpath)
	{
		$this->upload_path = $uploadpath;
		return $this;
	}
	
	public function fileSize()
	{
		return $this->files['size'];
	}
	
	public function setFileNameOriginal($filename)
	{
		$this->filename_original = $filename;
	}
	//=========================end set param========
	public function fileNameOriginal()
	{
		return $this->filename_original;
	}
	public function getOpenTempDirectory()
	{
		if (!is_dir($this->upload_path) || !$dir = opendir($this->upload_path)) {
			throw new Exception('Failed to open temp directory.',2);
		}
		return $dir;
	}
	public function getCleanupTargetDir()
	{
		$dir = $this->getOpenTempDirectory();
		while (($file = readdir($dir)) !== false) {
			$tmpfilePath = $this->upload_path . DIRECTORY_SEPARATOR . $file;

			// If temp file is current file proceed to the next
			if ($tmpfilePath == "{$this->path_of_file}.part") {
				continue;
			}

			// Remove temp file if it is older than the max age and is not the current file
			if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $this->max_file_age)) {
				//echo $tmpfilePath."<=unlink=<br>";
				@unlink($tmpfilePath);
			}
		}
	 closedir($dir);
		return $this;
	}
	public function getFileProperty()
	{
		$this->setFileTypes();
		$this->setMimeTypes();
		$file_info = pathinfo($this->files['name']);
		$ext_file = $file_info["extension"];
		$arr_file = explode(".".$ext_file,$file_info["basename"]);
		$this->name_of_file = $arr_file[0];
		$this->extension_of_file = strtolower($file_info['extension']);
		$this->size_of_file = $this->fileSize();  
		$safe_filename = preg_replace(
				array("/\s+/", "/[^-\.\w]+/"),
				array("_", ""),
				trim($this->fileNameOriginal()));
		$this->filename_sanitized  = md5($safe_filename.time()).$safe_filename;
	   $this->path_of_file = $this->upload_path . "/" . $this->filename_sanitized;   //$filePath = $targetDir . "/" . $fileName;
		 return $this;
	}
	//open output stream
	public function getOpenOutputStream()
	{
		if (!$out = @fopen("{$this->path_of_file}.part", "ab")) {
			throw new Exception("Failed to open output stream",3);
		}
		$this->output_stream = $out;
	}
	public function getOpenInputStream()
	{
		// Read binary input stream and append it to temp file
		if (!$in = @fopen($this->files['tmp_name'], "rb")) {
			throw new Exception("Failed to open input stream",4);
		}
		$this->input_stream = $in;
	}
	
	public function extensionValid() 
	{
		//Check file has the right extension    
		if (!in_array($this->extension_of_file, $this->file_types)) //{
			throw new Exception("Invalid file Extension",5);
		//}
	}
	
	public function mimeTypeValid()
	{
		//Check file has the right extension    
		if (!in_array($this->files['type'], $this->mime_types)) {
			throw new Exception("Invalid file Extension",6);
		}
	}
	public function filesizeValid()
	{
		//Check that the file is not too big
		if ($this->files['size'] > $this->max_filesize) {
			throw new Exception("File is too big",7);
		}

		//Check that the file is not too less
		if ($this->files['size'] < $this->min_filesize) {
		  throw new Exception("File is too less than",8);
		}
	
	}
	
	public function uploadAttackValid()
	{
		//Check html form tags
		$handle = fopen($this->files['tmp_name'], "rb"); 
		$contents = stream_get_contents($handle);
		fclose($handle);
		
		if(preg_match_all( '/<\?php(.+?)eval\((.+?)?>/is', $contents, $matches )){
			throw new Exception("Please upload file again",9);
		}

		if(preg_match_all( '/<\?php(.+?)<form.*?>(.+?)<\/form>(.+?)?>/is', $contents, $matches)){
			throw new Exception("Please upload file again",10);
		}

		if(preg_match_all( '/<\?php(.+?)?>/is', $contents, $matches)){
			throw new Exception("Please upload file again",11);
		}
		
		if(preg_match_all('/^.*\.(php|exe)$/i',$this->name_of_file,$exts)){
			throw new Exception("Please upload file again",12);
		}
	}
			
	public function saveUploadedFile()
	{
		while ($buff = fread($this->input_stream, 4096)) {
			fwrite($this->output_stream, $buff);
		}
		 @fclose($this->output_stream);
		 @fclose($this->input_stream);
		// Strip the temp .part suffix off 
		rename("{$this->path_of_file}.part", $this->path_of_file);
		
		return $this;
	}
	
	public function isValidateFile()
	{
		$this->getFileProperty();
		if($this->cleanupTargetDir) $this->getCleanupTargetDir();
		$this->getOpenOutputStream();
		$this->getOpenInputStream();
		$this->extensionValid();
		$this->mimeTypeValid();
		$this->filesizeValid();
		$this->uploadAttackValid();
		
		return $this;
	}
	
	public function isUploadedFile()
	{
		$this->setFileNameOriginal($this->files['name']);
		if($this->files["error"] || !is_uploaded_file($this->files['tmp_name']))
		{
			throw new Exception("Failed to move uploaded file",1);
		}
	}
	public function uploadFile($_file)
	{
		
		$this->files = $_FILES[$_file];
		$this->isUploadedFile(); 
		if ($this->isValidateFile())
		{
			$this->saveUploadedFile();
		}
	   
		return $this;
	}
	
	public function optimizeFile()
	{
		$this->load->library('image_lib');
		$new_file = $this->upload_path_real.'/'.$this->file_name.'.'.$this->extension_of_file; 
 		if (in_array($this->extension_of_file, $this->file_img_default)) {
			$image_arr['image_library'] = 'gd2';
			$image_arr['source_image'] = $this->path_of_file; 
			$image_arr['new_image'] = $new_file;
			$image_arr['maintain_ratio'] = TRUE;
			$image_arr['width']         = 800;
			
			$this->image_lib->initialize($image_arr);
			if ( ! $this->image_lib->resize()){
				$this->out_put_file = false;
			   // return array('errors' => $this->image_lib->display_errors());
			}
			$this->image_lib->clear();
			$this->out_put_file = $new_file;
			# unlink($image_arr['source_image']);
		}else{
			rename($this->path_of_file,$new_file);
			if(!rename($this->path_of_file,$new_file)){
				unlink($this->path_of_file);
				$this->out_put_file = $new_file;
			}
		} 
		return $this->out_put_file;
	}
}
