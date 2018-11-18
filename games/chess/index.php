<?
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head> 
    <title>Chess</title> 
	<link rel="icon" type="image/ico" href="../images/chess-1.png" />
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
<style type="text/css">
body
{
background-image:url('img/KingKnight-grand.png');
background-attachment:fixed;
background-repeat:no-repeat;
background-position:bottom left;
}
div#header{
top: 0;
left: 0;
width: 100%;
height: 3cm;
}
@media screen{
	body>div#header{
	position: fixed;
	}
}
* html div#content{
    height: 100%;
    overflow: auto;
}
</style>
  </head> 
  <body bgcolor="#000000" link="#000000" vlink="#000000"> 
    <div align="center">
        <div>
            <a href="javascript:UINewGame()">New game</a>
            <!--<select onchange="javascript:UIChangeStartPlayer()">
                <option value="white">White</option>
                <option value="black">Black</option>
            </select>-->
            Time per move: <input type="hidden" id="TimePerMove" value="3000" onchange="javascript:UIChangeTimePerMove()" />ms
            <a href="javascript:UIUndoMove()">Undo</a>
        </div>
        <div style="margin-top:5px;">
        <div id='board'></div> 
      
	   <span id='output'></span><br/> 
	   
	   <input type="hidden" id='PgnTextBox'>

	   <div>
            <a id='AnalysisToggleLink' href="javascript:UIAnalyzeToggle()">Analysis: Off</a>
        </div>

	   FEN: <input type="hidden" id='FenTextBox' onchange="javascript:UIChangeFEN()"/>
	   
	   </div>
        <div>
	</div>
     </div> 
<div id="bottom">
<a href="https://robsnest.net"><img src="../weather/robsnestOn.png" onmouseover="this.src='../weather/robsnest.png'" onmouseout="this.src='../weather/robsnestOn.png'"  border="0"></a>
</div>
</body> 
</html> 
