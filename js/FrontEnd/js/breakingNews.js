!function(n){$.fn.breakingNews=function(n){var l={width:"100%",modul:"breakingnews",color:"default",border:!1,effect:"fade",fontstyle:"normal",autoplay:!1,timer:4e3,feed:!1,feedlabels:!1,feedcount:5},i=[],e=[],n=$.extend(l,n);return this.each(function(){function l(){n.modul.width()<480?(n.modul.find(".bn-title h2").css({display:"none"}),n.modul.find(".bn-title").css({width:10}),n.modul.find("ul").css({left:37})):(n.modul.find(".bn-title h2").css({display:"inline-block"}),n.modul.find(".bn-title").css({width:"auto"}),n.modul.find("ul").css({left:$(n.modul).find(".bn-title").width()+30}))}function t(){s++,s==m&&(s=0),d()}function d(){"fade"==n.effect?(n.modul.find("ul li").css({display:"none"}),n.modul.find("ul li").eq(s).fadeIn("normal",function(){r=!0})):"slide-h"==n.effect?n.modul.find("ul li").eq(c).animate({width:0},function(){$(this).css({display:"none",width:"100%"}),n.modul.find("ul li").eq(s).css({width:0,display:"block"}),n.modul.find("ul li").eq(s).animate({width:"100%"},function(){r=!0,c=s})}):"slide-v"==n.effect&&(s>=c?(n.modul.find("ul li").eq(c).animate({top:-60}),n.modul.find("ul li").eq(s).css({top:60,display:"block"}),n.modul.find("ul li").eq(s).animate({top:0},function(){c=s,r=!0})):(n.modul.find("ul li").eq(c).animate({top:60}),n.modul.find("ul li").eq(s).css({top:-60,display:"block"}),n.modul.find("ul li").eq(s).animate({top:0},function(){c=s,r=!0})))}function o(n,l,i){i=new XMLHttpRequest,i.open("GET",n),i.onload=l,i.send()}function u(l,i){return"http://query.yahooapis.com/v1/public/yql?q="+encodeURIComponent("select * from "+i+' where url="'+l+'" limit '+n.feedcount)+"&format=json"}function a(){for(i=n.feed.split(","),e=n.feedlabels.split(","),m=0,n.modul.find("ul").html(""),xx=0,k=0;k<i.length;k++)o(u(i[k].trim(),"rss"),function(){var l=JSON.parse(this.response);l=l.query.results.item,$(l).each(function(i,e){m++,dataLink=$("<a>").prop("href",l[i].link).prop("hostname"),n.modul.find("ul").append('<li><a target="_blank" href="'+l[i].link+'"><span>'+dataLink+"</span> - "+l[i].title+"</a></li>"),0==xx&&n.modul.find("ul li").eq(0).fadeIn(),xx++})})}n.modul=$("#"+$(this).attr("id"));var f=n.modul,s=0,c=0,m=n.modul.find("ul li").length,r=!0;0!=n.feed?a():n.modul.find("ul li").eq(s).fadeIn(),l(),n.autoplay?(f=setInterval(function(){t()},n.timer),$(n.modul).on("mouseenter",function(){clearInterval(f)}),$(n.modul).on("mouseleave",function(){f=setInterval(function(){t()},n.timer)})):clearInterval(f),n.border||n.modul.addClass("bn-bordernone"),"italic"==n.fontstyle&&n.modul.addClass("bn-italic"),"bold"==n.fontstyle&&n.modul.addClass("bn-bold"),"bold-italic"==n.fontstyle&&n.modul.addClass("bn-bold bn-italic"),n.modul.addClass("bn-"+n.color),$(window).on("resize",function(){l()}),n.modul.find(".bn-navi span").on("click",function(){r&&(r=!1,0==$(this).index()?(s--,0>s&&(s=m-1),d()):(s++,s==m&&(s=0),d()))})})}}(jQuery);