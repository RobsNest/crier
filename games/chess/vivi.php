<?
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head> 
	<link rel="stylesheet" type="text/css" id="stylesheet" href="../games/css/main.css" />
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="js/jquery-ui-1.8.24.custom.min.js"></script> 
    <script type="text/javascript" src="js/garbochess.js"></script>
	<script type="text/javascript" src="js/boardui.js"></script>
	<script type="text/javascript">
	    $(document).ready(function () {
	        g_timeout = 1000;
	        UINewGame();
	    });
    </script> 
      <style type="text/css">
          #FenTextBox {
              width: 400px;
          }
          #TimePerMove {
              width: 50px;
          }
          .no-highlight {
            -webkit-tap-highlight-color: rgba(0,0,0,0);
          }
          .sprite-bishop_black{ background-position: 0 0; width: 45px; height: 45px; } 
          .sprite-bishop_white{ background-position: 0 -95px; width: 45px; height: 45px; } 
          .sprite-king_black{ background-position: 0 -190px; width: 45px; height: 45px; } 
          .sprite-king_white{ background-position: 0 -285px; width: 45px; height: 45px; } 
          .sprite-knight_black{ background-position: 0 -380px; width: 45px; height: 45px; } 
          .sprite-knight_white{ background-position: 0 -475px; width: 45px; height: 45px; } 
          .sprite-pawn_black{ background-position: 0 -570px; width: 45px; height: 45px; } 
          .sprite-pawn_white{ background-position: 0 -665px; width: 45px; height: 45px; } 
          .sprite-queen_black{ background-position: 0 -760px; width: 45px; height: 45px; } 
          .sprite-queen_white{ background-position: 0 -855px; width: 45px; height: 45px; } 
          .sprite-rook_black{ background-position: 0 -950px; width: 45px; height: 45px; } 
          .sprite-rook_white{ background-position: 0 -1045px; width: 45px; height: 45px; }
      </style>
  </head> 
<body text="#FFFFFF" topmargin="0">
    <div align="center">
        <div><input type="hidden" id="TimePerMove" value="3000" onchange="javascript:UIChangeTimePerMove()" /></div>
        <div style="margin-top:5px;">
        <div id='board'></div> 
	   <span id='output'></span> 
	   <input type="hidden" id='PgnTextBox'>
	   <div><a id='AnalysisToggleLink' href="javascript:UIAnalyzeToggle()"></a></div>
	   <input type="hidden" id='FenTextBox' onchange="javascript:UIChangeFEN()"/>
	   </div><div></div>
     </div> 
</body> 
</html> 
