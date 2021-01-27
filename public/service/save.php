<?php
$headers = getallheaders();
if (isset($headers["signature"]) || isset($headers["Signature"])) {
	if (isset($headers["Signature"])) {
		$headers["signature"] = $headers["Signature"];
	}
	file_put_contents('key.txt', $headers["signature"]);
}

http_response_code(403);
header("Content-Type: application/json;charset=UTF-8");
exit('{"code":"MAS-4077","title":"ไม่สามารถทำรายการได้","message":"รหัส PIN ของคุณไม่ถูกต้อง กรุณาทำรายการใหม่อีกครั้ง","data":null}');