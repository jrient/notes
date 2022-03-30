# vue3

## 安装

> vue create xxx

## 申明

```javascript
import { createApp } from 'vue'
import App from './App.vue'

createApp(App).mount('#app')
```

## 配置项
所有的data/methods/computed等，都放在setup中
兼容vue2写法，不建议混写
vue2/3配置同时出现，3优先
setup不能是个async函数，因为返回值不再是一个return的对象，而是一个promise

## ref函数
ref函数用来定义一个响应式的数据
语法：
> const xxx = ref(val)
js中操作数据使用 xxx.value
模板中使用 直接 {{xxx}}

接受的数据可以是：基本类型、对象类型
基本类型的数据：响应式依然是靠Object.defineProperty()实现
对象类型的数据：内部求助vue3中的reactive函数

## reactive函数
reactive函数用来定义对象类型的响应式数，基本类型用ref
语法：
> const xxx = reactive({}),返回一个代理对象(proxy对象)
reactive定义的响应式是深层次的
内部基于ES6的Proxy实现，通过代理对象操作源对象内部数据

## 响应式原理

### vue2

#### 原理

- 对象类型：通过 `Object.defineProperty()`对属性的读取、修改进行拦截(数据劫持)
- 数组类型：通过重写更新数组的一系列方法来实现拦截

#### 存在问题
- 新增属性、删除属性，界面不会更新
- 直接通过下标修改数组，界面不会自动更新

### vue3

#### 实现原理
- 通过Proxy(代理)：拦截对象中任意属性的变化，包括读写添加修改
- 通过Reflect(反射)：对被代理对象的属性经行操作
- VUE3实现的简单案例
```javascript
new Proxy(data, {
    //拦截
    get(target, prop) {
        return Reflect.get(target, prop)
    }
    set(target, prop, value){
        return Reflect.set(target, prop, value)
    }
    deleteProperty(target, prop) {
        return Reflect.deleteProperty(target, prop)
    }
})

```
## setup的注意点

### 执行时间
setup在beforeCreate之前执行一次，this是undefined

### setup的参数

- props: 值为对象，包含：组件外部传递过来，且组件内声明接受了的属性
- context：上下文对象
  - attrs：值为对象，包含：组件外部传递过来，但是没有在props配置中声明的属性，相当于this.$attr
  - slots:收到的插槽内容，相当于this.$slots
  - emit:分发自定义事件的函数，相当于this.$emit

## 计算属性

### computed

与vue2中的配置功能一样
写法
```javascript
import {computed} from 'vue'
setup(){
    //简写
    let xxx = computed(()=>{
        return xxx
    })
    //完整
    let xxx = computed({
        get(){
            return xxx
        }
        set(value) {
            xxb = value
        }
    })
}
```

## watch
用法：与vue2中一致
问题：
    1. 监视reactive定义的响应式数据时，oldvalue无法获取正确的值
    2. 监视reactive定义的响应式数据时，默认开启深度监视(deep配置失效)；
       监视reatvice定义的响应式数据中的某个属性时，depp有效

```javascript
//监视ref定义的单个响应式数据
watch(sum, (newValue, oldValue) => {
    cosole.log(newValue, oldValue)
}, {immediate:true})

//监视ref定义的多个响应式数据
//newValue和oldValue的值是 [sumNewValue,sumOldValue]格式
watch([sum,msg], (newValue, oldValue) => {
    cosole.log(newValue, oldValue)
}, {immediate:true})

//监视reactive定义的单个响应式数据
//oldvalue无法获取正确的值
//强制开启了deep:true
watch(data, (newValue, oldValue) => {
    cosole.log(newValue, oldValue)
}, {immediate:true})

//监视reactive定义的响应式数据中的某个属性
//如果此属性是一个对象，则需要开启deep才能监视到深度变化，且oldvalue也会存在无法获取正确值的问题
watch(()=>data.name, (newValue, oldValue) => {
    cosole.log(newValue, oldValue)
}, {immediate:true})

//监视reactive定义的响应式数据中的多个属性
watch([()=>data.name,()=>data.age], (newValue, oldValue) => {
    cosole.log(newValue, oldValue)
}, {immediate:true})

```

## watchEffect
功能：不指明监视的属性，回调中用到了哪个属性就监视哪个属性
watchEffect和computed有些类似：
    - computed注重的是计算出来的值，所以必须要写返回值
    - watchEffect注重的是过程，不需要写返回值
```javascript
//watchEffect所指定的回调中的数据只要发生了变化，则直接重新执行回调
watchEffect(()=>{
    const x1 = sum.value
    const x2 = person.age
    const.log('watchEffect执行了')
})

```

## 生命周期钩子
与vue2对比如下

beforeCreate => setup()
created      => setup()
beforeMount  => onMount
mounted      => onMounted
beforeUpdate => onUpdate
updated      => onUpdated
beforeDistory=> onUnmount
distoryed    => onUnmounted

## hook
hook的本质是一个函数，把setup函数中使用到的composition api进行封装
类似于vue2中的mixin
优势：复用代码，让setup中的逻辑更清晰