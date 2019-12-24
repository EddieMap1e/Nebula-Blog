Vue.component('showarticle',{
	props:{
		artid:{
			type:Number,
			default:1
		}
	},
	data:function()
	{
		return{
			data:{
				title:'Welcome but 你麋鹿了',
				author:'Nebula',
				date:'forever'
			},
			titleStyle:{
				textAlign:'center',
				fontFamily:'微软雅黑',
				lineHeight:'40px'
			},
			authorStyle:{
				textAlign:'center',
				fontFamily:'黑体',
				color:'lightgray',
				lineHeight:'20px',
				fontSize:'12px'
			},
			dateStyle:{
				textAlign:'center',
				fontFamily:'宋体',
				color:'gray',
				lineHeight:'20px',
				fontSize:'9px'
			},
			contentStyle:{
				width:'800px',
				margin:'auto'
			}
		}
	},
	methods:{
		mdToHTML:function(){
			editormd.markdownToHTML("artContent",{
				emoji           : true,
				taskList        : true,
				tex             : true,
				flowChart       : true,
				sequenceDiagram : true,
				codeFold		: true
			})
		},
		getArtData:function(){
			var artdata=this.data;
			var id=this.artid;
			var update=this.mdToHTML;
			$.post("./php/getArticleData.php",{
				artid:id
			},function(data,status){
				if(data=="没有这篇文章")alert("该文章不存在");
				else if(typeof(data)=='object'){
					artdata['title']=data['title'];
					artdata['author']=data['author'];
					artdata['date']=data['date'];
					$('#contentText').text(data['content']);
					$('#indexTitle').text(""+data['title']+" - "+data['author']+" - Nebula");
				}
				update();
				$('.editormd-html-preview').css('background-color','rgba(255,255,255,0.3)')
				.css('min-height','700px')
				.css('border-radius','20px');
			},"json");
		}
	},
	created() {
		this.getArtData();
	},
	template:
	'<div>'+
		'<h1 :style="titleStyle">{{data.title}}</h1>'+
		'<h2 :style="authorStyle">{{data.author}}</h2>'+
		'<h3 :style="dateStyle">{{data.date}}</h3>'+
		'<hr style="margin:20px" class="layui-bg-cyan"/>'+
		'<div id="artContent" :style="contentStyle">'+
			'<textarea id="contentText" style="display:none;">![](../public/img/logoRed.png)\n'+
			'# 我能吞下玻璃\n## 而不傷身體\n> 並非所有流浪者都迷失了自我\n'+
			'\n```c++\nprint("hello world");\nprint("hello Nebula");\n```\n'+
			'`仰望天堂吧`\n\n$$E=mc^2$$\n\n- [ ] 成为强大的人儿吧\n- [x] 你不是垃圾</textarea>'+
		'</div>'+
	'</div>'
})