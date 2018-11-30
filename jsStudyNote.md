
[toc]

---

`这是一个PHPer学习javascript的笔记`

### 数据类型
1. == 和 ===
    - ==会自动转换数据类型再比较
    - === 不会自动转换数据类型，如果数据类型不一致，返回false，如果一致则进行比较
2. NaN
    - NaN和所有的其他值都不相等，包括他自己。只有通过 isNaN() 函数才能进行判断
3. 浮点数比较
    - 浮点数在运算过程中会产生误差，因为计算机无法精确表示无限循环小数。要比较两个浮点数是否相等，只能计算它们之差的绝对值，看是否小于某个阈值
4. null 和 undefined
    - null表示空
    - undifined表示值未定义，静静在判断函数参数是否传递的情况下使用
5. 对象
    - 对象的键都是字符串类型，值可以是任意类型
6. 字符串
    - 多行字符串用\` \`表示
    - 模板字符串 \`你好, 你今年${age}岁了!\`
    - 字符串是不可变的，如果对字符串的某个索引赋值，不会有任何错误，但是，也没有任何效果
7. 数组
    - 如果通过索引赋值时，索引超过了范围，同样会引起Array大小的变化
    - 使用indexOf()进行搜索元素位置的时候，查询参数区分类型。例如：数字30和字符串'30'是不同的元素
    - arr.splice() 可以实现数组的删除、插入、修改操作
    - arr.concat() 相当于 array_merge()
    - arr.join() 相当于implode()
8. 对象
    - 对象属性名不包含特殊字符，这样定义 key: value，可以直接使用 . 操作符访问
    - 包含特殊字符，这样定义 'special_key': value, 必须使用x\['special_key'\]来访问   
    - delete obj.a  删除obj中的a属性
    - 'a' in obj    检查a属性是否在obj中
    - obj.hasOwnProperty('a'); 判断a属性是否是obj自身拥有的，而不是继承来的
9. 条件判断
    - null undefined 0 NaN '' false  视为 false
10. Map & Set
    - Map不会因为长度而降低查询速度
        ```
        var m = new Map([['Michael', 95], ['Bob', 75], ['Tracy', 85]]);
        m.get('Michael'); // 95
        // m.set m.get m.delete m.has
        ```
    - 重复元素在Set中自动被过滤, 区分字符串和数字
11. iterable
    - Array、Map和Set都属于iterable类型
    - 可以使用 for( var item of array) 来遍历
    - iterable 内置 forEach方法 `a.forEach(function (element, index, array) {})`;
    - 使用forEach 中 修改array的值， 无法影响当前循环，但是影响循环结束时的值

12. NaN:number true:boolean undefined:undefined null:object

### 函数
- 函数的参数可以多于预定参数，也可以少于预定参数。多于则忽略，少于则受到undefined
- arguments永远指向当前函数的调用者传入的所有参数。arguments类似Array但它不是一个Array
- arguments 常用于 调整传入参数和函数参数默认值
- function foo(a, b, ...rest) {}  可以将多余的参数传入 rest变量中，如果没有多余参数，rest则会变成一个空数组
- JavaScript引擎有一个在行末自动添加分号的机制，需要注意
- javascript的函数会先扫描整个函数体内的语句，并把所有申明的变量“提升”到函数顶部
- let 用来声明块级变量， const 用来声明常量
- 解构赋值 `var [x, y, z] = ['hello', 'JavaScript', 'ES6'];`
- 解构赋值还可以忽略某些元素`let [, , z] = ['hello', 'JavaScript', 'ES6'];`
- 函数本身自带apply方法，它接收两个参数，第一个参数就是需要绑定的this变量，第二个参数是Array，表示函数本身的参数。
- call方法和apply方法类似，区别在于apply是将参数打包成数组，call将参数顺序传入
    `Math.max.apply(null, [3, 5, 4]); // 5`
    `Math.max.call(null, 3, 5, 4); // 5`
- 可以使用自定义函数替换掉默认的函数
    ```
    window.parseInt = function () {
        count += 1;
        return oldParseInt.apply(null, arguments); // 调用原函数
    };
    ```
- 高阶函数

    - map()方法 `arr.map(String)`  为arr 中的所有项执行String()函数
    - reduce()方法 `[x1, x2, x3, x4].reduce(f) = f(f(f(x1, x2), x3), x4)` Array的reduce()把一个函数作用在这个Array的[x1, x2, x3...]上，这个函数必须接收两个参数，reduce()把结果继续和序列的下一个元素做累积计算
    - map()中的回调函数要求只有一个参数，否则会出现意料之外的错误
    - filter() 筛选
    - sort() 排序;  Array的sort()方法默认把所有元素先转换为String再排序;sort()可以传入自定义函数;sort()方法会直接对Array进行修改，它返回的结果仍是当前Array

