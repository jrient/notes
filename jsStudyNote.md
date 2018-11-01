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


## 书签
[filter](https://www.liaoxuefeng.com/wiki/001434446689867b27157e896e74d51a89c25cc8b43bdb3000/0014351219769203e3fbe1ed611475db3d439393add8997000)