Vue.component('background',{
	props:{
		src:{
			type:String,
			default:''
		},
		display:{
			type:String,
			default:''
		},
		position:{
			type:String,
			default:'fixed'
		}
	},
	data:function() {
		return{
			bgStyle:{
				backgroundImage:'url('+ this.src +')',
				position:this.position,
				top:'0',
				left:'0',
				width:'100%',
				height:'100%',
				minHeight:'1000px',
				zIndex:'-99',
				zoom:'1',
				backgroundColor:'#fff',
				backgroundRepeat:'repeat',
				backgroundSize:'cover',
				backgroundPosition:'center 0',
				display:this.display
			}
		}
	},
	template:'<div :style="bgStyle" id="background"></div>'
})