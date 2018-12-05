<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title>Clear</title>
	<link rel="stylesheet" href="{{asset('css/foundation-emails.css')}}" />
	<style>
      .header {
        background: #8a8a8a;
      }
      
      .header .columns {
        padding-bottom: 0;
      }
      
      .header p {
        color: #fff;
        margin-bottom: 0;
      }
      
      .header .wrapper-inner {
        padding: 20px;
        /*controls the height of the header*/
      }
      
      .header .container {
        background: #8a8a8a;
      }
      
      .wrapper.secondary {
        background: #f3f3f3;
      }
    </style>
</head>

<body>
	@yield('content')
</body>
</html>
