$(document).ready(function(){navigator.userAgent.indexOf("Mac")>0&&$("body").addClass("mac-os"),$(".inactive-badge").hover(function(){$(this).attr("src","/img/badges/"+$(this).data("badge")+"-active.png")},function(){$(this).attr("src","/img/badges/"+$(this).data("badge")+"-inactive.png")}),$(".knob").knob({readOnly:!0,draw:function(){if("tron"==this.$.data("skin")){var t=this.angle(this.cv),i=this.startAngle,s=this.startAngle,h,e=s+t,a=!0;return this.g.lineWidth=this.lineWidth,this.o.cursor&&(s=e-.3)&&(e+=.3),this.o.displayPrevious&&(h=this.startAngle+this.angle(this.value),this.o.cursor&&(i=h-.3)&&(h+=.3),this.g.beginPath(),this.g.strokeStyle=this.previousColor,this.g.arc(this.xy,this.xy,this.radius-this.lineWidth,i,h,!1),this.g.stroke()),this.g.beginPath(),this.g.strokeStyle=a?this.o.fgColor:this.fgColor,this.g.arc(this.xy,this.xy,this.radius-this.lineWidth,s,e,!1),this.g.stroke(),this.g.lineWidth=2,this.g.beginPath(),this.g.strokeStyle=this.o.fgColor,this.g.arc(this.xy,this.xy,this.radius-this.lineWidth+1+2*this.lineWidth/3,0,2*Math.PI,!1),this.g.stroke(),!1}}}),$(window).on("resize",function(){$(window).width()>480})});