<!--?php
  /* Email Detials */  
  $mail_to = "kotoezhikne@gmail.com"; //receipient address  //Проверять получение на $mail_to писем перед сдачей
  $from_name = "Digital-city"; //sender name                //Проверять куда приходят письма на $mail_to (основное/спам)
  $from_mail = "info@digital-city.ru"; //sender address     //Проверять email на блокировку почтовыми сервисами
  $reply_to = "digital-city.ru"; //reply-to address
  $subject = 'Новое сообщение с сайта digital-city.ru'; //email subject
  $message = ""; //email content

  /* POST data */
  $msg_name = htmlspecialchars($_POST['name']); //input - name
  $msg_phone = htmlspecialchars($_POST["phone"]); //input - phone
  $msg_email = htmlspecialchars($_POST['email']); //input - email
  $msg_message = htmlspecialchars($_POST['message']); //textarea - message

  /* File parameters */
  $max_filesize = isset($_POST['filesize']) ? $_POST['filesize'] * 1024 : 1024000;
   
  $file_name = $_FILES['file']['name'];
  $file_name = iconv ('utf-8', 'windows-1251', $file_name);
  $temp_name = $_FILES['file']['tmp_name'];
  $file_type = $_FILES['file']['type'];
  $file_status = "";

  if(!empty($_FILES) && $_FILES['file']['error'] == 0){ // Проверяем, загрузил ли пользователь файл
    $destiation_dir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/$file_name"; // Директория для размещения файла
    /*$destiation_dir = dirname(__FILE__) .'/'.$_FILES['filefield']['name']; // Директория для размещения файла*/
    move_uploaded_file($_FILES['file']['tmp_name'], $destiation_dir ); // Перемещаем файл в желаемую директорию    
    $file_status = " Файл успешно загружен!"; // Оповещаем пользователя об успешной загрузке файла
//    $file_status = var_dump((bool) isset($_FILES));
  } else{
    if(!empty($_FILES)) {
      $file_status = " Ошибка загрузки файла!"; // Оповещаем пользователя о том, что файл не был загружен
    }
  }

/*if(empty($_FILES)) {
  $file_status = 'empty';
}*/

  $boundary = md5(uniqid(time()));

  /* Mail header */
  $headers  = 'MIME-Version: 1.0' . PHP_EOL;
//  $headers .= "Content-type: text/html; charset=windows-1251" . PHP_EOL;
  $headers .= "Content-type: text/html; charset=utg-8" . PHP_EOL;
  $headers .= "From: $from_name <$from_mail>" . PHP_EOL;
  $headers .= "Reply-To: $reply_to <$from_mail>" . PHP_EOL;  
  $headers .= 'X-Mailer: PHP/' . phpversion() . PHP_EOL;


  $message = PHP_EOL . "Имя: <strong>" . $msg_name . PHP_EOL . "</strong><br>Контактный телефон: <strong>" . $msg_phone . PHP_EOL . "</strong><br>E-mail: <strong>" . $msg_email . PHP_EOL . "</strong><br>Сообщение: <strong>" . $msg_message . "</strong>" . PHP_EOL;

  if(mail($mail_to, iconv ('utf-8', 'windows-1251', $subject), iconv ('utf-8', 'windows-1251', $message), iconv ('utf-8', 'windows-1251', $headers))) {    
    echo "<div class='notification notification_ok'><span>Спасибо за обращение!</span> В ближайшее время менеджер ответит Вам.$file_status</div>";    
  } else {
    echo "<div class='notification notification_err'><span>Отправка формы не удалась!</span> Попробуйте ещё раз или свяжитесь с нами по телефону.</div>";
  }

  echo $_SERVER['DOCUMENT_ROOT'] . "/uploads/$file_name" . '<br>';
  echo $_FILES['file']['name'] . '<br>';
  echo $_FILES['file']['tmp_name'] . '<br>';
  echo 'type = ' . $_FILES['file']['type'];
  

?-->


<?php
	    if ( 0 < $_FILES['file']['error'] ) {
	        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
	    }
	    else {
	        move_uploaded_file($_FILES['file']['tmp_name'], "$_SERVER['DOCUMENT_ROOT'] . '/uploads/'" . $_FILES['file']['name']);
	    }
      echo "Document root:" . $_SERVER['DOCUMENT_ROOT']  . "/uploads/";
	?>