import{_ as k,a as D,u as $,b as I}from"./index.vue_vue_type_script_name_Preview_setup_true_lang-22e0d43b.f30c7951.js";import"./index.1e45991b.js";import{g as d,i as w,j as u,k as H,c as f,d as g,A as a,P,u as i,T as M,t as B,L as E,e as _,F as G,H as N,I as V}from"./index.7a3da9ba.js";var X=Object.defineProperty,Y=Object.defineProperties,z=Object.getOwnPropertyDescriptors,x=Object.getOwnPropertySymbols,F=Object.prototype.hasOwnProperty,L=Object.prototype.propertyIsEnumerable,C=(t,e,r)=>e in t?X(t,e,{enumerable:!0,configurable:!0,writable:!0,value:r}):t[e]=r,O=(t,e)=>{for(var r in e||(e={}))F.call(e,r)&&C(t,r,e[r]);if(x)for(var r of x(e))L.call(e,r)&&C(t,r,e[r]);return t},b=(t,e)=>Y(t,z(e));function T(t,e,r,c){return Math.atan2(t-r,e-c)*(180/Math.PI)*-1+180}const U=t=>(N("data-v-4e21238c"),t=t(),V(),t),A={class:"gradient-controls border-box flex justify-between items-center w-full mb-8px px-16px"},R={class:"flex flex-1"},q={key:0,class:"relative mr-24px"},J=U(()=>a("div",{class:"gradient-degree-pointer"},null,-1)),K=[J],Q={class:"gradient-degree-value flex justify-center items-center"},W=d({name:"GradientControls"}),Z=d(b(O({},W),{setup(t){const e=w("colorPickerState"),r=w("updateColor"),c=u(()=>e.type),m=u(()=>e.degree),v=n=>{r({type:n},"type")},l=H(!0),S=()=>{if(l.value){l.value=!1;return}let n=(e.degree||0)+45;n>=360&&(n=0),r({degree:~~n},"degree")},h=u(()=>({transform:`rotate(${e.degree}deg)`})),y=$(n=>{const o=n.target.getBoundingClientRect(),p=~~(8-window.pageYOffset)+o.top,j=~~(8-window.pageXOffset)+o.left;return{centerY:p,centerX:j}},(n,{centerX:s,centerY:o})=>{l.value=!0;const p=T(n.clientX,n.clientY,s,o);r({degree:~~p},"degree")},n=>{const s=n.target.classList;l.value=!1,s.contains("gradient-degrees")||s.contains("icon-rotate")});return(n,s)=>(f(),g("div",A,[a("div",R,[a("div",{class:P(`gradient-type-item liner-gradient ${i(c)==="linear"?"active":""}`),onClick:s[0]||(s[0]=o=>v("linear"))},null,2),a("div",{class:P(`gradient-type-item radial-gradient ${i(c)==="radial"?"active":""}`),onClick:s[1]||(s[1]=o=>v("radial"))},null,2)]),i(c)==="linear"?(f(),g("div",q,[a("div",{class:"gradient-degrees cursor-pointer flex justify-center items-center",onMousedown:s[2]||(s[2]=(...o)=>i(y)&&i(y)(...o)),onClick:S},[a("div",{class:"gradient-degree-center",style:M(i(h))},K,4)],32),a("div",Q,[a("p",null,B(i(m))+"°",1)])])):E("",!0)]))}})),ee=I(Z,[["__scopeId","data-v-4e21238c"]]),te=d({name:"Gradient"}),ce=d(b(O({},te),{setup(t){return(e,r)=>(f(),g(G,null,[_(ee),_(k),_(D)],64))}}));export{ce as default};
