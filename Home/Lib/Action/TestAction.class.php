<?php

 class TestAction extends Action 
 {
     public function index()
     {
         $this->display();
 	 }


 	 public function edit()
 	 {  

 	 	echo $_POST['text'];

 	 }
 }


?>