- 闭包  函数作为返回值：返回函数不要引用任何循环变量，或者后续会发生变化的变量 
- 箭头函数: `x => x * x`
- generator 

### 标准对象
- Date对象月份值从0开始 0表示1月，1表示2月
- 创建正则匹配分两种  一种 会直接定义字符串 '/ABC/'; 另一种 new RegExp('ABC'); 注意 第二种存在转义字符的问题
- (/ABC/).test('ABCDEFG'); 检查是否能够成功匹配
- 'a b   c'.split(/\s+/); // ['a', 'b', 'c'] 正则分割
- (/^(\d{3})-(\d{3,8})$/).exec('010-12345');
- \d+采用贪婪匹配; \d+?采用非贪婪匹配
- 全局搜索 var r = /test/g  或者  var r = new RegExp('test','g');
- 全局匹配可以多次执行exec()方法来搜索一个匹配的字符串。当我们指定g标志后，每次运行exec()，正则表达式本身会更新lastIndex属性，表示上次匹配到的最后索引
- json 序列化 JSON.stringify(value, null, ''); 第二个参数用于指定需要输出的属性 或 传入一个函数处理所有的键值对;
- json 反序列化 JSON.parse(value); 其第二参数可以传入一个函数，用来处理解析出来的属性;

### 面向对象编程
- JavaScript不区分类和实例的概念，而是通过原型（prototype）来实现面向对象编程
- 每个对象都有 __proto__ 属性，但只有函数对象才有 prototype 属性
- xiaoming.__proto__ = Student;    xiaoming 是一个用户对象    Student 是一个学生对象
- Object.create()方法可以传入一个原型对象，并创建一个基于该原型的新对象
- var arr = [1,2,3];  对象原型链 : `arr ----> Array.prototype ----> Object.prototype ----> null`
- 构造函数 new {function() {}}
- 创建的对象 会获得一个 constructor 属性，他指向原型本身
- 一个常用的模式
    ```
    function Student(props) {
        this.name = props.name || '匿名'; // 默认值为'匿名'
        this.grade = props.grade || 1; // 默认值为1
    }
    
    Student.prototype.hello = function () {
        alert('Hello, ' + this.name + '!');
    };
    
    function createStudent(props) {
        return new Student(props || {})
    }
    ```
