<head>
	<meta http-equiv="CONTENT-TYPE" content="text/html; charset=UTF-8">
	<title>Список чеков</title>
</head>
<table style="page-break-before: always;" width="600" border="0" cellpadding="1" cellspacing="1">
<tr valign="TOP">
	<td align="left"><a href="exit.php">Выход</a>
	<td align="left"><a href="receipt_load.php">Загрузка</a>
</table>
<br/>
<?php
	include "../template/oft_table.php";
	include "../template/connect.php";
	
	oftTable::init('Чеки');
	oftTable::header(array('Время'
		,'totalSum','fiscalDriveNumber'
		,'kktRegId','user','operationType'
		,'shiftNumber', 'ecashTotalSum'
		,'retailPlaceAddress', 'userInn', 'taxationType'
		,'cashTotalSum', 'operator'
		,'receiptCode', 'fiscalSign'
		,'fiscalDocumentNumber', 'requestNumber'
		,'buyerAddress', 'senderAddress','addressToCheckFiscalSign'
		, 'nds18', 'nds10', 'ndsNo', 'login'
		));
	$stmt = $db->prepare(
		"SELECT r.id, DATE_FORMAT(r.dateTime, '%d-%m-%Y %H:%i:%s') dt
			, r.buyerAddress, r.totalSum, r.addressToCheckFiscalSign, r.fiscalDriveNumber
			, r.kktRegId, r.user, r.operationType
			, r.shiftNumber, r.ecashTotalSum, r.nds18
			, r.retailPlaceAddress, r.userInn, r.taxationType
			, r.cashTotalSum, r.operator, r.senderAddress
			, r.receiptCode, r.fiscalSign, r.nds10
			, r.fiscalDocumentNumber, r.requestNumber, r.ndsNo
			, u.login
		 FROM rcp_receipt r 
		    JOIN pr_users u on r.user_id = u.id
		 ORDER BY r.dateTime desc
		 ");
	$stmt->execute();
	while ($row = $stmt->fetch()) {
		oftTable::row(array('<a href=receipt.php?id='.$row['id'].'>'.$row['dt'].'</a>'
			, $row['totalSum'], $row['fiscalDriveNumber']
			, $row['kktRegId'], $row['user'], $row['operationType']
			, $row['shiftNumber'], $row['ecashTotalSum']
			, $row['retailPlaceAddress'], $row['userInn'], $row['taxationType']
			, $row['cashTotalSum'], $row['operator']
			, $row['receiptCode'], $row['fiscalSign']
			, $row['fiscalDocumentNumber'], $row['requestNumber']
			, $row['buyerAddress'], $row['senderAddress'], $row['addressToCheckFiscalSign']
			, $row['nds18'], $row['nds10'], $row['ndsNo'], $row['login']		
			));
	}
        
	oftTable::end();
?> 
</body>
</html>
