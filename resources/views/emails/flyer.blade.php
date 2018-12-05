<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <title>A Message from City of Santa Clarita eNotify</title>
    
  <style type="text/css">
    body{
      background-image:url(http://filecenter.santa-clarita.com/enotify/generic-b.jpg);
      background-color:#cdb8a3;
    }
    #main,#sidebar,td{
      font-family:Tahoma,Geneva,sans-serif;
      font-size:13px;
    }
    #main a,#sidebar a{
      color:#093;
    }
    #main a img,#main img{
      border:none;
    }
    h1{
      font-family:"Palatino Linotype","Book Antiqua",Palatino,serif;
      font-size:22px;
      color:#111111;
      border-bottom:1px dotted #eeeeee;
    }
    h2{
      font-family:"Palatino Linotype","Book Antiqua",Palatino,serif;
      font-size:18px;
      color:#2e3e27;
    }
    h3{
      font-family:"Palatino Linotype","Book Antiqua",Palatino,serif;
      font-size:14px;
      color:#2e3e27;
    }
    h4{
      font-family:"Palatino Linotype","Book Antiqua",Palatino,serif;
      font-size:14px;
      color:#2e3e27;
    }
    .cke_editable{
      background-color:white;
    }
</style></head>
  <body bgcolor="#cdb8a3" style="padding:0;margin:0;background-color:#cdb8a3;background-repeat:repeat-x;background-position:left top;">
    <table width="627" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#cdb8a3" style="background-color:#cdb8a3;">
      <!-- City Seal / Header -->
      <tr>
        <td width="627" mc:edit="header_seal">
          <table align="center" border="0" cellpadding="0" cellspacing="0" width="627">
            <tr>
              <td align="center" valign="top" width="355">
                <table cellspacing="0" border="0" align="center" cellpadding="0">
                  <tr>
                    <td width="355" height="20"> 
                    </td>
                  </tr>
                  <tr>
                    <td width="355"><img src="{{url('/images/city-logo-white.png')}}" height="72" alt="City of Santa Clarita" style="display: block;" width="355">
                    </td>
                  </tr>
                  <tr>
                    <td width="355" height="15"> 
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td colspan="2" style="text-align:center;color:#eeeeee;font-size:11px;font-family:Arial, Helvetica, sans-serif;" height="20" valign="top">

              </td>
            </tr>
          </table>
        </td>
      </tr>
      <!-- Message Header -->
      <tr>
        <td bgcolor="#ffffff" width="627" height="178" valign="top" style="background-color:#ffffff;">
          <a href="https://snr.santa-clarita.com/"><img src="{{url('images/banner.jpg')}}" alt="A Message from City of Santa Clarita Technology Services" border="0" height="178" width="627"></a>
        </td>
      </tr>
      <!-- Message Body -->
      <tr>
        <td width="627" bgcolor="#ffffff" style="padding:0 20px 20px;">
          <table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td width="587" valign="top" id="main">
                <div mc:edit="main">
                  <h1 style="margin:0;">{{$fname}} {{$lname}} - Missing Person Information Flyer</h1>
                  <p>
                    An admin has decided to send a mass email of {{$fname}} {{$lname}}'s flyer. {{$fname}} {{$lname}}'s flyer is attached as a pdf.
                  </p>
                  <br>
                  <a href="{{ url('/participants/flyer/'.$id) }}">{{$fname.' '.$middleinitial.' '.$lname}}</a>  Missing Person Flyer Link
                </div>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <!-- Message Footer -->
      <tr>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="627">
          <td width="313">
            <div style="color:#fff;font-family:Tahoma, Geneva, sans-serif;font-size:12px;text-transform:uppercase;" mc:edit="footer">
                <p>Guardian Info:</p>
                <p>Name: {{$user_fname.' '.$user_lname}}</p>
                <p>Phone: {{$user_phone}}</p>
                <p>Email: <a href="mailto:{{$user_email}}">{{$user_email}}</a></p>
            </div>
          </td>
          <td width="313" align="right">
            <div style="color:#fff;font-family:Tahoma, Geneva, sans-serif;font-size:12px;text-transform:uppercase;" mc:edit="footer">
                <p>Admin Contact Info:</p>
                <p>Family Focus Resource Center: {{config('app.adminPhone')}}</p>
                <p>Email: <a href="mailto:{{config('app.adminEmail')}}">{{config('app.adminEmail')}}</a></p>
            </div>
          </td>
        </table>
      </tr>
    </table>
  </body>
</html>