- inherits 原型继承封装函数
- 使用 class 来声明类 extends 来继承类
- 使用super(); 来调用父类的构造方法
- [Babel](https://babeljs.io/) 一个把class代码转换为传统的prototype代码的工具

### 浏览器
- window; IE<=8不支持
- navigator 对象表示浏览器的信息
    - navigator.appName：浏览器名称；
    - navigator.appVersion：浏览器版本；
    - navigator.language：浏览器设置的语言；
    - navigator.platform：操作系统类型；
    - navigator.userAgent：浏览器设定的User-Agent字符串   
- screen 对象表示屏幕的信息
    - screen.width：屏幕宽度，以像素为单位；
    - screen.height：屏幕高度，以像素为单位；
    - screen.colorDepth：返回颜色位数，如8、16、24
- location 当前页面的URL信息
    - location.protocol; // 'http'
    - location.host; // 'www.example.com'
    - location.port; // '8080'
    - location.pathname; // '/path/index.html'
    - location.search; // '?a=1&b=2'
    - location.hash; // 'TOP'
- document 表示当前页面
    - document.getElementById();
    - ducument.getElementsByTagName();
    - document.cookie;
- history 浏览器的历史记录
    - history.back();
    - history.forward();
    - 不建议使用history 这个对象
- querySelector() querySelectorAll()

#### 操作DOM
- innerHTML innerText textContent;innerText不返回隐藏元素的文本，而textContent返回所有文本。另外注意IE<9不支持textContent
- DOM节点的style属性对应所有的CSS，可以直接获取或设置。因为CSS允许font-size这样的名称，但它并非JavaScript有效的属性名，所以需要在JavaScript中改写为驼峰式命名fontSize
- appendChild() 插入新元素
- 插入的js节点已经存在于当前的文档树，因此这个节点首先会从原先的位置删除，再插入到新的位置
- createElement(); 创建一个新的节点
- insertBefore(newElement, referenceElement) 子节点会插入到referenceElement之前
- 删除节点 var remove = parent.removeChild(self); 删除后的节点虽然不在文档树中了，但其实它还在内存中，可以随时再次被添加到别的位置。
- js处理文件上传的操作非常少，但是在html5中，提供了File和FileReader两个主要对象，可以获得文件信息并读取文件。
- 现在浏览器上AJAx主要依赖XMLHttpRequest对象 低版本使用ActiveXObject对象
- CORS (cross-origin resource sharing) 就目前html5主流的ajax方式。 先发送一个OPTIONS请求（称为preflighted请求）到目标域名，目标域名返回Access信息，然后由js判断是否可以继续执行。
- 等待回调 new Promise(function(resolve, reject){if(1){resolve()} else {reject()}}).then(function(a){log('success')}).catch(function(b){log('fail)});
- canvas 可以用JavaScript在上面绘制各种图表、动画等,(html5)
    - getContext('2d')方法让我们拿到一个CanvasRenderingContext2D对象，所有的绘图操作都需要通过这个对象完成。
    - getContext("webgl") 绘制3d图形
    
#### jQuery
- jQuery 目前有1.x和2.x两个版本， 区别在于2.x不支持ie6/7/8
- $() 选择器
    - 连写是完全选择
    - 用逗号分隔则是取并集
    - 空格分隔是层级选择
    - `>`分隔是子选择器，要求必须是父子关系
    - :分隔 过滤器，通常附加在选择器上
    - 表单相关的选择器 :input; :file; :checkbook; :radio; :focus; :checked; :disabled; :enabled;
    - 其他 :visible; :hidden;等
- 继续选择
    - find(); 向下查找
    - parent(); 向上查找
    - next(); prev(); 同级查找
    - filter(); 过滤 可以传入一函数 函数内部的this被绑定为DOM对象，不是jQuery对象；
    - map(); 一个jQuery对象包含的若干DOM节点转化为其他对象
    - 一个jQuery对象如果包含了不止一个DOM节点，first()、last()和slice()方法可以返回一个新的jQuery对象，把不需要的DOM节点去掉
- 操作DOM
    - text(); html(); 获取/设置文本或者html  可以被选择的一组节点的处理
    - css(); 修改css样式
    - 修改class: hasClass(); addClass(); removeClass();
    - show(); hidden() 显示和隐藏
    - width(); height();获取、设置宽高
    - attr(); removeAttr(); 设置节点属性
    - is(); 判断属性是否存在; prop(); 用于设置无值属性
    - val(); 设置value属性
    - append(); 添加节点到最后 可以使DOM节点、jQ对象、函数对象；prepend()添加到最前
    - after(); before(); 将新节点插入指定节点之前、之后
    - remove(); 删除节点
- 事件
    -  鼠标事件
       click: 鼠标单击时触发；
       dblclick：鼠标双击时触发；
       mouseenter：鼠标进入时触发；
       mouseleave：鼠标移出时触发；
       mousemove：鼠标在DOM内部移动时触发；
       hover：鼠标进入和退出时触发两个函数，相当于mouseenter加上mouseleave。
    - 键盘事件
       键盘事件仅作用在当前焦点的DOM上，通常是<input>和<textarea>。
       keydown：键盘按下时触发；
       keyup：键盘松开时触发；
       keypress：按一次键后触发。
    - 其他事件
       focus：当DOM获得焦点时触发；
       blur：当DOM失去焦点时触发；
       change：当<input>、<select>或<textarea>的内容改变时触发；
       submit：当<form>提交时触发；
       ready：当页面被载入并且DOM树完成初始化后触发。仅作用于document对象,且只触发一次。用法 $(document).ready(function(){}) 简化 $(function () {// init...});
    - on(); 绑定事件
    - off(); 解绑事件； 注意不能解绑匿名函数。可以使用off('click')一次性移除已绑定的click事件的所有处理函数。无参数调用off()一次性移除已绑定的所有类型的事件处理函数。
    - change(); 用户操作改变时触发，如文本框输入、下拉框改变..可以通过js代码手动触发
    - 有些方法只有由用户触发才能执行。如 window.open();
    
    
    
    
### 书签
[链接](https://www.liaoxuefeng.com/wiki/001434446689867b27157e896e74d51a89c25cc8b43bdb3000/001434500456006abd6381dc3bb439d932cb895b62d9eee000)