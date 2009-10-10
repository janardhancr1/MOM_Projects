﻿// JScript File
var parentDiv;
var commentId;

function hidestatus()
{
	window.status=''
	return true
}

if (document.layers)
document.captureEvents(Event.MOUSEOVER | Event.MOUSEOUT)

document.onmouseover=hidestatus
document.onmouseout=hidestatus

function preLoadImages()
{
    if(document.images)
    {
        preImageObject = new Image();
        
        imageURL = new Array();
        imageURL[0] = "../images/home_icon1.gif";
        imageURL[1] = "../images/home_icon2.gif";
        imageURL[2] = "../images/home_icon3.gif";
        imageURL[3] = "../images/home_icon4.gif";
        imageURL[4] = "../images/home_icon5.gif";
        imageURL[5] = "../images/home_icon6.gif";
        imageURL[6] = "../images/home_icon7.gif";
        imageURL[7] = "../images/home_icon8.gif";
        imageURL[8] = "../images/home_icon9.gif";
        
        var i=0;
        for(i=0; i<=8; i++)
        {
            preImageObject.src = imageURL[i];
        }
    }
}


function addComments(parent, commentDiv, argValue, frgId)
{
    if(document.getElementById(argValue).value.length > 0)
    {
        parentDiv = document.getElementById(parent);
        commentId = document.getElementById(argValue);        
        var momShareInfo = commentId.value;        
        MOMWebService.AddMOM_FRG_CMNTByMOM_FRG_ID(frgId, momShareInfo, onComplete, onError, onTimeout);        
        document.getElementById(commentDiv).style.display = 'none';
    }
}

function onComplete(webArgs)
{
    //return webArgs;
    var child = document.createElement('div');
    child.style.background = "MistyRose";
    child.innerHTML = webArgs;
    commentId.value = "";
    parentDiv.appendChild(child);
}

function onError(webArgs)
{
    alert("An error occured during processing " + webArgs);
}

function onTimeout(webArgs)
{
    alert("timed out");
}

function momShareInfo()
{
    var parent = document.getElementById('ctl00_momCenter_momParent');
    var child  = document.createElement('div');
    var shareInfo = document.getElementById('ctl00$momCenter$momShare');
    child.innerHTML = "<img src='../images/q_silhouette.gif' width='40' height='40' //>" + shareInfo.value;
    parent.insertBefore(child, parent.firstChild);
}

function silentErrorHandler() {return true;}
window.onerror=silentErrorHandler;

function showInfo(arg)
{
    alert(arg);
}

function showWriteComment(args)
{
    var object = document.getElementById(args);
    object.style.display = 'block';
}

function showHide(args)
{
    var objFeed = document.getElementById(args);
    
    if(objFeed.style.display=='none')
    {
        objFeed.style.display = 'block';
    }
    else
    {
        objFeed.style.display = 'none';
    }
}

function hideFeed(args, frgID)
{
    parentDiv = document.getElementById(args);
    
    if(confirm("Are you sure you want to remove"))
    {
        MOMWebService.HideMOM_FRGByID(frgID, onHideComplete, onError, onTimeout);
    }
}

function showMOMType(args)
{
    var iFrmBox = document.getElementById('momTranscationFrame');
    iFrmBox.src = args;
}

function deleteComment(divElement, fridgeCommentId)
{
    if(confirm("Are you sure you want to remove"))
    {
        MOMWebService.DeleteMOM_FRG_CMNTByID(fridgeCommentId, onDeleteComplete, onError, onTimeout);  
        parentDiv = document.getElementById(divElement);        
    }
}

function onDeleteComplete()
{
    parentDiv.style.display = "none";
}

function onHideComplete()
{
    parentDiv.style.display = "none";
}

function showSubPanel(arg)
{
    var div = document.getElementById(arg);
    div.style.display = "block";
    
    if(arg=="momShareLinkPanel")
        document.getElementById("ctl00_momCenter_momShareLinkStatus").value = "T";
}

function hideSubPanel(arg)
{
    var div = document.getElementById(arg);
    div.style.display = "none";
    
    if(arg=="momShareLinkPanel")
        document.getElementById("ctl00_momCenter_momShareLinkStatus").value = "F";
}