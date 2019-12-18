var pageAll=1;
var pageMy=1;
var delId=0;
function deleteArticle(event){
	var id=$(event.target).attr("name");
	if(id==delId)
	{
		$.post("./php/deleteArticle.php",{
			id:id
		},function(data,status){
			if(data=="ok"){
				alert("哎呀,删除成功了 *v*");
				window.alert_ok=function(){
					getMyArt();
					getAllArt();
					delId=0;
					window.alert_ok=function(){};
				}
			}
			else alert("由于未知原因删除失败 qwq");
		},"JSON")
	}
	else{
		delId=id;
		alert('再次点击将确定永久删除该文章 ovo');
	}
}
var getAllArt=function(){
	$.post("./php/getArticleList.php",{
		type:'all',
		page:pageAll
	},function(data,status){
		$('#showAllArt').empty();
		$('#showAllArt').append(
		'<div id="allpage" style="top:860px;width:800px;margin:auto;'+			
		'position:absolute;text-align:center;line-height:30px">'+
		'<span style="cursor:pointer;color:purple" onclick={pageAll=1;getAllArt();}>&nbsp;首页&nbsp;</span>'+
		'<span style="cursor:pointer;color:purple" onclick={pageAll='+data["maxPageNum"]+';getAllArt();}>&nbsp;尾页&nbsp;</span><br/'+
		'</div>'
		);
		if(pageAll!=1)$('#allpage').append('<span style="cursor:pointer;color:purple" onclick={pageAll--;getAllArt();}>上一页</span>');
		for(var i=1;i<=data['maxPageNum'];i++){
			if(i+5<pageAll||i-5>pageAll)continue;
			if(i!=pageAll)$('#allpage').append(
			'<span style="cursor:pointer;color:purple" onclick={pageAll='+i+';getAllArt();}>&nbsp;'+i+'&nbsp;</span>'
			)
			else $('#allpage').append('<span style="cursor:default;color:red;font-size:16px">'+i+'</span>');
		}
		if(pageAll!=data['maxPageNum'])$('#allpage').append('<span style="cursor:pointer;color:purple" onclick={pageAll++;getAllArt();}>下一页</span>');
		$.each(data,function(key,value){
			if(typeof(value)=="object")
				$('#showAllArt').append(
				'<a href="../article/detail?id='+value["art_id"]+'">'+
				'<div onmouseover={$(event.target).css("color","DeepSkyBlue");} '+
				'onmouseleave={$(event.target).css("color","black");} '+
				'style="line-height:25px;font-size:20px;margin:30px 20px;'+
				'border-left:thick double lightskyblue;padding:0 0 0 20px;cursor:pointer">'+
					value['title']+
					'<span style="float:right;;color:lightgray;font-size:8px;'+
					'line-height:25px" onmouseleave={$(event.target).css("color","lightgray");} '+
					' onmouseover={event.stopPropagation();$(event.target).css("color","purple");}>'+
					value['author']+"&nbsp;&nbsp;&nbsp;&nbsp;"+value['date']+'</span>'+
				'</div></a>'
				);
		})
	},"json");
};
getMyArt=function(){
	$.post("./php/getArticleList.php",{
		type:'my',
		page:pageMy
	},function(data,status){
		$('#showMyArt').empty();
		$('#showMyArt').append(
		'<div id="mypage" style="top:860px;width:800px;margin:auto;'+			
		'position:absolute;text-align:center;line-height:30px">'+
		'<span style="cursor:pointer;color:purple" onclick={pageMy=1;getMyArt();}>&nbsp;首页&nbsp;</span>'+
		'<span style="cursor:pointer;color:purple" onclick={pageMy='+data["maxPageNum"]+';getMyArt();}>&nbsp;尾页&nbsp;</span><br/'+
		'</div>'
		);
		if(pageMy!=1)$('#mypage').append('<span style="cursor:pointer;color:purple" onclick={pageMy--;getMyArt();}>上一页</span>');
		for(var i=1;i<=data['maxPageNum'];i++){
			if(i+5<pageMy||i-5>pageMy)continue;
			if(i!=pageMy)$('#mypage').append(
			'<span style="cursor:pointer;color:purple" onclick={pageMy='+i+';getMyArt();}>&nbsp;'+i+'&nbsp;</span>'
			)
			else $('#mypage').append('<span style="cursor:default;color:red;font-size:16px">'+i+'</span>');
		}
		if(pageMy!=data['maxPageNum'])$('#mypage').append('<span style="cursor:pointer;color:purple" onclick={pageMy++;getMyArt();}>下一页</span>');
		$.each(data,function(key,value){
			if(typeof(value)=="object"){
				$('#showMyArt').append(
				'<a href="../article/detail?id='+value["art_id"]+'">'+
				'<div onmouseover={$(event.target).css("color","DeepSkyBlue");} '+
				'onmouseleave={$(event.target).css("color","black");} '+
				'style="line-height:25px;font-size:20px;margin:30px 20px;'+
				'border-left:thick double lightskyblue;padding:0 0 0 20px;cursor:pointer">'+
					value['title']+
					'<span style="float:right;;color:lightgray;font-size:8px;'+
					'line-height:25px" onmouseleave={$(event.target).css("color","lightgray");} '+
					'onmouseover={event.stopPropagation();$(event.target).css("color","purple");}>'+value['date']+'</span>'+
				'</div></a>'
				);
				$('#showMyArt').append(
				'<i class="layui-icon layui-icon-delete" style="'+
				'position:relative;float:right;top:-54px;left:20px;font-size:20px;color:pink;'+
				'display:none;cursor:pointer" name="'+value["art_id"]+'"></i>'
				)
			}
		})
	},"json");
};
var pageAll = 1;
var pageMy = 1;
Vue.component('articlelist',{
	data:function(){
		return{
			cardStyle:{
				backgroundColor:'rgba(255,255,255,0.2)',
				padding:'10px 20px',
				borderRadius:'15px 15px 0 0',
				margin:'1px',
				cursor:'pointer'
			},
			listStyle:{
				backgroundColor:'rgba(255,255,255,0.5)',
				padding:'40px 60px',
				height:'780px',
				width:'800px',
				margin:'9px 1px 0 1px',
				display:'none',
				borderRadius:'0 10px 10px 10px'
			},
			setStyle:{
				position:'relative',
				top:'-840px',
				left:'830px',
				color:'navy',
				fontSize:'20px',
				cursor:'pointer',
				display:'none'
			},
			addStyle:{
				position:'relative',
				top:'-840px',
				left:'825px',
				color:'firebrick',
				fontSize:'20px',
				cursor:'pointer'
			}
		}
	},
	methods:{
		allartclick:function(){
			$('#allcard').css("background-color","rgba(255,255,255,0.5)");
			$('#mycard').css("background-color","rgba(255,255,255,0.2)");
			$('#showAllArt').show();
			$('#showMyArt').hide();
			$('.layui-icon-set').hide();
		},
		myartclick:function(){
			$('#allcard').css("background-color","rgba(255,255,255,0.2)");
			$('#mycard').css("background-color","rgba(255,255,255,0.5)");
			$('#showAllArt').hide();
			$('#showMyArt').show();
			$('.layui-icon-set').show();
		},
		setclick:function(){
			if($('.layui-icon-delete').css('display')=="none")
				$('.layui-icon-delete').css('display','');
			else $('.layui-icon-delete').css('display','none');
			if(delId==0)$('.layui-icon-delete').on("click",deleteArticle);
		},
		addclick:function(){
			window.location.href="./post.html";
		}
	},
	mounted() {
		$('#allcard').css("background-color","rgba(255,255,255,0.5)");
		$('#showAllArt').show();
		getAllArt();
		getMyArt();
	},
	template:
	'<div>'+
		'<span id="allcard" :style="cardStyle" @click="allartclick">所有文章</span>'+
		'<span id="mycard" :style="cardStyle" @click="myartclick">我的文章</span>'+
		'<div id="showAllArt" :style="listStyle"></div>'+
		'<div id="showMyArt" :style="listStyle"></div>'+
		'<i class="layui-icon layui-icon-add-circle" :style="addStyle" @click="addclick"></i>'+
		'<i class="layui-icon layui-icon-set" :style="setStyle" @click="setclick"></i>'+
	'</div>'
})
