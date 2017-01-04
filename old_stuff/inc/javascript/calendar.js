/***********************************************************************************

		Prima JS-Kalender von doktormolle :P
		(c)2003 doktormolle@compuserve.de
		Kompatibilitaet:
		---------------------------
		Aktueller Monat + Termin aktueller Tag:	alle Browser

		Sonstiges:				IE5+
							Mozilla
							Netscape7+
							Opera7+
							....und wer sonst noch was mit innerHTML anfangen kann


		***************************************************************************************/

//Falls das Outfit nicht gefaellt, ist hier die Chance, dies abzustellen.
//Tabelle
	cTable	=' style="background-color:#515151;font:12px Verdana,Geneva,Arial,Sans-Serif;"';
//Tabellenkopf
	cHeader	=' style="background-color:#626262;color:gold;" ';
//Woche...
	cWeek	=' style="color:#ffffff;background-color:#818181;"';
//Tag Normal
	cDay	=' align="right"style="color:#000000;background-color:#dfdfdf;"';
//Aktueller Tag
	cDayThis	=' align="right"style="color:firebrick;font-weight:bold;background-color:#ffffff;border:1px solid firebrick;"';
//Kein Tag
	cDayNo	=' style="color:#000000;background-color:#a1a1a1;"';
//Tag mit Termineintrag(betrifft nur Text, Zellenformat wird vererbt)
	cDayClick=' style="text-decoration:underline;cursor:pointer;"';
	if(document.all){cDayClick=' style="text-decoration:underline;cursor:hand;"';}
//Wochenende
	cDayWE	=' align="right"style="color:#000000;background-color:#c1c1c1;"';
//Termin
	cInfo	=' style="color:#000000;font-size:10px;background-color:#f0f0f0;"';

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Lets Go
iX=false;
if(document.getElementsByTagName&&document.getElementsByTagName('script')[0].innerHTML!='undefined'){iX=true;}
mS=new Array('Januar','Februar','M&auml;rz','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember');

wdS=new Array('Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag');
wD=new Array(0,1,2,3,4,5,-1);
now=new Date();
thisDay=new Date();
var toMonth=thisDay.getMonth();
var toDay=thisDay.getDate();


function makeCalendar(m,y,sD)
{
yyN=y;NN=true;mmN=m+1;
yyP=y;PP=false;mmP=m-1;

if(m==11){yyN=y+1;mmN=0;}
if(m==0&&y>0){yyP=y-1;mmP=11;}
if(y>0||m>0){PP=true;}
now.setDate(1);
now.setMonth(m);
now.setFullYear(y);
mLength=new Array(31,28,31,30,31,30,31,31,30,31,30,31);
if(y % 4==0){mLength[1]=29;if(y % 100==0){mLength[1]=28;}if(y % 400==0){mLength[1]=29;}}
mStart=now.getDay();
prev_='&nbsp;';if(PP&&iX){prev_='<b style="cursor:w-resize;"title="'+mS[m-1]+'"onclick="switchCalendar('+mmP+','+yyP+',false);">&lt;&lt;</b>';}
next_='&nbsp;';if(NN&&iX){next_='<b style="cursor:e-resize;"title="'+mS[m+1]+'"onclick="switchCalendar('+mmN+','+yyN+',false);">&gt;&gt;</b>';}
htm='<table'+cTable+'border="0"cellspacing="1"cellpadding="1"width="220"><tr><td colspan="8"><table width="100%"cellpadding="0"cellspacing="0"border="0"><tr><td align="left"'+cHeader+'><b'+cHeader+'>'+prev_+'</b></td><td align="center"'+cHeader+'><b'+cHeader+'>'+mS[m]+'&nbsp;'+y+'</b></td><td align="right"'+cHeader+'><b'+cHeader+'>'+next_+'</b></td></tr></table></td></tr>';
initR=false;
stopR=false;
mDay='&nbsp;';
for(r=0;r<6;++r)
	{
	if(stopR){break;}
	htm+='<tr><td nowrap="nowrap"'+cWeek+'>'+eval(r+1)+'.Woche</td>';
	for(xD=0;xD<7;++xD)
		{
		if(!initR&&(wD[xD]==mStart-1))
			{
			mDay=0;initR=true;
			}
			if(!stopR&&initR)
				{
				mDay++;
				if(mDay>mLength[m]){mDay='&nbsp;';}
				if(mDay==mLength[m]){stopR=true;}
				}
			else{mDay='&nbsp;';}
		mDayX=mDay;
		sClick='';
		if(iX){sClick='onclick="showData('+mDay+','+eval(m+1)+','+y+');"'}
		if(iX&&mDay!='&nbsp;'&&(jedesJahr[mDay+'_'+eval(m+1)]||diesesJahr[mDay+'_'+eval(m+1)+'_'+y]))
			{mDayX='<span'+cDayClick+sClick+'>'+mDay+'</span>';}
		dayCell='<td'+cDay+'>'+mDayX+'</td>';
		if(xD>4)
			{dayCell='<td'+cDayWE+'>'+mDayX+'</td>';}
		if(mDay=='&nbsp;')
			{dayCell='<td'+cDayNo+'>'+mDayX+'</td>';}
		if(mDay==thisDay.getDate()&&m==thisDay.getMonth()&&y==thisDay.getFullYear())
			{dayCell='<td'+cDayThis+'>'+mDayX+'</td>';}

		htm+=dayCell;
		}
	htm+='</tr>\n';
	}
htm+='<tr><td colspan="8"id="wasGeht"'+cInfo+'>';
if(sD)	{
	htm+='<b>'+wdS[thisDay.getDay()]+','+thisDay.getDate()+'.'+mS[thisDay.getMonth()]+'&nbsp;'+thisDay.getFullYear()+'</b>';
	if(jedesJahr[toDay+'_'+eval(m+1)]){htm+='<br>'+jedesJahr[toDay+'_'+eval(m+1)];}
	if(diesesJahr[toDay+'_'+eval(m+1)+'_'+y]){htm+='<br>'+diesesJahr[toDay+'_'+eval(m+1)+'_'+y];}
	}

htm+='&nbsp;</td></tr></table>';
if(document.layers)
{document.calendar.document.write(htm);return '';}
return htm;
}
function switchCalendar(m,y)
{
document.getElementById('calendar').innerHTML=makeCalendar(m,y,false);
}
function showData(d,m,y)
{
now.setDate(d);now.setMonth(eval(m-1));now.setFullYear(y);
document.getElementById('wasGeht').innerHTML=
	'<b>'+wdS[now.getDay()]+','+now.getDate()+'.'+mS[now.getMonth()]+'&nbsp;'+now.getFullYear()+'</b>';
if(jedesJahr[d+'_'+m])
	{document.getElementById('wasGeht').innerHTML+='<br>'+jedesJahr[d+'_'+m];}
if(diesesJahr[d+'_'+m+'_'+y])
	{document.getElementById('wasGeht').innerHTML+='<br>'+diesesJahr[d+'_'+m+'_'+y];}

}