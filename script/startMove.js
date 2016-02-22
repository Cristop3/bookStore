/*完美运动框架*/

//获取行间样式(兼容)
function getStyle(obj,attr){
	return obj.currentStyle ? obj.currentStyle[attr] : getComputedStyle(obj,false)[attr]
}

//最终运动框架
function startMove(obj,json,endFn){
	//alert(1)
	clearInterval(obj.timer);
	obj.timer = setInterval(function(){
		//alert(1)
			var onoff = true;//判断json所有值是否到达目标值关键标识变量
			for(attr in json){
				//1.找当前值
				var iCu = 0;
				if(attr == 'opacity'){
					iCu = parseInt( parseFloat(getStyle(obj,attr))*100 );
				}else{
					iCu = parseInt( getStyle(obj,attr) );
				}
				//2.设置缓冲速度
				var speed = (json[attr] - iCu)/8;
				speed = speed>0 ? Math.ceil(speed) : Math.floor(speed);
				//3.判断是否停止
				if(iCu != json[attr]){//关键！！当所有值完成了目标，才通过变量标识来停止定时器
					onoff = false;
				}
				//4.缓冲变化指定值
				if(attr == 'opacity'){
					obj.style.filter = 'alpha(opacity:'+(iCu+speed)+')';
					obj.style.opacity = (iCu+speed)/100;
				}else{
					obj.style[attr] = iCu + speed + 'px';
				}
			}
		if(onoff){//必须等到Json的for-in循环完，让所有值到达目标值 才能停止定时器
			clearInterval(obj.timer);
			if(endFn) endFn();
		}
	},50);
}
