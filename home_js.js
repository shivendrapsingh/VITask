/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

			function pop(div1) {
				document.getElementById(div1).style.display = 'block';
			}
			function hide(div1,div2,div3) {
				document.getElementById(div1).style.display = 'none';
                                document.getElementById(div2).style.display = 'none';
                                document.getElementById(div3).style.display = 'none';
			}
			//To detect escape button
			document.onkeydown = function(evt) {
				evt = evt || window.event;
				if (evt.keyCode == 27) {
					hide('popup','popdiv','popin');
				}
			};
                        