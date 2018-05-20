function XmlHttp()
	{
		var xmlhttp;
		try 
			{
				xmlhttp	= new ActiveXObject("Msxml2.XMLHTTP");
			}
		catch(e)
			{
				try
					{
						xmlhttp	= new ActiveXObject("Microsoft.XMLHTTP");
					}
				catch (E)
					{
						xmlhttp	= false;
					}
			}
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
				xmlhttp = new XMLHttpRequest();
			}
		return xmlhttp;
	}
function ajax()
	{
		var PlayerWord = document.getElementById("PlayerWord").value;
		document.getElementById("history").innerHTML = document.getElementById("history").innerHTML+"\n Игрок: "+PlayerWord;
		if (window.XMLHttpRequest)
			{
				var req = XmlHttp();
				req.open("POST","get_ajax.php",true);
				req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				var send = 'PlayerWord='+PlayerWord;
				req.send(send);
				req.onreadystatechange = function()
											{
												if (req.readyState == 4 && req.status == 200) //если ответ положительный
													{
														document.getElementById("history").innerHTML = document.getElementById("history").innerHTML+"\n"+req.responseText;
													}
											}
			}
	}
